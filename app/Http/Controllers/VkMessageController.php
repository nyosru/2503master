<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class VkMessageController extends Controller
{
    /**
     * Отправить сообщение конкретному пользователю VK
     */
    public function sendMessageToUser(Request $request)
    {
        $request->validate([
            'message' => 'required|string|max:1000',
            'user_id' => 'required|integer'
        ]);

        $user = Auth::user();

        if (!$user->vk_token) {
            return response()->json(['error' => 'VK token not found'], 400);
        }

        // Проверяем валидность токена
        if (!$this->checkTokenValidity($user->vk_token)) {
            return response()->json(['error' => 'VK token expired'], 401);
        }

        $result = $this->sendVKMessage(
            $user->vk_token,
            $request->user_id,
            $request->message
        );

        if ($result) {
            return response()->json([
                'success' => true,
                'message' => 'Message sent successfully'
            ]);
        }

        return response()->json([
            'error' => 'Failed to send message'
        ], 500);
    }

    /**
     * Отправить приветственное сообщение текущему пользователю
     */
    public function sendWelcomeMessage()
    {
        $user = Auth::user();

        if (!$user->vk_token || !$user->vk_id) {
            return response()->json(['error' => 'VK data not found'], 400);
        }

        // Проверяем валидность токена
        if (!$this->checkTokenValidity($user->vk_token)) {
            return response()->json(['error' => 'VK token expired'], 401);
        }

        $message = "🎉 Добро пожаловать на наш сайт!\n\n" .
            "Вы успешно авторизовались через VK. " .
            "Теперь вы можете получать уведомления о важных событиях.";

        $result = $this->sendVKMessage(
            $user->vk_token,
            $user->vk_id,
            $message
        );

        if ($result) {
            return response()->json([
                'success' => true,
                'message' => 'Welcome message sent'
            ]);
        }

        return response()->json([
            'error' => 'Failed to send welcome message'
        ], 500);
    }

    /**
     * Отправить уведомление пользователю
     */
    public function sendNotification(User $user, $message)
    {
        if (!$user->vk_token) {
            Log::warning('VK token not found for user', ['user_id' => $user->id]);
            return false;
        }

        // Проверяем валидность токена
        if (!$this->checkTokenValidity($user->vk_token)) {
            Log::warning('VK token expired for user', ['user_id' => $user->id]);
            return false;
        }

        return $this->sendVKMessage(
            $user->vk_token,
            $user->vk_id,
            $message
        );
    }

    /**
     * Отправить сообщение в VK
     */
    private function sendVKMessage($accessToken, $userId, $message)
    {
        try {
            $response = Http::timeout(30)->post('https://api.vk.com/method/messages.send', [
                'access_token' => $accessToken,
                'user_id' => $userId,
                'message' => $message,
                'random_id' => rand(1, 1000000),
                'v' => '5.131'
            ]);

            $result = $response->json();

            if (isset($result['error'])) {
                Log::error('VK Message Error', [
                    'error' => $result['error'],
                    'user_id' => $userId
                ]);
                return false;
            }

            Log::info('VK Message sent successfully', [
                'user_id' => $userId,
                'message_id' => $result['response'] ?? 'unknown'
            ]);

            return true;

        } catch (\Exception $e) {
            Log::error('VK Message Exception', [
                'message' => $e->getMessage(),
                'user_id' => $userId
            ]);
            return false;
        }
    }

    /**
     * Проверить валидность токена
     */
    public function checkTokenValidity($accessToken)
    {
        try {
            $response = Http::timeout(10)->get('https://api.vk.com/method/users.get', [
                'access_token' => $accessToken,
                'v' => '5.131'
            ]);

            $data = $response->json();

            if (isset($data['error'])) {
                // Код ошибки 5 - недействительный токен
                if ($data['error']['error_code'] == 5) {
                    Log::warning('VK token expired', ['error' => $data['error']]);
                    return false;
                }

                // Другие ошибки (например, недостаточно прав)
                Log::warning('VK API error', ['error' => $data['error']]);
                return false;
            }

            return true;

        } catch (\Exception $e) {
            Log::error('VK Token check exception', [
                'message' => $e->getMessage()
            ]);
            return false;
        }
    }

    /**
     * Массовая отправка сообщений
     */
    public function sendBulkMessages(Request $request)
    {
        $request->validate([
            'message' => 'required|string|max:1000',
            'user_ids' => 'required|array',
            'user_ids.*' => 'integer'
        ]);

        $user = Auth::user();

        if (!$user->vk_token) {
            return response()->json(['error' => 'VK token not found'], 400);
        }

        if (!$this->checkTokenValidity($user->vk_token)) {
            return response()->json(['error' => 'VK token expired'], 401);
        }

        $results = [];
        foreach ($request->user_ids as $userId) {
            $results[$userId] = $this->sendVKMessage(
                $user->vk_token,
                $userId,
                $request->message
            );
        }

        return response()->json([
            'success' => true,
            'results' => $results
        ]);
    }

    /**
     * Получить информацию о текущем токене
     */
    public function getTokenInfo()
    {
        $user = Auth::user();

        if (!$user->vk_token) {
            return response()->json(['error' => 'VK token not found'], 400);
        }

        try {
            $response = Http::timeout(10)->get('https://api.vk.com/method/account.getProfileInfo', [
                'access_token' => $user->vk_token,
                'v' => '5.131'
            ]);

            $data = $response->json();

            if (isset($data['error'])) {
                return response()->json([
                    'error' => 'VK API error',
                    'details' => $data['error']
                ], 400);
            }

            return response()->json([
                'success' => true,
                'profile_info' => $data['response']
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'error' => 'Failed to get token info',
                'message' => $e->getMessage()
            ], 500);
        }
    }


    /**
     * Отправить сообщение от имени пользователя (user token)
     */
    public function sendFromUser($userId, $message)
    {
        $user = Auth::user();

        if (!$user->vk_token) {
            Log::warning('User VK token not found');
            return false;
        }

        try {
            $response = Http::asForm()->post('https://api.vk.com/method/messages.send', [
                'access_token' => $user->vk_token, // Токен пользователя, а не сервисный
                'user_id' => (int) $userId,
                'message' => $message,
                'random_id' => rand(1, 1000000),
                'v' => '5.131'
            ]);

            $result = $response->json();

            if (isset($result['error'])) {
                Log::error('VK User message error', ['error' => $result['error']]);
                return false;
            }

            Log::info('VK User message sent successfully');
            return true;

        } catch (\Exception $e) {
            Log::error('VK User message exception', ['message' => $e->getMessage()]);
            return false;
        }
    }

}

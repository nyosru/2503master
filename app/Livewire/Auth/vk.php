<?php

namespace App\Livewire\Auth;

use Illuminate\Support\Facades\Http;
use Livewire\Component;

use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;
use App\Models\User;


class vk extends Component
{


    public function redir()
    {

        $clientId = config('services.vk.client_id');
        $redirectUri = config('services.vk.redirect');

        $authUrl = "https://oauth.vk.com/authorize?" . http_build_query([
                'client_id' => $clientId,
                'redirect_uri' => $redirectUri,
                'response_type' => 'code',
                'scope' => 'email',
                'v' => '5.131',
                'state' => csrf_token(),
            ]);
//dd($authUrl);
        return redirect()->away($authUrl);
//
//        $url = Socialite::driver('vk')
//            ->scopes('email')
//            ->stateless()
//            ->redirect()
//            ->getTargetUrl();
//
//        https://oauth.vk.com/authorize?client_id=ВАШ_ID&redirect_uri=ВАШ_REDIRECT_URI&response_type=code&scope=email&state=123123
//
//        dd($url);
//        return redirect()->away($url);

//
//        return Socialite::driver('vk')
//            ->scopes(['email'])
//            ->redirect();
////        dd( Socialite::driver('vk')->redirect() );
//        return Socialite::driver('vk')->redirect();
    }


    public function handleVKCallback()
    {
        try {
            // Проверяем наличие кода
            if (!request()->has('code')) {
                throw new \Exception('Код авторизации не получен');
            }

            $code = request('code');

            logger()->info('VK Auth Code received: ' . $code);
            logger()->info('Full request: ', request()->all());

            // 1. Получаем access token
            $tokenResponse = Http::asForm()->post('https://oauth.vk.com/access_token', [
                'client_id' => config('services.vk.client_id'),
                'client_secret' => config('services.vk.client_secret'),
                'redirect_uri' => config('services.vk.redirect'),
                'code' => $code,
            ]);

            logger()->info('VK Token response: ', $tokenResponse->json());

            if ($tokenResponse->failed()) {
                throw new \Exception('Ошибка получения access token: ' . $tokenResponse->status());
            }

            $tokenData = $tokenResponse->json();

            // Проверяем ошибки от VK
            if (isset($tokenData['error'])) {
                throw new \Exception('VK Error: ' . $tokenData['error_description'] . ' (' . $tokenData['error'] . ')');
            }

            // 2. Получаем информацию о пользователе
            $userResponse = Http::get('https://api.vk.com/method/users.get', [
                'access_token' => $tokenData['access_token'],
                'user_id' => $tokenData['user_id'],
                'fields' => 'first_name,last_name,photo_max_orig,screen_name',
                'v' => '5.131',
            ]);

            $userData = $userResponse->json();
            logger()->info('VK User data: ', $userData);

            if (!isset($userData['response'][0])) {
                throw new \Exception('Данные пользователя не найдены');
            }

            $vkUser = $userData['response'][0];
            $email = $tokenData['email'] ?? ($tokenData['user_id'] . '@vk.com');
            $userId = $tokenData['user_id'];

            logger()->info('VK User ID: ' . $userId);
            logger()->info('VK Email: ' . $email);

            // 3. Поиск или создание пользователя
            $user = User::where('vk_id', $userId)->first();

            if (!$user) {
                // Ищем по email если он есть
                if ($email && $email !== $userId . '@vk.com') {
                    $user = User::where('email', $email)->first();
                }

                // Создаем нового пользователя
                if (!$user) {
                    $user = User::create([
                        'name' => trim($vkUser['first_name'] . ' ' . $vkUser['last_name']),
                        'email' => $email,
                        'password' => bcrypt(uniqid()),
                        'vk_id' => $userId,
                    ]);
                    logger()->info('New user created: ' . $user->id);
                } else {
                    // Обновляем существующего пользователя
                    $user->update(['vk_id' => $userId]);
                    logger()->info('Existing user updated: ' . $user->id);
                }
            }

            // 4. Логиним пользователя
            Auth::login($user, true);
            logger()->info('User logged in successfully: ' . $user->id);

            return redirect()->intended('/dashboard');

        } catch (\Exception $e) {
            logger()->error('VK Auth Error: ' . $e->getMessage());
            logger()->error('Stack trace: ' . $e->getTraceAsString());

            session()->flash('error', 'Ошибка авторизации через VK: ' . $e->getMessage());
            return redirect()->route('login');
        }
    }

    public function render()
    {
        return view('livewire.auth.vk');
    }
}

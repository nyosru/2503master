<?php

namespace App\Livewire\Board;

use App\Http\Controllers\BoardController;
use App\Http\Controllers\VkMessageController;
use App\Models\Board;
use App\Models\BoardUser;
use App\Models\Role;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\On;
use Nyos\Msg;

class BoardComponent extends Component
{

    use WithPagination;

    public function mount(){

        // если нет досок создаём доску первую
        $bb = new BoardController;
        $bb->startBoardBuilder();

    }

    protected function testVkMessage()
    {
        try {
            $vkAdminId = env('VK_ADMIN_ID');
            $serviceToken = env('VK_SERVICE_TOKEN');

            logger()->debug('VK Config Check', [
                'VK_ADMIN_ID' => $vkAdminId,
                'VK_SERVICE_TOKEN_exists' => !empty($serviceToken),
                'VK_SERVICE_TOKEN_length' => strlen($serviceToken ?? '')
            ]);

            if (empty($serviceToken) || empty($vkAdminId)) {
                logger()->warning('VK tokens not configured properly');
                return;
            }

            // Прямой HTTP запрос для тестирования
            $response = Http::asForm()->timeout(10)->post('https://api.vk.com/method/messages.send', [
                'access_token' => $serviceToken,
                'user_id' => (int) $vkAdminId,
                'message' => 'Тестовое сообщение от ' . config('app.name'),
                'random_id' => rand(1, 1000000),
                'v' => '5.131'
            ]);

            $result = $response->json();

            logger()->debug('Direct VK API Test', ['response' => $result]);

            if (isset($result['error'])) {
                logger()->error('Direct VK Error', ['error' => $result['error']]);
            } else {
                logger()->info('Direct VK Message sent successfully');
            }

        } catch (\Exception $e) {
            logger()->error('VK Test Exception', ['message' => $e->getMessage()]);
        }
    }
    #[On('user-added')]
    public function refreshBoardUsers()
    {
        $this->resetPage(); // Сброс пагинации (если нужно)
        $this->render();    // Полная перерисовка
    }

    public function delete($boardId)
    {
        Board::whereId($boardId)->delete();
        session()->flash('deleteOkMessage', 'Доска удалена!');
        return redirect()->route('board.list');
    }

    public function deleteBoardUser($id)
    {
        // Поиск записи
        $boardUser = BoardUser::whereId($id);

        // Проверка, существует ли запись
        if ($boardUser) {
            // Удаление записи
            $boardUser->delete();
            session()->flash('messageBU', 'Пользователь в Доске удалён!');
        } else {
            session()->flash('errorBU', 'Запись не найдена!');
        }
        $this->render();
//        session()->flash('messageBU', 'Пользователь в Доске удалён!');
    }

    public function offBoardUser($id)
    {
        // Поиск записи
        try {

            $boardUser = BoardUser::findOrFail($id);
            $boardUser->deleted = true;
            $boardUser->save();

            session()->flash('messageBU', 'Пользователь в Доске удалён!');
            $this->render();
        } catch (\Exception $e) {
            session()->flash('errorBU', 'Запись не найдена!'.$id);
        }
//        session()->flash('messageBU', 'Пользователь в Доске удалён!');
    }

    public function onBoardUser($id)
    {
//        $post = BoardUser::withTrashed()->find($id);
        $post = BoardUser::find($id);

        if (!$post) {
//            return redirect()->back()->with('errorBU', 'Запись не найдена.');
            session()->flash('errorBU', 'Запись не найдена!');
        }

        $post->deleted = false;
        $post->save();

//        return redirect()->back()->with('messageBU', 'Запись восстановлена.');
        session()->flash('messageBU', 'Пользователь в Доске восстановлен!');

        $this->render();
    }

    public function updatePaidStatus($boardId, $status)
    {
        $board = Board::findOrFail($boardId);
        $board->update(['is_paid' => $status]);
        session()->flash('message', 'Статус оплаты обновлён!');
    }

//    #[On('user-added')]ы
    public function render()
    {
//        $boards = Board::with('users')->paginate(10); // Загрузка связанных пользователей
//        $boards = Board::with('user')->paginate(10); // Загрузка связанных пользователей
        try {

            $user = Auth::user();
            $user_id = $user->id;

            if ($user->hasPermissionTo('р.Доски / видеть все доски') || $user->email == '1@php-cat.com' ) {
                $needUsers = false; // или false
            } else {
                $needUsers = true; // или false
            }

//            $boards = Board::get();

//        $boards = Board::when($needUsers, function ($query) use ($user_id) {
//            $query->whereHas('boardUsers', function ($q) use ($user_id)  {
//                $q->where('user_id', $user_id);
//            });
//        })->with([
//            'columns',
//            'boardUsers' => function ($query) {
//                $query->withTrashed();
//                $query->with([
//                    'role',
//                    'user',
//                ]);
//            }
//        ])
//            ->paginate(10)
//        ; // Загрузка связанных пользователей


            $boards = Board::whereHas('boardUsers', function ($query) use ($user) {
                $query->where('user_id', $user->id);
            })
                ->orWhere('admin_user_id', $user->id)
                ->with([
                    'domain',
                    'boardUsers' => function ($query) use ($user) {
//                        $query->where('user_id', $user->id);
//                        $query->withTrashed();
                        $query->with(['role']);

                    },
                    'invitations' => function ($query) {
                        $query->with(['role']);
                    }
                ])
                ->paginate(10);
            // Загрузка связанных пользователей

            $users = \App\Models\User::all();
            $roles = Role::all(); // Получаем все роли

            } catch (\Exception $e) {
            dd($e);
        }


        return view('livewire.board.board-component', compact('boards', 'users', 'roles'));
//        return view('livewire.board.board-component', compact('users', 'roles'));


    }

}


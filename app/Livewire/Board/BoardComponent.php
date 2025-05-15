<?php

namespace App\Livewire\Board;

use App\Models\Board;
use App\Models\BoardUser;
use App\Models\Role;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\On;

class BoardComponent extends Component
{
    use WithPagination;

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

    public function restoreBoardUser($id)
    {
        $post = BoardUser::withTrashed()->find($id);

        if (!$post) {
//            return redirect()->back()->with('errorBU', 'Запись не найдена.');
            session()->flash('errorBU', 'Запись не найдена!');
        }

        $post->restore();
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
        $boards = Board::with([
            'columns',
            'boardUsers' => function ($query) {
                $query->withTrashed();
                $query->with([
                    'role',
                    'user',
                ]);
            }
        ])
            ->paginate(10)
        ; // Загрузка связанных пользователей
        $users = \App\Models\User::all();
        $roles = Role::all(); // Получаем все роли
            } catch (\Exception $e) {
            dd($e);
        }
        return view('livewire.board.board-component', compact('boards', 'users', 'roles'));
//        return view('livewire.board.board-component', compact('users', 'roles'));
    }

}


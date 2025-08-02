<?php

namespace App\Livewire\Column;


use App\Http\Controllers\ColumnController;
use App\Models\LeedColumn;
use App\Models\Role;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class AddColumnFormMini extends Component
{

    public $column_id;
    public $column;

    public $roles;
    public $select_roles = [];

    public $addColumnName;
    public $afterColumnId;

    public $visibleAddForms;
    public bool $showModal = false;


    public function mount()
    {
//        $this->column_id = $column_id;
        $this->column = LeedColumn::whereId($this->column_id)->first();
        $this->roles = Role::where('board_id', $this->column->board_id)->get();
    }

    public
    function hiddenAddForm()
    {

//        dd($this->select_roles);

        if (env('APP_ENV', 'x') == 'local') {
            \Log::info('fn ' . __FUNCTION__, [__FILE__ . ' #' . __LINE__,]);
        }

        // Скрыть все формы
        if (!empty($this->visibleAddForms)) {
            $this->visibleAddForms = array_map(fn() => false, $this->visibleAddForms);
        }
    }


    public
    function showAddForm(int $columnId)
    {
        if (env('APP_ENV', 'x') == 'local') {
            \Log::info('fn ' . __FUNCTION__, [__FILE__ . ' #' . __LINE__], $columnId ?? '$columnId-');
        }

        $this->hiddenAddForm();

        if (!isset($this->visibleAddForms[$columnId])) {
            $this->visibleAddForms[$columnId] = true;
        } else {
            $this->visibleAddForms[$columnId] = ($this->visibleAddForms[$columnId] === true) ? false : true;
        }
    }

    public
    function addColumn(LeedColumn $column)
    {
        if (env('APP_ENV', 'x') == 'local') {
            \Log::info('fn ' . __FUNCTION__, [__FILE__ . ' #' . __LINE__,]);
        }

        $this->validate([
            'addColumnName' => 'required|string|max:255',
        ]);

        $user_id = Auth::id();
        $user = User::find($user_id);

// Создаем новый столбец
        $new_Column = LeedColumn::create([
            'name' => $this->addColumnName,
//    'user_id' => $user_id,
            'order' => ($column->order + 1),
            'board_id' => $user->current_board_id,
            'can_move' => true
        ]);

        $col = new ColumnController();
        $col->setVisibleColumnForRoles( $new_Column , $this->select_roles  );
        $col->reorderColumns();

        $this->addColumnName = '';
        $this->afterColumnId = null;

        $this->dispatch('loadColumns');

//        $this->hiddenAddForm();
        // скрываем форму после сохранения
        $this->showModal = false;
    }


//    /**
//     * Пересчитывает порядок столбцов для указанного пользователя.
//     * После добавления нового столбца, обновляется порядок всех последующих.
//     *
//     * @return void
//     */
//    protected
//    function reorderColumns()
//    {
//        if (env('APP_ENV', 'x') == 'local') {
//            \Log::info('fn ' . __FUNCTION__, ['#' . __LINE__ . ' ' . __FILE__]);
//        }
//
//        $user_id = Auth::id();
//
//        $columns = LeedColumn::orderBy('order') // Сортируем по текущему порядку
//        ->get();
//
//        $order = 1; // Начинаем с 1 для первого столбца
//        foreach ($columns as $column) {
//            // Присваиваем новый порядок для каждого столбца
//            $order = $order + 2;
//            $column->order = $order;
//            $column->save();
//        }
//    }

    public function render()
    {
        return view('livewire.column.add-column-form-mini');
    }
}

<?php

namespace App\Livewire\Cms2\Leed;

use App\Http\Controllers\LeedController;
use App\Http\Controllers\UserController;
use App\Models\LeedColumn;
use App\Models\LeedRecord;
use App\Models\User;
use DebugBar\DebugBar;

use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Url;
use Livewire\Component;

class LeedBoard extends Component
{

    // Настройка слушателя события
    protected $listeners = [
        // из формы симпл обновляем
        'refreshLeedBoardComponent' => '$refresh',
        // перетаскивание строк
        'updateColumnOrder' => 'updateColumnOrder',
        'loadColumns' => 'loadColumns',
        'setCurentBoard' => 'setCurentBoard',
//        'changeVisibleCreateOrderForm' => 'changeVisibleCreateOrderForm',
//        'render' => 'render',

//        'loadColumns2' => 'loadColumns2',

    ];

    public $columns = [];

    public $visibleAddForms = [];
    public $addColumnName = '';
    public $afterColumnId = '';
//    public $addColumnName;
//    public $afterColumnId;

//    public $columns;

// в конфиге
//    public $currentColumnId;

//    public $currentColumn;

// в конфиг
//    public $canMove;
//    public $canDelete;
//    public $typeOtkaz;

    public $reason = '';
    public $user_id;
    public $user;
    public $current_board = '';

    // ttckb прислали клиента к лиду (создали клиента)
    #[Url]
    public $return_leed;
    #[Url]
    public $client_to_leed;
    #[Url]
    public $order_to_leed;

    #[Url]
    public $search;


    public $showModalCreateOrder = [];
    public $board_id;


    public function setCurentBoard($id)
    {
//        dd( 'setCurentBoard'.$id);
        $this->current_board = $id;
    }

    public function changeVisibleCreateOrderForm($id)
    {
        $this->showModalCreateOrder[$id] = (isset($this->showModalCreateOrder[$id]) && $this->showModalCreateOrder[$id] === true) ? false : true;
    }


    public function mount()
    {

//        dd($this->board_id);

        $this->user_id = Auth::id();

        UserController::setCurentBoard($this->user_id, $this->board_id);

        $this->user = User::with([
            'boardUser',
            'boardUser.board',
            'boardUser.role',
        ])->findOrFail($this->user_id);

        if (env('APP_ENV', 'x') == 'local') {
            \Log::info('fn ' . __FUNCTION__, [__FILE__ . ' #' . __LINE__,]);
        }

        // если прислали нового клиента в лид, добавляем
        if (!empty($this->return_leed) && !empty($this->client_to_leed)) {

            $add_result = LeedController::addNewClientToLeed($this->return_leed, $this->client_to_leed);
            \Log::debug('fn ' . __FUNCTION__, [__FILE__ . ' #' . __LINE__, $add_result]);
            if ($add_result) {
                session()->flash('clientMessage', 'Клиент добавлен в Лид!');
            } else {
                session()->flash('clientError', 'Клиент не добавлен в Лид, повторите и затем обратитесь в поддержку');
            }
        }

        // если прислали новый ордер в лид, добавляем
        if (!empty($this->return_leed) && !empty($this->order_to_leed)) {
            $add_result = LeedController::addNewOrderToLeed($this->return_leed, $this->order_to_leed);
            \Log::debug('fn ' . __FUNCTION__, [__FILE__ . ' #' . __LINE__, $add_result]);
            if ($add_result) {
                session()->flash('clientMessage', 'Заказ добавлен в Лид!');
            } else {
                session()->flash('clientError', 'ЗАказ не добавлен в Лид, повторите и затем обратитесь в поддержку');
            }
        }

//        $this->loadColumns();
//        $this->resetForm();
    }




//    public function mount()
//    {
//        $this->columns = LeedColumn::all();
//        $this->resetForm();
//    }

// в конфиге
//    public function resetForm()
//    {
//        $this->currentColumnId = null;
//        $this->canMove =
//        $this->typeOtkaz =
//        $this->canDelete = false;
//    }

//    public function loadColumn( LeedColumn $currentColumn )

// в конфиге

//    public function columnConfig(LeedColumn $column)
//    {
////        $column = LeedColumn::findOrFail($columnId);
//        $this->currentColumnId = $column->id;
//        $this->canMove = $column->can_move;
//        $this->canDelete = $column->can_delete;
//        $this->typeOtkaz = $column->type_otkaz;
//    }

    public function s111endFormAddCommentOtkaz(LeedRecord $leed)
    {
        // Валидация данных
        $this->validate([
            'reason' => 'required|string|max:1000',
        ]);

        // Найти запись и сохранить причину отказа
//        $record = LeedRecord::find($recordId); // Предположим, что используется модель LeedRecord
        try {
//        if ($record) {
            $leed->otkaz_reason = $this->reason;
            $leed->save();

            // Сброс данных
            $this->reason = '';

            // Сообщение об успехе
            session()->flash('messageAddReasonOtkaz', 'Причина отказа сохранена успешно.');
//        } else {

        } catch (\Exception $ex) {
            session()->flash('errorAddReasonOtkaz', 'Ошибка пи добавлении причины ухода в отказ.');
        }
    }

    // в конфиге
//
//    protected $rules = [
//        'canMove' => 'boolean',
//        'canDelete' => 'boolean',
//        'typeOtkaz' => 'boolean',
//    ];
//    public function saveColumnConfig()
//    {
//        try {
//            $this->validate();
//
//            $column = LeedColumn::findOrFail($this->currentColumnId);
////            dump($column->toArray());
//            $column->update([
//
//                'can_move' => $this->canMove,
//                'can_delete' => $this->canDelete,
//
//                'type_otkaz' => $this->typeOtkaz,
//
//            ]);
//            $column->save();
////            dump($column->toArray());
////        $this->emit('closeModal');
//            $this->resetForm();
//            session()->flash('message', 'Настройки обновлены!');
//        } catch (\Exception $e) {
//            session()->flash('error', 'Ошибка при сохранении: ' . $e->getMessage());
//        }
//    }


    public function getCurrentBoard()
    {

        if (empty($this->user)) {
            $user_id = Auth::id();
            $this->user = User::with([
//                'roles'
                'boardUser',
                'boardUser.board',
                'boardUser.role',
            ])->findOrFail($user_id);
//            dd($user->toArray());
//            dd(__LINE__);

        } else {
////            dd(__LINE__);
////            if( empty($this->user->current_board_id) ){
//                $user2 = User::with([
////                'roles'
//                    'boardUser',
//])->findOrFail($this->user->id);
//                dd($user2->toArray());
////            }
//
//            dd($this->user->toArray());
        }


//        if (sizeof($this->user->boardUser) == 1) {
//            $this->current_board = $this->user->boardUser[0]->id;
////                dd($this->current_board );
//            $this->user->current_board_id = $this->current_board;
//            $this->user->save();
//        }

//        foreach ($this->user->boardUser as $boardUser) {
////            $this->current_board = $boardUser->board;
//        }

    }

    public function createColumnsForUser()
    {
        if (env('APP_ENV', 'x') == 'local') {
            \Log::info('fn ' . __FUNCTION__, [__FILE__ . ' #' . __LINE__,]);
        }

        $user_id = Auth::id();

        // Получаем столбцы с параметром head_type = true
        $headColumns = LeedColumn::where('user_id', '=', 0)->where('type_head', true)->orderBy('order', 'asc')->get();

        // Создаем столбцы для текущего пользователя
        // Добавляем все столбцы с новым user_id
        foreach ($headColumns as $column) {
            $newColumn = $column->replicate(); // Создаем копию записи
            $newColumn->user_id = $user_id; // Задаем новый user_id
            $newColumn->save(); // Сохраняем новую запись в базе данных
        }

        // Перезагружаем столбцы для отображения
        $this->loadColumns();
    }

    public
    function loadColumns2()
    {
        if (env('APP_ENV', 'x') == 'local') {
            \Log::info('leed-board ' . __FUNCTION__);
        }
    }

    public
    function loadColumns()
    {
        if (env('APP_ENV', 'x') == 'local') {
            \Log::info('fn ' . __FUNCTION__, [__FILE__ . ' #' . __LINE__,]);
        }

        $user_id = Auth::id();


//        $user = User::with('roles.columns')->find($user_id);
        try {

            if (empty($this->user)) {
                $this->user = User::with([
//                'roles'
                    'boardUser',
                    'boardUser.board',
                    'boardUser.role',
                ])->findOrFail($user_id);
//            dd($user->toArray());
            }

            $roleId = $this->user->roles[0]->id ?? '';

            $ss = $this->search;

            $this->columns = LeedColumn::orderBy('order', 'asc')
                ->where('board_id', $this->board_id)
                ->with(['records' => function ($query) use ($ss) {

                    if (!empty($ss)) {
                        $query->where(function ($q) use ($ss) {
                            $q->where('name', 'like', '%' . $ss . '%')
//                                ->orWhere('description', 'like', '%' . $ss . '%')
//                                ->orWhere('company', 'like', '%' . $ss . '%')
                                ->orWhere('comment', 'like', '%' . $ss . '%')
//                                ->orWhere('cooperativ', 'like', '%' . $ss . '%')
//                                ->orWhere('price', 'like', '%' . $ss . '%')s
//                                ->orWhere('platform', 'like', '%' . $ss . '%')
                                ->orWhere('base_number', 'like', '%' . $ss . '%')
                                ->orWhere('link', 'like', '%' . $ss . '%')
                                ->orWhere('obj_tender', 'like', '%' . $ss . '%')
                                ->orWhere('zakazchick', 'like', '%' . $ss . '%')
                                ->orWhere('mesto_dostavki', 'like', '%' . $ss . '%');
                        });
                    }
                    /*
//                            ->orWhere('status', 'like', '%' . $this->search . '%')
//                            ->orWhere('telegram', 'like', '%' . $this->search . '%')
//                            ->orWhere('whatsapp', 'like', '%' . $this->search . '%')
//                            ->orWhere('client_id', 'like', '%' . $this->search . '%')
//                            ->orWhere('client_supplier_id', 'like', '%' . $this->search . '%')
//                            ->orWhere('order_product_types_id', 'like', '%' . $this->search . '%')
//                            ->orWhere('leed_column_id', 'like', '%' . $this->search . '%')
//                            ->orWhere('user_id', 'like', '%' . $this->search . '%')
//                            ->orWhere('otkaz_reason', 'like', '%' . $this->search . '%')
////                            ->orWhere('leed_id', 'like', '%' . $this->search . '%')
//                            ->orWhere('budget', 'like', '%' . $this->search . '%')
//                            ->orWhere('phone', 'like', '%' . $this->search . '%')
//                            ->orWhere('fio', 'like', '%' . $this->search . '%')
//                            ->orWhere('fio2', 'like', '%' . $this->search . '%')
//                            ->orWhere('phone2', 'like', '%' . $this->search . '%')
//                            ->orWhere('date_start', 'like', '%' . $this->search . '%')
//                            ->orWhere('submit_before', 'like', '%' . $this->search . '%')
//                            ->orWhere('payment_due_date', 'like', '%' . $this->search . '%')
//                            ->orWhere('pay_day_every_year', 'like', '%' . $this->search . '%')
//                            ->orWhere('pay_day_every_month', 'like', '%' . $this->search . '%')
//                            ->orWhere('email', 'like', '%' . $this->search . '%')
//                            ->orWhere('post_day_ot', 'like', '%' . $this->search . '%')
//                            ->orWhere('post_day_do', 'like', '%' . $this->search . '%')
                    */

                    $query->withCount('notifications');

                    $query->with([

                        'column' => function ($query) {

                            $query->select(['id', 'board_id']);
                            $query->with([
                                'board' => function ($query) {
                                    $query->select(['id']);

                                    $query->with([
                                        'fieldSettings' => function ($query) {
                                            $query->select(['id',
                                                'field_name',
                                                'board_id'
                                            ]);
                                            $query->whereShowOnStart(true);
                                            $query->orderBy('sort_order', 'desc');

                                        }
//                                    ,'orderRequest','rename'
                                    ]);
                                }
                            ]);
                        }
//                        ,'orderRequest','rename'
                    ]);
                }])
                ->get();

        } catch (\Exception $ex) {
            $this->columns = [];
        }
    }


    public
    function hiddenAddForm()
    {
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
        LeedColumn::create([
            'name' => $this->addColumnName,
//    'user_id' => $user_id,
            'order' => ($column->order + 1),
            'board_id' => $user->current_board_id,
            'can_move' => true
        ]);


        // Пересчитываем порядок для всех столбцов пользователя
        $this->reorderColumns($user_id);

        $this->addColumnName = '';
        $this->afterColumnId = null;

        // Обновляем список столбцов
        $this->loadColumns();

        $this->hiddenAddForm();
    }


    public
    function deleteColumn(int $columnId)
    {
        if (env('APP_ENV', 'x') == 'local') {
            \Log::info('fn ' . __FUNCTION__, [__FILE__ . ' #' . __LINE__,]);
        }

        $user_id = Auth::id();

        $column = LeedColumn::with('records')->find($columnId);
        if ($column && $column->records->isEmpty()) {
            $column->delete();
            $this->loadColumns();
        }
    }

//    public function updateRecordColumn($recordId, $newColumnId)
//    {
//        dd($recordId, $newColumnId);
//
//        $record = LeedRecord::find($recordId);
//        if ($record && $newColumnId) {
//            $record->leed_column_id = $newColumnId;
//            $record->save();
//
//            // Перезагружаем колонки и записи
//            $this->loadColumns();
//        }

//    }

//
//    public function updateColumnOrder($draggedColumnId, $targetColumnId)
//    {
//        \Log::info(
//            'Обновление порядка колонок',
//            ['draggedColumnId' => $draggedColumnId, 'targetColumnId' => $targetColumnId]
//        );
//
//        $draggedColumn = LeedColumn::find($draggedColumnId);
//        $targetColumn = LeedColumn::find($targetColumnId);
//
//        if ($draggedColumn && $draggedColumn->can_move) {
//            $draggedColumn->order = $targetColumn->order + 1;
//            $draggedColumn->save();
//            $this->reorderColumns();
//        }
//
//        $this->loadColumns();
//    }


//    перенос строк
    public
    function reorderRecordInColumn($sourceRecordId, $targetColumnId)
    {
        if (env('APP_ENV', 'x') == 'local') {
            \Log::info('fn ' . __FUNCTION__, [__FILE__ . ' #' . __LINE__,]);
        }

        dd([$sourceRecordId, $targetColumnId]);
    }

    public
    function moveRecordBetweenColumns($sourceRecordId, $targetRecordId)
    {
        if (env('APP_ENV', 'x') == 'local') {
            \Log::info('fn ' . __FUNCTION__, [__FILE__ . ' #' . __LINE__,]);
        }

        echo $sourceRecordId, $targetRecordId;
//        dd([$sourceRecordId, $targetRecordId]);
    }

//
//    public function updateRecordColumn($recordId, $targetColumnId)
//    {
//        \Log::info('Перемещение записи', ['recordId' => $recordId, 'targetColumnId' => $targetColumnId]);
//
//        $record = LeedRecord::find($recordId);
//
//        if ($record && $record->leed_column_id !== $targetColumnId) {
//            $record->leed_column_id = $targetColumnId;
//            $record->save();
//
//            $this->loadColumns();
//        }
//    }
//


    /**
     * обработка переноса записи в новый столбец
     * @param $recordId
     * @param $newColumnId
     * @return void
     */
    public
    function updateRecordColumn($recordId, $newColumnId)
    {
        if (env('APP_ENV', 'x') == 'local') {
            \Log::info('updateRecordColumn', [$recordId, $newColumnId]);
        }

        try {
            $record = LeedRecord::findOrFail($recordId);

            $record->leed_column_id = $newColumnId;
            $record->save();

//            $this->loadColumns();

            $col = LeedColumn::whereId($newColumnId)->select(['id', 'board_id'])->first();
//dd($col->toArray());
            return $this->redirectRoute('leed', ['board_id' => $col->board_id]);

        } catch (\Exception $ex) {
            if (env('APP_ENV', 'x') == 'local') {
//                \Log::error('fn updateRecordColumn', [$ex->getMessage()]);
//                \Log::error('fn updateRecordColumn', [$ex]);
                \Log::error('fn updateRecordColumn', ['line' => __LINE__, $recordId, $newColumnId]);
            }
        }
    }


    /**
     * Пересчитывает порядок столбцов для указанного пользователя.
     * После добавления нового столбца, обновляется порядок всех последующих.
     *
     * @return void
     */
    protected
    function reorderColumns()
    {
        if (env('APP_ENV', 'x') == 'local') {
            \Log::info('fn ' . __FUNCTION__, ['#' . __LINE__ . ' ' . __FILE__]);
        }

        $user_id = Auth::id();

        $columns = LeedColumn::orderBy('order') // Сортируем по текущему порядку
        ->get();

        $order = 1; // Начинаем с 1 для первого столбца
        foreach ($columns as $column) {
            // Присваиваем новый порядок для каждого столбца
            $order = $order + 2;
            $column->order = $order;
            $column->save();
        }
    }

    public
    function updateColumnOrder($draggedColumnId, $targetColumnId)
    {
        if (env('APP_ENV', 'x') == 'local') {
            \Log::info('fn updateColumnOrder(' . $draggedColumnId . ', ' . $targetColumnId . ')');
        }

        $user_id = Auth::id();

        $columns = LeedColumn::orderBy('order')
            ->get();

        $draggedColumn = $columns->where('id', $draggedColumnId)->first();
        $targetColumn = $columns->where('id', $targetColumnId)->first();

        if ($draggedColumn && $targetColumn) {
            $draggedColumn->order = $targetColumn->order + 1;
            $draggedColumn->save();
            $this->reorderColumns();
            $this->loadColumns();
        }
    }


    public
    function render()
    {
        $this->getCurrentBoard();
        \Log::info('рендер leed-board');
//        Debugbar::addMessage('Пример сообщения', 'debug');
        $this->loadColumns();
        return view('livewire.cms2.leed.leed-board');
    }

}

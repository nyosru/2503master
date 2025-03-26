<?php

namespace App\Livewire\Cms2\Leed;

use App\Http\Controllers\LeedController;
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

    // ttckb прислали клиента к лиду (создали клиента)
    #[Url]
    public $return_leed;
    #[Url]
    public $client_to_leed;
    #[Url]
    public $order_to_leed;


    public $showModalCreateOrder = [];


    public function changeVisibleCreateOrderForm($id)
    {
        $this->showModalCreateOrder[$id] = (isset($this->showModalCreateOrder[$id]) && $this->showModalCreateOrder[$id] === true) ? false : true;
    }

    public function mount()
    {
        $this->user_id = Auth::id();

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

    public function loadColumns2()
    {
        if (env('APP_ENV', 'x') == 'local') {
            \Log::info('leed-board ' . __FUNCTION__);
        }
    }

    public function loadColumns()
    {
        if (env('APP_ENV', 'x') == 'local') {
            \Log::info('fn ' . __FUNCTION__, [__FILE__ . ' #' . __LINE__,]);
        }

        $user_id = Auth::id();

//        $user = User::with('roles.columns')->find($user_id);
        try {
            $user = User::with('roles')->findOrFail($user_id);
            $roleId = $user->roles[0]->id;
//        dd($user->toArray());
//        dd(
//            [
//            $user->roles[0]->id,
//            $user->roles[0]->name,
//                ]
//        );

            if (1 == 2) {
// Получаем все столбцы, связанные с указанной ролью
                $this->columns = LeedColumn::orderBy('order', 'asc')
                    ->with([
                        'records' => function ($query) use ($user_id) {
                            $query->whereUserId($user_id); // Получаем только последнюю запись о передаче
                        },
                        'records.client',

//            'records.userAssignments',
//            'records.transfers' => function ($query) {
//                $query->latest()->take(1); // Получаем только последнюю запись о передаче
//                },
//            'records.transfers.toUser',
                    ])->whereHas('roles', function ($query) use ($roleId) {
                        $query->where('roles.id', $roleId);
                    })->get();
            }

// Получаем все столбцы, связанные с указанной ролью

            $this->columns = LeedColumn::orderBy('order', 'asc')
                ->with([
                    'records' => function ($query) use ($user, $user_id) {
                        if (
                            !$user->hasAnyPermission('Полный//доступ', 'р.Лиды / видеть все лиды')
                        ) {
                            $query->whereUserId($user_id)
                                // Добавляем условие для выбора записей с user_id = 3 в LeadUserAssignment
                                ->orWhereHas('userAssignments', function ($assignmentQuery) use ($user_id) {
                                    $assignmentQuery->where('user_id', $user_id);
                                });; // Получаем только последнюю запись о передаче
                        }

                        $query->withCount([
                            'leedComments',
                            'leedComments as unread_comments_from_others_user' => function ($q) use ($user_id) {
                                $q->where('user_id', '!=', $user_id)
                                    ->where('readed', false);
                            }
                        ]);

                        $query->withCount([
                            'orders as leed_orders_hot_count' => function ($query) use ($user_id) {
                                $query->where('status', 'новая')
//                                    ->where('user_id', $user_id)
                                    ->where('reminder_at', '<', now()); // Например, считать только активные комментарии
                            }
                        ]);

                        $query->withCount([
                            'orders as leed_orders_hot_from_other_count' => function ($query) use ($user_id) {
                                $query->where('status', 'новая')
//                                    ->where('user_worder_id', $user_id)
//                                    ->where(function ($query) {
//                                        $query
//                                            ->where('reminder_at', '<', now())
//                                            ->orWhere('reminder_at', null);
//                                    })
//                                ->where('reminder_at', '<', now())
                                ; // Например, считать только активные комментарии
                            }
                        ]);
                    },
                    'records.client' => function ($query) {
                        $query->select(['id', 'name_f', 'name_i', 'physical_person']
                        ); // Выбираем только нужные поля для client
                    },
                    'records.order' => function ($query) {
                        $query->select(['id', 'name', 'price']); // Выбираем только нужные поля
                    },

                    'records.userAssignments',

                    'records.user' => function ($query) {
                        $query->withTrashed()->select(['id', 'name', 'deleted_at']); // Выбираем только нужные поля
                        $query->with([
                            'roles' => function ($q2) {
                                $q2->select('name')->first();
                            }
                        ]);
                    },
                    'records.leedComments' => function ($query) {
                        $query->select(['id']); // Выбираем только нужные поля
                    },

                ])
//                ->whereHas('roles', function ($query) use ($user, $roleId) {
//                    if (!$user->hasPermissionTo('Полный//доступ')) {
//                        $query->where('roles.id', $roleId);
//                    }
//                })
                ->get();


//// Вывод результата
//        if ($columns->isNotEmpty()) {
//            foreach ($columns as $column) {
//                echo $column->name . "\n"; // Или другой вывод информации о столбце
//            }
//        } else {
//            echo "Нет столбцов, связанных с ролью.";
//        }


//        $columns = Role::with('columns')
//            ->find($roleId)
//            ->columns;

            if (1 == 2) {
                $this->columns = LeedColumn::where(function ($query) use ($user_id) {
//            $query->whereUserId($user_id);
                })
                    ->with([
                        'records' => function ($query) use ($user_id) {
                            $query->whereHas('userAssignments', function ($subQuery) use ($user_id) {
                                $subQuery->where('user_id', $user_id)
                                    ->where('created_at', function ($subQuery) {
                                        $subQuery->select('created_at')
                                            ->from('lead_user_assignments')
                                            ->whereColumn('lead_user_assignments.lead_id', 'leed_records.id')
                                            ->orderBy('created_at', 'desc')
                                            ->limit(1);
                                    });
                            });
                        }
                    ])
                    ->orderBy('order')  // Сортировка по полю 'order'
                    ->get();
            }

        } catch (\Exception $ex) {
            $this->columns = [];
        }
    }


    public function hiddenAddForm()
    {
        if (env('APP_ENV', 'x') == 'local') {
            \Log::info('fn ' . __FUNCTION__, [__FILE__ . ' #' . __LINE__,]);
        }

        // Скрыть все формы
        if (!empty($this->visibleAddForms)) {
            $this->visibleAddForms = array_map(fn() => false, $this->visibleAddForms);
        }
    }

    public function showAddForm(int $columnId)
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

    public function addColumn(LeedColumn $column)
    {
        if (env('APP_ENV', 'x') == 'local') {
            \Log::info('fn ' . __FUNCTION__, [__FILE__ . ' #' . __LINE__,]);
        }

        $this->validate([
            'addColumnName' => 'required|string|max:255',
        ]);

        $user_id = Auth::id();

        // Создаем новый столбец
        LeedColumn::create([
            'name' => $this->addColumnName,
//            'user_id' => $user_id,
            'order' => ($column->order + 1),
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


    public function deleteColumn(int $columnId)
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
    public function reorderRecordInColumn($sourceRecordId, $targetColumnId)
    {
        if (env('APP_ENV', 'x') == 'local') {
            \Log::info('fn ' . __FUNCTION__, [__FILE__ . ' #' . __LINE__,]);
        }

        dd([$sourceRecordId, $targetColumnId]);
    }

    public function moveRecordBetweenColumns($sourceRecordId, $targetRecordId)
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
    public function updateRecordColumn($recordId, $newColumnId)
    {
        if (env('APP_ENV', 'x') == 'local') {
            \Log::info('updateRecordColumn', [$recordId, $newColumnId]);
        }

        try {
            $record = LeedRecord::findOrFail($recordId);

            $record->leed_column_id = $newColumnId;
            $record->save();

//            $this->loadColumns();
            return $this->redirectRoute('leed');
        } catch (\Exception $ex) {
            if (env('APP_ENV', 'x') == 'local') {
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
    protected function reorderColumns()
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

    public function updateColumnOrder($draggedColumnId, $targetColumnId)
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


    public function render()
    {
//        \Log::info('рендер leed-board');
//        Debugbar::addMessage('Пример сообщения', 'debug');
        $this->loadColumns();
        return view('livewire.cms2.leed.leed-board');
    }

}

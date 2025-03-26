<?php

namespace App\Livewire\Cms2\Leed;

use App\DTOs\NotificationDTO;
use App\Models\LeedRecordOrder;
use App\Models\Notification;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class ItemOrder extends Component
{

    public $leed_record_id;
    public $items;
    public $users;
    public $show_type = 'job'; //all|job|finish
    protected $listeners = [
        // из формы симпл обновляем
        'refreshLeedBoardOrderComponent' => '$refresh',
//        'refreshLeedBoardComponent' => '$refresh',
//    'loadData'
        // перетаскивание строк
//        'updateColumnOrder' => 'updateColumnOrder',
    ];

    public function mount($leed_record_id)
    {

        $this->leed_record_id = $leed_record_id;
        $this->loadData();
    }


    public function setShowType($new)
    {
        $this->show_type = $new;
        $this->loadData();
    }

    public function loadData()
    {
        $this->items = LeedRecordOrder::where('leed_record_id', $this->leed_record_id)
            ->when($this->show_type !== 'all', function ($query) {
                $query->when($this->show_type === 'job', function ($q) {
                    $q->where('status', 'новая');
                })
                    ->when($this->show_type === 'finish', function ($q) {
                        $q->where('status', '!=', 'новая');
                    });
            })
            ->with([
                'user' => function ($query) {
                    $query->withTrashed()->select('id', 'name','deleted_at');
                    $query->with([
                        'roles' => function ($q2) {
                            $q2->select('name')->first();
                        },
                        'staff' => function ($query) {
                            $query->select(
                                'name',
                                'department',
                            );
                        }
                    ]);
                },
//                'user.staff' => function ($query) {
//                    $query->select(
//                        'name',
//                        'department',
////                        'phone'
//                    );
//                },

                'userWorker' => function ($query) {
                    $query->withTrashed()->select('id', 'name','deleted_at');
                    $query->with([
                        'roles' => function ($q2) {
                            $q2->select('name')->first();
                        },
                        'staff' => function ($query) {
                            $query->select(
                                'name',
                                'department',
                            );
                        }
                    ]);
                },
                'transfers' => function ($query) {
                    $query->with(['user' => function ($query) {
                        $query->withTrashed()->select('id', 'name','deleted_at');
                        $query->with(['roles']);
                    }]);
                },

//                'userWorker.staff' => function ($query) {
//                    $query->select(
//                        'name',
//                        'department',
////                        'phone'
//                    );
//                },

            ])
//            ->orderByRaw('close_at IS NULL DESC') // Сначала те, где close_at не NULL
//            ->orderBy('close_at','asc') // Сначала те, где close_at не NULL
            ->orderBy('created_at', 'asc')
            ->get();
//        $u = User::with('staff');
//        $this->users = User::with('staff')->get()->toArray();

    }

    public function render()
    {
        return view('livewire.cms2.leed.item-order', ['items' => $this->items]);
    }

//    public $leed_record_id;
//    public $showFomrAdd = false;
//    public $items;
//    public $newOrderDesc = '';
//    public $notificateDate = '';
//    public $notificateTime = '';
//
//    public function mount(){
//        $this->loadData();
//    }
//
//    public function loadData(){
//
//        $this->items = LeedRecordOrder::with('notifications')->whereLeedRecordId($this->leed_record_id)
//            //        where('leed_record_id','=',$this->leed_record_id)
//            ->orderBy('created_at','desc')
////            ->paginate(7)
//            ->get()
//        ;
//    }
//
//    public function changeShowFomrAdd(){
//        $this->showFormAdd = !$this->showFormAdd;
//        $this->newOrderDesc = '';
//    }
//
//    protected $rules = [
//        'newOrderDesc' => 'required|string|max:500',
//    ];
//
//    public function add()
//    {
//        $this->validate();
//
//        $new_leed_order = LeedRecordOrder::create([
//            'text' => $this->newOrderDesc,
//            'created_user_id' => auth()->id(),
//            'leed_record_id' => $this->leed_record_id,
//            'created_at' => now(),
//        ]);
//
//        if (env('APP_ENV', 'x') == 'local') {
//            \Log::info('notifi new leed_order ' . __FUNCTION__.' #'.__LINE__, [$new_leed_order, $new_leed_order['id']]);
//        }
//// Проверка наличия даты уведомления
//        if (!empty($this->notificateDate)) {
//            // Создание DTO для уведомления
//            $notificationDTO = new NotificationDTO([
//                'title' => 'Уведомление о новой задаче: '.$this->newOrderDesc,
//                'user_id' => auth()->id(), // Используйте ID текущего пользователя
////                'leed_record_order_id' => $new_leed_order->id, // ID только что созданного заказа
//                'leed_record_order_id' => $new_leed_order['id'], // ID только что созданного заказа
//                'reminder_date' => $this->notificateDate,
//                'reminder_time' => $this->notificateTime,
//                'remind_in_telegram' => ( $this->remind_in_telegram ?? false ), // Или true, в зависимости от логики
//            ]);
//
//            if (env('APP_ENV', 'x') == 'local') {
//                \Log::info('notifi ' . __FUNCTION__.' #'.__LINE__, [$notificationDTO->toArray()]);
//            }
//
//            // Создание нового уведомления
//            try {
//                $new = Notification::create($notificationDTO->toArray());
//                if (env('APP_ENV', 'x') == 'local') {
//                    \Log::info('notifi add ' . __FUNCTION__.' #'.__LINE__, [$new]);
//                }
//            }catch( \Exception $ex ){
////                dd( $ex->getMessage() );
//                if (env('APP_ENV', 'x') == 'local') {
//                    \Log::error('notifi ' . __FUNCTION__.' #'.__LINE__, $ex);
//                }
//
//            }
//        }
//
////        session()->flash('message', 'Комментарий успешно добавлен!');
//        session()->flash('msgLeedOrder', 'Успешно добавлена!');
//
//        $this->showFomrAdd = false;
////        $this->newComment = ''; // Очистка поля
//
//        $this->loadData();
//    }
//
//
//    public function render()
//    {
////        return view('livewire.cms2.leed.item-order',['items'=>$this->items]);
//        return view('livewire.cms2.leed.item-order');
//    }
}

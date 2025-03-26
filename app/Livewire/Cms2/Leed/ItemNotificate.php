<?php

namespace App\Livewire\Cms2\Leed;

use App\Models\LeedRecordOrder;
use App\Models\Notification;
use Livewire\Component;

class ItemNotificate extends Component
{
    public $leed_record_id;
    public $notifications;
    public $showFomrAdd = false;

    public function mount()
    {
        $this->loadNotifications();
    }


//    public function getNotificationsForLeedRecord($leedRecordId)
//    {
//        // Получаем все уведомления для заказов, связанных с указанным leed_record_id
//        $notifications = Notification::whereHas('leedOrder', function ($query) use ($leedRecordId) {
//            $query->where('leed_record_id', $leedRecordId);
//        })->get();
//
//        return $notifications; // Возвращаем уведомления
//    }


    public function loadNotifications()
    {

        // Получаем уведомления для текущего leed_record_id
//        $this->notifications = Notification::where('leed_order_id', $this->leed_record_id)->get();
//        $this->notifications = Notification::whereHas('leedOrder', function ($query) {
//            $query->where('leed_record_id', $this->leed_record_id);
//        })->get();
//        $this->notifications = $this->getNotificationsForLeedRecord($this->leed_record_id);
//        $leedRecordId = $this->leed_record_id;
//        $this->notifications =  Notification::whereHas('leedOrder', function ($query) use ($leedRecordId) {
//            $query->where('leed_record_id', $leedRecordId);
//        })->get();;
        // Получаем все заказы, связанные с leed_record_id
        $leedOrders = LeedRecordOrder::where('leed_record_id', $this->leed_record_id)->pluck('id');
        // Получаем уведомления для этих заказов
        $this->notifications = Notification::whereIn('leed_record_order_id', $leedOrders)->get();
//        $this->notifications = Notification::newest()->get();
//        $this->notifications = Notification::all();
//        $this->notifications = Notification::orderBy('created_at','asc')->get();
    }

//    public function mount(){
//        $this->loadData();
//    }
//
//    public function loadData(){
//
//        $this->items = Notification::whereLeedOrderId($this->leed_record_id)
//            //        where('leed_record_id','=',$this->leed_record_id)
//            ->orderBy('created_at','desc')
////            ->paginate(7)
//            ->get()
//        ;
//    }

    public function render()
    {
        return view('livewire.cms2.leed.item-notificate', [
            'notifications' => $this->notifications,
        ]);
    }
}

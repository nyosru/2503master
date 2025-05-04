<?php

namespace App\Livewire\Leed;

use App\Models\LeedNotification;
use App\Models\LeedRecord;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class NotificationComponent extends Component
{
//    public LeedRecord $leed;
    public $leed_id;

    public $notifications;

    // Поля формы для редактирования/добавления
    public $notificationId = null;
    public $message;
    public $once_at;
    public $weekly_day;
    public $weekly_time;
    public $monthly_day;
    public $monthly_time;
    public $yearly_day;
    public $yearly_month;
    public $yearly_time;
    public $telegram_id;
    public $user_id;

//    public $telegramUsers;
    public $users;

    public $showForm = false;

    protected $rules = [
        'message' => 'required|string|max:1000',

        'once_at' => 'nullable|date',

        'weekly_day' => 'nullable|integer|min:0|max:6',
        'weekly_time' => 'nullable|date_format:H:i',

        'monthly_day' => 'nullable|integer|min:1|max:31',
        'monthly_time' => 'nullable|date_format:H:i',

        'yearly_day' => 'nullable|integer|min:1|max:31',
        'yearly_month' => 'nullable|integer|min:1|max:12',
        'yearly_time' => 'nullable|date_format:H:i',

//        'telegram_id' => 'nullable|exists:telegram_users,id',
        'user_id' => 'nullable|exists:users,id',
    ];

    public function mount(LeedRecord $leed)
    {
        $this->leed = $leed;
        $this->loadNotifications();

//        $this->telegramUsers = TelegramUser::all();
        $this->users = User::all();
    }

    public function loadNotifications()
    {
//        dd($this->leed);
//        $ii = $this->leed->id;
        $ii = $this->leed_id;
        $this->notifications = LeedNotification::whereLeedId($ii)
            ->orderBy('created_at', 'desc')
            ->get();
    }

    public function showCreateForm()
    {
        $this->resetForm();
        $this->showForm = !$this->showForm;
    }

    public function editNotification($id)
    {
        $notification = LeedNotification::findOrFail($id);

        $this->notificationId = $notification->id;
        $this->message = $notification->message;
        $this->once_at = $notification->once_at ? \Carbon\Carbon::parse($notification->once_at)->format('Y-m-d\TH:i') : null;
        $this->weekly_day = $notification->weekly_day;
        $this->weekly_time = $notification->weekly_time ? \Carbon\Carbon::parse($notification->weekly_time)->format('H:i') : null;
        $this->monthly_day = $notification->monthly_day;
        $this->monthly_time = $notification->monthly_time ? \Carbon\Carbon::parse($notification->monthly_time)->format('H:i') : null;
        $this->yearly_day = $notification->yearly_day;
        $this->yearly_month = $notification->yearly_month;
        $this->yearly_time = $notification->yearly_time ? \Carbon\Carbon::parse($notification->yearly_time)->format('H:i') : null;
        $this->telegram_id = $notification->telegram_id;
        $this->user_id = $notification->user_id;

        $this->showForm = true;
    }

    public function saveNotification()
    {
        $this->validate();

        $data = [
            'leed_id' => $this->leed_id,
            'message' => $this->message,
            'once_at' => $this->once_at,
            'weekly_day' => $this->weekly_day,
            'weekly_time' => $this->weekly_time,
            'monthly_day' => $this->monthly_day,
            'monthly_time' => $this->monthly_time,
            'yearly_day' => $this->yearly_day,
            'yearly_month' => $this->yearly_month,
            'yearly_time' => $this->yearly_time,
//            'telegram_id' => $this->telegram_id,
            'user_id' => $this->user_id,
        ];

        if ($this->notificationId) {
            LeedNotification::where('id', $this->notificationId)->update($data);
            session()->flash('message', 'Оповещение обновлено');
        } else {
            LeedNotification::create($data);
            session()->flash('message', 'Оповещение добавлено');
        }

        $this->resetForm();
        $this->loadNotifications();
        $this->showForm = false;
    }

    public function deleteNotification($id)
    {
        LeedNotification::findOrFail($id)->delete();
        session()->flash('message', 'Оповещение удалено');
        $this->loadNotifications();
    }

    public function resetForm()
    {
        $this->notificationId = null;
        $this->message = '';
        $this->once_at = null;
        $this->weekly_day = null;
        $this->weekly_time = null;
        $this->monthly_day = null;
        $this->monthly_time = null;
        $this->yearly_day = null;
        $this->yearly_month = null;
        $this->yearly_time = null;
        $this->telegram_id = null;
        $this->user_id = null;
    }

    public function render()
    {
        return view('livewire.leed.notification-component');
    }
}

<?php

namespace App\Jobs;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use App\Models\LeedNotification;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;


class ProcessLeedNotificationJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected LeedNotification $notification;

    /**
     * Create a new job instance.
     */
    public function __construct(LeedNotification $notification)
    {
        $this->notification = $notification;
    }

    public function handle()
    {
        // Логика обработки уведомления, например, вызов в NotificationController
        // Пример:
        // $controller = app(\App\Http\Controllers\NotificationController::class);
        // $controller->sendNotification($this->notification);
    }

}

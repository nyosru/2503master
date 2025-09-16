<?php

namespace App\Traits;
use App\Http\Controllers\VkMessageController;

trait SendsVkNotifications
{
    public function sendVkMessage($message)
    {
        $controller = new VkMessageController();
        return $controller->sendNotification($this, $message);
    }
}

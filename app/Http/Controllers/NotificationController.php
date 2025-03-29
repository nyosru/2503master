<?php

namespace App\Http\Controllers;

use App\Models\Notification;
use Illuminate\Http\Request;

class NotificationController extends Controller
{
    public function store(Request $request)
    {
        // Валидация входящих данных
        $validatedData = $request->validate([
            'title' => 'required|string|max:255',
            'user_id' => 'required|exists:users,id',
            'leed_order_id' => 'nullable|exists:leed_record_orders,id',
            'reminder_date' => 'nullable|date',
            'reminder_time' => 'nullable|date_format:H:i',
            'remind_in_telegram' => 'boolean',
        ]);

        // Создание DTO
        $notificationDTO = new NotificationDTO($validatedData);

        // Создание новой записи Notification
        $notification = Notification::create([
            'title' => $notificationDTO->title,
            'user_id' => $notificationDTO->user_id,
            'leed_order_id' => $notificationDTO->leed_order_id,
            'reminder_date' => $notificationDTO->reminder_date,
            'reminder_time' => $notificationDTO->reminder_time,
            'remind_in_telegram' => $notificationDTO->remind_in_telegram,
        ]);

        return response()->json($notification, 201);
    }
}

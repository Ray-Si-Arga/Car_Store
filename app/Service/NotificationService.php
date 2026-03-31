<?php

namespace App\Service;

use App\Models\Notification;

class NotificationService
{
    public function sendNotification($user_id, $link, $title, $message, $category)
    {
        Notification::create([
            'user_id' => $user_id,
            'link' => $link,
            'category' => $category,
            'title' => $title,
            'message' => $message,
            'is_read' => false,
        ]);
    }
}
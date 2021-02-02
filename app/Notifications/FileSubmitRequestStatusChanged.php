<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Notification;

class FileSubmitRequestStatusChanged extends Notification
{
    use Queueable;

    public function __construct($user, $status)
    {
        $this->user = $user;
        $this->status = $status;
    }

    public function via($notifiable)
    {
        return ['database'];
    }

    public function toArray($notifiable)
    {
        return [
            'user_id' => $this->user->id,
            'html' => view('notifications.files.submit-request-status', [
                'status' => $this->status
            ])->render()
        ];
    }
}
<?php

namespace App\Notifications\Admin;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Notification;

class FileSubmitRequest extends Notification
{
    use Queueable;

    public function __construct($file)
    {
        $this->file = $file;
    }

    public function via($notifiable)
    {
        return ['database'];
    }

    public function toArray($notifiable)
    {
        return [
            'icon' => 'file',
            'file_id' => $this->file->id
        ];
    }
}
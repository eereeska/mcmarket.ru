<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    const ADMIN_FILE_SUBMIT_REQUEST = 1;

    protected $casts = [
        'data' => 'json'
    ];
    
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
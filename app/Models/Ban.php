<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Ban extends Model
{
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function by()
    {
        return $this->belongsTo(User::class, 'banned_by_id');
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserFollower extends Model
{
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    
    public function follower()
    {
        return $this->belongsTo(User::class, 'follower_id');
    }
}
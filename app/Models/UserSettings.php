<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserSettings extends Model
{
    public $timestamps = false;

    protected $fillable = [
        'user_id',
        'about',
        'is_search_engine_visible',
        'is_online_status_visible',
        'is_activity_visible'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
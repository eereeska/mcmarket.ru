<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Notification
 *
 * @property-read \App\Models\User $user
 * @method static \Illuminate\Database\Eloquent\Builder|Notification newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Notification newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Notification query()
 * @mixin \Eloquent
 */
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
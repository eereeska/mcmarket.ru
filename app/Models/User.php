<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    protected $fillable = [
        'name',
        'password'
    ];

    protected $hidden = [
        'password',
        'remember_token'
    ];

    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
        'last_seen_at' => 'datetime'
    ];

    public function settings()
    {
        return $this->belongsTo(UserSettings::class);
    }

    public function getAvatar()
    {
        return asset('avatars/' . $this->avatar);
    }

    public function getInitials($length = 1)
    {
        preg_match_all('#([A-Z0-9]+)#', strtoupper($this->name), $capitals);

        if (count($capitals[1]) >= $length) {
            return substr(implode('', $capitals[1]), 0, $length);
        }

        return strtoupper(substr($this->name, 0, $length));
    }

    public function isOnline()
    {
        return is_null($this->last_seen_at) ? true : $this->last_seen_at->lt(now()->addMinutes(5));
    }
}
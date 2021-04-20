<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use HasFactory;
    
    protected $fillable = [
        'name',
        'password',
        'ip'
    ];

    protected $hidden = [
        'password',
        'remember_token',
        'ip'
    ];

    protected $dates = [
        'last_seen_at',
        'email_verified_at',
        'updated_at',
        'created_at'
    ];

    public function hasPermission(string $permission)
    {
        return (bool) $this->permissions()->where('name', $permission)->count();
    }

    public function settings()
    {
        return $this->hasOne(UserSettings::class, 'user_id', 'id');
    }

    public function files()
    {
        return $this->belongsToMany(File::class);
    }

    public function purchasedFiles()
    {
        return $this->belongsToMany(File::class, 'file_purchases', 'user_id', 'id');
    }

    public function followers()
    {
        return $this->belongsToMany(User::class, 'user_followers');
    }

    public function hasPurchasedFile($file)
    {
        return FilePurchase::where([
            'file_id' => $file->id,
            'user_id' => $this->id
        ])->exists();
    }

    public function getAvatar()
    {
        return $this->avatar ? asset('avatars/' . $this->avatar) : asset('images/default_avatar.svg');
    }

    public function getInitials($length = 1)
    {
        preg_match_all('#([A-Z0-9]+)#', strtoupper($this->name), $capitals);

        if (count($capitals[1]) >= $length) {
            return substr(implode('', $capitals[1]), 0, $length);
        }

        return strtoupper(substr($this->name, 0, $length));
    }

    public function getOnlineStatus()
    {
        if (is_null($this->last_seen_at)) {
            return 'Оффлайн';
        }
        
        if ($this->last_seen_at->gt(now()->subMinutes(5))) {
            return 'Сейчас онлайн';
        } else {
            return 'Был(-а) онлайн ' . $this->last_seen_at->ago();
        }
    }
}
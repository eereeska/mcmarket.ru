<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    protected $fillable = [
        'name'
    ];

    protected $hidden = [
        'password',
        'remember_token',
        'ip'
    ];

    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
        'last_seen_at' => 'datetime'
    ];

    public function role()
    {
        return $this->belongsTo(Role::class);
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

    public function groups()
    {
        return $this->belongsToMany(Group::class, 'group_members');
    }

    public function ownGroups()
    {
        return $this->belongsToMany(Group::class, null, 'id', 'owner_id');
    }

    public function participiedConversations()
    {
        return $this->belongsToMany(Conversation::class, 'conversation_participants', 'user_id', 'id');
    }

    public function conversations()
    {
        return $this->hasMany(ConversationParticipant::class)->pluck('conversation');
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
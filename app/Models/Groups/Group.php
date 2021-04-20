<?php

namespace App\Models\Groups;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;

class Group extends Model
{
    protected $fillable = [
        'owner_id',
        'name',
        'slug',
        'description',
        'type'
    ];

    protected $casts = [
        'cover_updated_at' => 'datetime'
    ];

    public function owner()
    {
        return $this->belongsTo(User::class);
    }

    public function members()
    {
        return $this->belongsToMany(GroupMember::class, 'group_members', 'id', 'group_id');
    }

    public function getCover()
    {
        return asset('covers/groups/' . $this->id . '.png') . '?' . $this->cover_updated_at->getTimeStamp();
    }
}
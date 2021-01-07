<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;

class Thread extends Model
{
    public function author()
    {
        return $this->belongsTo(User::class);
    }

    public function tags()
    {
        return $this->hasMany(ThreadTag::class)->with('tag');
    }

    public function replies()
    {
        return $this->hasMany(ThreadReply::class);
    }
}
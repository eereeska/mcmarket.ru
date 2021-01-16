<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;

class Thread extends Model
{
    public function taggabble()
    {
        return $this->morphTo();
    }

    public function author()
    {
        return $this->belongsTo(User::class);
    }

    public function tags()
    {
        // return $this->morphToMany(Tag::class, 'thread_tag', null, 'thread_id')->orderBy('title');
        return $this->belongsToMany(Tag::class, 'thread_tags');
    }

    public function replies()
    {
        return $this->hasMany(ThreadReply::class);
    }
}
<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\ThreadReply
 *
 * @property-read \App\Models\User $author
 * @property-read \App\Models\Thread $thread
 * @method static \Illuminate\Database\Eloquent\Builder|ThreadReply newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ThreadReply newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ThreadReply query()
 * @mixin \Eloquent
 */
class ThreadReply extends Model
{
    public function thread()
    {
        return $this->belongsTo(Thread::class);
    }
    
    public function author()
    {
        return $this->belongsTo(User::class, 'author_id');
    }
}
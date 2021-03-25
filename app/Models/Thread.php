<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Thread
 *
 * @property-read User $author
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\ThreadReply[] $replies
 * @property-read int|null $replies_count
 * @property-read Model|\Eloquent $taggabble
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Tag[] $tags
 * @property-read int|null $tags_count
 * @method static \Illuminate\Database\Eloquent\Builder|Thread newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Thread newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Thread query()
 * @mixin \Eloquent
 */
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
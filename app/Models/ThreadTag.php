<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\ThreadTag
 *
 * @property-read \App\Models\Tag $tag
 * @method static \Illuminate\Database\Eloquent\Builder|ThreadTag newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ThreadTag newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ThreadTag query()
 * @mixin \Eloquent
 */
class ThreadTag extends Model
{
    public $timestamps = false;

    public function tag()
    {
        return $this->belongsTo(Tag::class);
    }
}
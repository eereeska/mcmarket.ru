<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    public $timestamps = false;

    public function threads()
    {
        return $this->morphedByMany(Thread::class, 'thread_tags');
    }
}
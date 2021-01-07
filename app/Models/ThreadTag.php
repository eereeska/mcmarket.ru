<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ThreadTag extends Model
{
    public $timestamps = false;

    public function tag()
    {
        return $this->belongsTo(Tag::class);
    }
}
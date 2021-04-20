<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FileMedia extends Model
{
    public $timestamps = false;

    public function file()
    {
        return $this->belongsTo(File::class);
    }
}
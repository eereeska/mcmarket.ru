<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FileCategory extends Model
{
    public $timestamps = false;
    
    public function files()
    {
        return $this->belongsToMany(File::class);
    }
}
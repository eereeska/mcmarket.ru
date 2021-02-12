<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FileVersion extends Model
{
    protected $fillable = [
        'file_id',
        'version',
        'description'
    ];
}
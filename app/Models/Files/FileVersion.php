<?php

namespace App\Models\Files;

use App\Models\File;
use Illuminate\Database\Eloquent\Model;

class FileVersion extends Model
{
    protected $fillable = [
        ''
    ];

    public function file()
    {
        return $this->belongsTo(File::class);
    }
}

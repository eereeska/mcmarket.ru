<?php

namespace App\Models\Files;

use Illuminate\Database\Eloquent\Model;

class FileVersion extends Model
{
    protected $guarded = ['id', 'state'];

    public function file()
    {
        return $this->belongsTo(File::class);
    }
}

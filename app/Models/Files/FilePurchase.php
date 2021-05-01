<?php

namespace App\Models\Files;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;

class FilePurchase extends Model
{
    public function file()
    {
        return $this->belongsTo(File::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
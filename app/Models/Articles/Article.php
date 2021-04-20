<?php

namespace App\Models\Articles;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    public function user()
    {
        return $this->belongsTo(User::class, 'id', 'user_id');
    }
}

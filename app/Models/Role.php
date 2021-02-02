<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    public function permissions()
    {
        return $this->hasOne(Permission::class);
    }

    public function users()
    {
        return $this->hasMany(User::class);
    }
}
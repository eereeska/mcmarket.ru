<?php

namespace App\Http\Controllers\Admin\Users;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class BanController extends Controller
{
    public function index(User $user)
    {
        return view('admin.users.bans.ban', [
            'user' => $user
        ]);
    }
}

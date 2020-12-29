<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function view($id)
    {
        $user = User::where('id', $id)->first();

        if (!$user) {
            abort(404);
        }

        return view('user.view', [
            'user' => $user
        ]);
    }
}
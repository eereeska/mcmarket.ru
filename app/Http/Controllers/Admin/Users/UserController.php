<?php

namespace App\Http\Controllers\Admin\Users;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index(Request $request)
    {
        $users = UserFilterController::filter($request);

        if (request()->expectsJson()) {
            return response()->json(view('components.admin.users._users', [
                'users' => $users
            ])->render());
        }

        return view('admin.users.index', [
            'users' => $users
        ]);
    }

    public function edit($id)
    {
        return view('admin.users.edit', [
            'user' => User::where('id', $id)->with('settings')->first()
        ]);
    }
}
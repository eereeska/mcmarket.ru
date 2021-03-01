<?php

namespace App\Http\Controllers\Admin\Users;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class UserFilterController extends Controller
{
    public static function filter(Request $request, $per_page = 20)
    {
        $users = User::query();

        $users = $users->when($request->get('search'), function($query) use ($request) {
            return $query->where('name', 'like', '%' . $request->search . '%');
        });

        return $users->paginate($per_page)->appends($request->only(['search', 'sort']));
    }
}
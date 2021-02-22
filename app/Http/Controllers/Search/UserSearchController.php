<?php

namespace App\Http\Controllers\Search;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class UserSearchController extends Controller
{
    public function search(Request $request)
    {
        $result = User::select(['id', 'name', 'avatar'])->where('name', 'like', '%' . $request->input('query') . '%')->limit(10)->get();

        return response()->json([
            'success' => true,
            'result' => view('components.select.users', ['users' => $result])->render()
        ]);
    }
}
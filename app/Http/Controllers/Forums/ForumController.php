<?php

namespace App\Http\Controllers\Forums;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ForumController extends Controller
{
    public function index(Request $request)
    {
        return view('forums.index');
    }
}
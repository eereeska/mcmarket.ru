<?php

namespace App\Http\Controllers\Forums;

use App\Http\Controllers\Controller;
use App\Models\Forum\Thread;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ForumController extends Controller
{
    public function index()
    {
        return view('forum.index', [
            'threads' => Thread::with('author')->paginate(10)
        ]);
    }

    public function create()
    {
        return view('forum.thread.create');
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title' => ['required', 'min:4', 'max:80'],
            'body' => ['required', 'min:12']
        ], [
            'title.required' => 'Обязательное поле',
            'title.min' => 'Минимальная длинна: 4 символа',
            'title.max' => 'Максимальная длинна: 80 символов',
            'body.required' => 'Обязательное поле',
            'body.min' => 'Минимальная длинна: 12 символов'
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $user = $request->user();

        $thread = new Thread();
        $thread->author_id = $user->id;
        $thread->title = $request->title;
        $thread->body = str_replace('<p>&nbsp;</p>', '<br>', $request->body);
        $thread->save();

        return redirect()->route('forum-thread-view', ['id' => $thread->id]);
    }

    public function view($id)
    {
        $thread = Thread::where('id', $id)->first();

        if (!$thread) {
            abort(404);
        }

        return view('forum.thread.view', [
            'thread' => $thread
        ]);
    }
}
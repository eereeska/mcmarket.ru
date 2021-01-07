<?php

namespace App\Http\Controllers\Forums;

use App\Http\Controllers\Controller;
use App\Models\Tag;
use App\Models\Thread;
use App\Models\ThreadTag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Validator;

class ForumController extends Controller
{
    public function index()
    {
        $threads = Thread::with('author')->withCount('replies')->latest()->paginate(10);
        $tags = Tag::orderBy('title')->get();

        return view('forum.index', compact('threads', 'tags'));
    }

    public function create()
    {
        $tags = Tag::orderBy('title')->get();

        return view('forum.thread.create', compact('tags'));
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title' => ['required', 'min:4', 'max:80'],
            'tags' => ['required', 'array', 'between:1,4'],
            'body' => ['required', 'min:12']
        ], [
            'title.required' => 'Обязательное поле',
            'title.min' => 'Минимальная длинна: 4 символа',
            'title.max' => 'Максимальная длинна: 80 символов',
            'tags.required' => 'Укажите теги',
            'tags.array' => 'Теги имею неверный формат',
            'tags.between' => 'Укажите от 1 до 4 тегов',
            'body.required' => 'Обязательное поле',
            'body.min' => 'Минимальная длинна: 12 символов'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => $validator->errors()->first()
            ]);
        }

        $user = $request->user();

        $thread = new Thread();
        $thread->author_id = $user->id;
        $thread->title = $request->title;
        $thread->body = nl2br($request->body);
        $thread->save();

        $tags = Tag::whereIn('name', (array) $request->tags)->get();
        $tags_to_apply = [];

        foreach ($tags as $tag) {
            $tags_to_apply[] = [
                'thread_id' => $thread->id,
                'tag_id' => $tag->id
            ];
        }

        ThreadTag::insert($tags_to_apply);

        return response()->json([
            'success' => true,
            'redirect' => route('forum-thread-view', ['id' => $thread->id])
        ]);
    }

    public function view(Request $request, $id)
    {
        $thread = Thread::where('id', $id)->first();

        if (!$thread) {
            abort(404);
        }

        $ip = $_SERVER['CF_CONNECTING_IP'] ?? $request->ip();

        if (!Cache::has('forum.thread.' . $thread->id . '.view.' . $ip)) {
            $thread->increment('views');
        }

        Cache::put('forum.thread.' . $thread->id . '.view.' . $ip, '0', now()->addMinute());

        return view('forum.thread.view', [
            'thread' => $thread
        ]);
    }
}
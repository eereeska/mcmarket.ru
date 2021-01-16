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
    public function index(Request $request)
    {
        $threads = Thread::with('author')->withCount('replies')->orderBy('last_reply_at', 'desc')->paginate(15);
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
            'title' => ['required', 'min:4', 'max:60'],
            'tags' => ['required', 'array', 'between:1,4'],
            'body' => ['required', 'min:12', 'max:60000']
        ], [
            'title.required' => 'Обязательное поле',
            'title.min' => 'Минимальная длинна: 4 символа',
            'title.max' => 'Максимальная длинна: 60 символов',
            'tags.required' => 'Укажите теги',
            'tags.array' => 'Теги имею неверный формат',
            'tags.between' => 'Укажите от 1 до 4 тегов',
            'body.required' => 'Обязательное поле',
            'body.min' => 'Минимальная длинна: 12 символов',
            'body.max' => 'Максимум 60.000 символов'
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
        $thread->body = $this->nl2p($request->body, false);
        // $thread->body = $this->normalizePostBody($request->body);
        $thread->save();

        $tags = Tag::whereIn('name', array_keys($request->tags))->get();

        foreach ($tags as $tag) {
            ThreadTag::insert([
                'thread_id' => $thread->id,
                'tag_id' => $tag->id
            ]);
        }

        // return redirect()->route('forum-thread-view', ['id' => $thread->id]);

        return response()->json([
            'success' => true,
            'redirect' => route('forum-thread-show', ['id' => $thread->id])
        ]);
    }

    public function show(Request $request, $id)
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

        return view('forum.thread.show', [
            'thread' => $thread
        ]);
    }

    private function nl2p($string, $line_breaks = true, $xml = true)
    {
        $string = strip_tags($string);
        
        if ($line_breaks == true) {
            return '<p>' . preg_replace(["/([\n]{2,})/i", "/([^>])\n([^<])/i"], ["</p>\n<p>", '${1}<br' . ($xml == true ? ' /' : '') . '>${2}'], trim($string)) . '</p>';
        } else {
            return '<p>' . preg_replace(["/([\n]{2,})/i", "/([\r\n]{3,})/i", "/([^>])\n([^<])/i"], ["</p>\n<p>", "</p>\n<p>", '${1}<br' . ($xml === true ? ' /' : '') . '>${2}'], trim($string)) . '</p>'; 
        }
    }
}
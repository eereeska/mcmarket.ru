<?php

namespace App\Http\Controllers;

use App\Models\Tag;
use App\Models\Thread;
use App\Models\ThreadTag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class SearchController extends Controller
{
    public function index(Request $request)
    {
        if ($request->get('section') === 'forum') {
            return $this->search($request);
        }

        return view('search');
    }

    public function search(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'tags' => ['array']
        ], [
            'tags.array' => 'Теги имею неверный формат'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => $validator->errors()->first()
            ]);
        }
        
        $section = $request->get('section', 'everywhere');

        if (!in_array($section, ['everywhere', 'forum', 'resources'])) {
            return $this->returnResponse($request, false, 'Неверные параметры запроса');
        }

        if ($section === 'forum') {
            $query = Thread::query();

            $query->when($request->keywords, function($query) use ($request) {
                return $query->where('title', 'LIKE', '%' . $request->keywords . '%')
                    ->orWhere('body', 'LIKE', '%' . $request->keywords . '%');
            });

            $query->when($request->tags, function($query) use ($request) {
                return $query->whereIn('id', ThreadTag::whereIn('tag_id', Tag::whereIn('name', array_keys($request->tags))->pluck('id'))->pluck('thread_id'));
            });

            $query->when(in_array($request->get('order'), ['last_reply', 'newest', 'most_discussed', 'most_viewed']), function($query) use ($request) {
                switch ($request->order) {
                    case 'last_reply': return $query->orderBy('last_reply_at', 'desc');
                    case 'newest': return $query->orderBy('created_at', 'desc');
                    case 'most_discussed': return $query->orderBy('replies_count');
                    case 'most_viewed': return $query->orderBy('views', 'desc');
                }
            }, function($query) {
                return $query->orderBy('last_reply_at');
            });

            if ($request->ajax()) {
                return response()->json([
                    'success' => true,
                    'html' => view('forum._threads', ['threads' => $query->paginate(15)])->render()
                ]);
            }

            return view('forum.index', [
                'threads' => $query->paginate(15),
                'tags' => Tag::orderBy('title')->get()
            ]);
        }
    }
}
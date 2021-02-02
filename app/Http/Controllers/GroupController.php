<?php

namespace App\Http\Controllers;

use App\Models\Group;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;

class GroupController extends Controller
{
    public function index()
    {
        $groups = Group::latest()->paginate(20);

        return view('groups.index', ['groups' => $groups]);
    }

    public function create()
    {
        return view('groups.create');
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'cover' => ['required', 'image', 'max:5120'],
            'name' => ['required', 'min:4', 'max:32'],
            'type' => ['required', 'in:public,closed,private'],
            'description' => ['nullable', 'min:4', 'max:200']
        ], [
            'cover.required' => 'Загрузите обложку сообщества',
            'cover.image' => 'Неверный формат обложки',
            'cover.max' => 'Максимальный размер обложки: 5 МБ',
            'name.required' => 'Укажите название',
            'name.min' => 'Минимальная длинна названия: 4 символа',
            'name.max' => 'Максимальная длинна названия: 60 символов',
            'type.required' => 'Укажите тип сообщества',
            'type.in' => 'Неверные параметры запроса: Тип сообщества имеет',
            'description.min' => 'Минимальная длинна описания: 4 символа',
            'description.max' => 'Максимальная длинна описания: 200 символов'
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput($request->all());
        }

        if (Group::where('name', $request->name)->exists()) {
            return back()->withErrors($validator)->withInput();
        }

        try {
            $cover = $request->file('cover');
            $hash = hash_file('md5', $cover);
            $path = $hash . '.' . $cover->getClientOriginalExtension();

            if (!Storage::exists('app/public/covers/' . $path)) {
                Image::make($cover)->fit(300, 400)->save(storage_path('app/public/covers/' . $path));
            }
            
            $group = new Group();
            $group->owner_id = $request->user()->id;
            $group->name = $request->name;
            $group->description = empty($request->description) ? null : trim(nl2br(trim(strip_tags($request->description))));
            $group->type = $request->type;
            $group->slug = Str::slug($group->name);
            $group->cover = $path;
            $group->save();
        } catch (\Exception $e) {
            dd($e);
            return back()->withErrors(['create_error' => 'Не удалось создать сообщество'])->withInput();
        }

        if (!$request->ajax()) {
            return redirect()->route('group-show', ['slug' => $group->slug]);
        }

        return response()->json([
            'success' => true,
            'redirect' => route('group-show', ['slug' => $group->slug])
        ]);
    }

    public function show($slug)
    {
        $group = Group::where('slug', $slug)->with('owner')->firstOrFail();

        return view('groups.show', ['group' => $group]);
    }
}
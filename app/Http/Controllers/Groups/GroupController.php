<?php

namespace App\Http\Controllers\Groups;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Files\FileDescriptionController;
use App\Http\Requests\Groups\GroupCreateRequest;
use App\Models\Groups\Group;
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

    public function store(GroupCreateRequest $request)
    {
        $group = Group::create([
            'owner_id' => auth()->id(),
            'name' => $request->get('name'),
            'slug' => Str::slug($request->get('name')),
            'description' => $request->has('description') ? FileDescriptionController::normalize($request->description) : null,
            'type' => $request->type
        ]);

        Image::make($request->file('cover'))->fit(300, 400)->save(storage_path('app/public/covers/groups/' . $group->id, 100, 'png'));

        return redirect()->route('group.show', ['slug' => $group->slug]);
    }

    public function show($slug)
    {
        $group = Group::where('slug', $slug)->with('owner')->firstOrFail();

        return view('groups.show', [
            'group' => $group
        ]);
    }
}
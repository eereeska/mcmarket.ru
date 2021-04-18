<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\UserFollower;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Intervention\Image\Facades\Image;

class UserController extends Controller
{
    public function show($name)
    {
        $user = User::where('name', $name)->orWhere('id', $name)->with('settings')->first();

        if (!$user) {
            abort(404);
        }

        return view('user.show', [
            'user' => $user
        ]);
    }

    public function settings()
    {
        return view('user.settings', [
            'user' => auth()->user()
        ]);
    }

    public function updateSettings(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'about' => ['max:200'],
            'avatar' => ['nullable', 'max:5120'],
            'is_search_engine_visible' => ['boolean'],
            'is_online_status_visible' => ['boolean'],
            'is_activity_visible' => ['boolean']
        ], [
            'about.max' => 'Максимальная длинна «Обо мне»: 200 символов',
            'avatar.max' => 'Максимальный размер аватара: 5 МБ',
            'is_search_engine_visible.boolean' => 'Неверный формат',
            'is_online_status_visible.boolean' => 'Неверный формат',
            'is_activity_visible.boolean' => 'Неверный формат'
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator->errors());
        }

        try {
            $user = $request->user();
            $settings = $user->settings;

            $about = trim(strip_tags($request->about));

            if ($request->has('avatar') and $request->avatar != $user->avatar) {
                $avatar = $request->file('avatar');
                $hash = hash_file('md5', $avatar);
                $path = $hash . '.' . $avatar->getClientOriginalExtension();

                if (!Storage::exists('app/public/avatars/' . $path)) {
                    Image::make($avatar)->fit(300, 400)->save(storage_path('app/public/avatars/' . $path));
                }

                $user->avatar = $path;
                $user->save();
            }

            $settings->about = empty($about) ? null : nl2br($about);
            $settings->is_search_engine_visible = $request->boolean('is_search_engine_visible');
            $settings->is_online_status_visible = $request->boolean('is_online_status_visible');
    
            $settings->save();
        } catch (\Exception $error) {
            dd($error);
            return back()->withErrors(['update_error' => 'Произошла ошибка во время сохранения новой информации']);
        }

        return back();
    }

    public function notifications(Request $request)
    {
        $user = $request->user();

        if ($request->ajax()) {
            return response()->json([
                'success' => true,
                'html' => view('notifications.modal', [
                    'notifications' => $user->notifications
                ])->render()
            ]);
        }
    }

    public function follow(Request $request, $name)
    {
        $user = User::where('name', $name)->firstOrFail();
        $follower = $request->user();

        if (UserFollower::where('user_id', $user->id)->where('follower_id', $follower->id)->exists()) {
            return response()->json([
                'success' => false,
                'message' => 'Вы уже подписаны на ' . $user->name
            ]);
        }

        UserFollower::insert([
            'user_id' => $user->id,
            'follower_id' => $follower->id
        ]);

        return response()->json([
            'success' => true
        ]);
    }
}
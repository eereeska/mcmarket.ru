<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Intervention\Image\Facades\Image;

class UserController extends Controller
{
    public function show($name)
    {
        $user = User::where('name', $name)->orWhere('id', $name)->first();

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
            'user' => Auth::user()
        ]);
    }

    public function updateSettings(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'about' => ['max:200'],
            'is_search_engine_visible' => ['boolean'],
            'is_online_status_visible' => ['boolean'],
            'is_activity_visible' => ['boolean']
        ], [
            'about.max' => 'Максимальная длинна: 200 символов',
            'is_search_engine_visible.boolean' => 'Неверный формат',
            'is_online_status_visible.boolean' => 'Неверный формат',
            'is_activity_visible.boolean' => 'Неверный формат'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => $validator->errors()->first()
            ]);
        }

        try {
            $user = $request->user();
            $settings = $user->settings;

            $settings->about = trim(strip_tags($request->about));
            $settings->is_search_engine_visible = $request->boolean('is_search_engine_visible');
            $settings->is_online_status_visible = $request->boolean('is_online_status_visible');
            $settings->is_activity_visible = $request->boolean('is_activity_visible');
    
            $settings->save();
        } catch (\Exception $error) {
            return response()->json([
                'success' => false,
                'message' => 'Произошла ошибка во время сохранения новой информации'
            ]);
        }

        return response()->json([
            'success' => true
        ]);
    }

    public function uploadAvatar(Request $request)
    {
        $validator = Validator::make([$request->avatar], [
            'max:5120'
        ], [
            'max' => 'Максимальный размер аватара: 5 МБ'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => $validator->errors()->first()
            ]);
        }

        $user = $request->user();

        $avatar = $request->file('avatar');
        $path = $user->id . '.' . $avatar->getClientOriginalExtension();

        Image::make($avatar)->fit(300, 400)->save(storage_path('app/public/avatars/' . $path));

        $user->avatar = $path;
        $user->save();

        return response()->json([
            'success' => true,
            'avatar' => public_path('avatars/' . $path)
        ]);
    }
}
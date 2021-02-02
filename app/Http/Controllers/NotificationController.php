<?php

namespace App\Http\Controllers;

use App\Models\Notification;
use App\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class NotificationController extends Controller
{
    public static function sendNotificationToUser($user, $type, $data)
    {
        $notification = new Notification();
        $notification->user_id = $user->id;
        $notification->type = $type;
        $notification->data = $data;
        $notification->save();
    }

    public static function sendNotiticationToUsersWithPermission($permission, $permission_value, $type, $data)
    {
        foreach (Role::where($permission, $permission_value)->with('users')->get() as $role) {
            foreach ($role->users as $user) {
                self::sendNotificationToUser($user, $type, $data);
            }
        }
    }

    public function getNotifications(Request $request)
    {
        $user = $request->user();

        return Cache::remember('user.' . $user->id . '.notifications', now()->addHour(), function() use ($user) {
            return Notification::where('user_id', $user->id)->get();
        });
    }

    public function getUnreadNotifications(Request $request)
    {
        $user = $request->user();

        return Cache::remember('user.' . $user->id . '.unread-notifications', now()->addHour(), function() use ($user) {
            return Notification::where('user_id', $user->id)->where('read_at', null)->get();
        });
    }

    public function markAsRead(Request $request, $id)
    {
        $notification = Notification::where('user_id', $request->user()->id)->where('id', $id)->firstOrfail();

        $notification->read_at = now();
        $notification->save();

        if ($request->ajax()) {
            return response()->json([
                'success' => true
            ]);
        } else {
            return back();
        }
    }

    public function markAllAsRead(Request $request)
    {
        Notification::where('user_id', $request->user()->id)->where('read_at', null)->update([
            'read_at' => now()
        ]);

        if ($request->ajax()) {
            return response()->json([
                'success' => true
            ]);
        } else {
            return back();
        }
    }

    public function delete(Request $request, $id)
    {
        Notification::where('user_id', $request->user()->id)->where('id', $id)->delete();

        if ($request->ajax()) {
            return response()->json([
                'success' => true
            ]);
        } else {
            return back();
        }
    }

    public function deleteAll(Request $request)
    {
        Notification::where('user_id', $request->user()->id)->delete();

        if ($request->ajax()) {
            return response()->json([
                'success' => true
            ]);
        } else {
            return back();
        }
    }
}
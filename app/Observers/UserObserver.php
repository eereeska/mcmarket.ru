<?php

namespace App\Observers;

use App\Models\User;
use App\Models\UserSettings;

class UserObserver
{
    public function created(User $user)
    {
        $user->settings_id = UserSettings::insertGetId([
            'user_id' => $user->id
        ]);

        $user->save();
    }

    public function updated(User $user)
    {
        if (is_null($user->settings_id)) {
            if ($settings = UserSettings::where('user_id', $user->id)->first()) {
                $user->settings_id = $settings->id;
            } else {
                $user->settings_id = UserSettings::insertGetId([
                    'user_id' => $user->id
                ]);
            }

            $user->save();
        }
    }

    public function deleted(User $user)
    {
        UserSettings::where('user_id', $user->id)->delete();
    }

    public function restored(User $user)
    {
        //
    }

    public function forceDeleted(User $user)
    {
        UserSettings::where('user_id', $user->id)->delete();
    }
}
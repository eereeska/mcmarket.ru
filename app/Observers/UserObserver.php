<?php

namespace App\Observers;

use App\Http\Controllers\Users\UserEmailVerificationController;
use App\Models\User;
use App\Models\UserSettings;

class UserObserver
{
    public function created(User $user)
    {
        $settings = new UserSettings();
        $settings->user_id = $user->id;
        $settings->save();
        
        UserEmailVerificationController::sendEmail($user);
    }

    public function updated(User $user)
    {
        //
    }

    public function deleted(User $user)
    {
        //
    }

    public function restored(User $user)
    {
        //
    }

    public function forceDeleted(User $user)
    {
        //
    }
}
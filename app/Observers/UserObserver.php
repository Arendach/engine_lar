<?php

namespace App\Observers;

use App\Models\User;
use UserAuth;

class UserObserver
{
    public function creating(User $user)
    {
        if (mb_strlen($user->password) != 32) {
            $user->password = UserAuth::hash($user->password);
        }
    }

    public function updating(User $user)
    {
        if ($user->isDirty('password')) {
            $user->password = UserAuth::hash($user->password);
        }

        $user->deleted_at = request()->has('deleted_at') && request('deleted_at') ? now() : null;

    }
}

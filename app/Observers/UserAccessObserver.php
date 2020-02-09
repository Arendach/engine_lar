<?php

namespace App\Observers;

use App\Models\User;
use App\Models\UserAccess;

class UserAccessObserver
{
    public function creating(UserAccess $userAccess)
    {
        $userAccess->params = json_encode($userAccess->params);
    }

    public function updating(UserAccess $userAccess)
    {
        $userAccess->params = json_encode($userAccess->params);
    }

    public function deleting(UserAccess $userAccess)
    {
        User::where('user_access_id', $userAccess->id)->update(['user_access_id' => 0]);
    }
}

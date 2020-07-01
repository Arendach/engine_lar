<?php

namespace App\Http\Controllers;

use App\Models\Notification;
use Illuminate\Http\Request;

class NotificationController extends Controller
{
    public function actionCloseNotification(Request $request)
    {
        Notification::findOrFail($request->id)->update(['is_see' => 1]);
    }
}
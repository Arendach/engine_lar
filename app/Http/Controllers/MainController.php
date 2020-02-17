<?php

namespace App\Http\Controllers;

use App\Models\User;

class MainController extends Controller
{
    public function index()
    {
        $data = [
            'schedules' => user()->getSchedulesNotWrite(),
            'schedulesPrevious' => user()->getPreviousSchedulesNotWrite(),
            'notifications' => user()->notifications,
            'attachDelivery' => user()->getCountAttachDelivery(),
            'attachSelf' => user()->getCountAttachSelf(),
            'attachSending' => user()->getCountAttachSending(),
            'tasks' => user()->tasks,
            'liableDelivery' => user()->getCountLiableDelivery(),
            'liableSelf' => user()->getCountLiableSelf(),
            'movingMoney' => user()->getMovingMoney(),
            'notMovingMoney' => user()->getMovingMoney(),
        ];

        /*
        $data = [
            'scripts' => ['reports.close_moving', 'index'],
            'components' => ['sweet_alert', 'modal'],
            'liable_orders' => Index::liable_orders(),
            'product_moving' => Products::findAll('product_moving', 'user_to = ? AND status = 0', [user()->id])
        ];

        $nco = $data['nco'];
        if ($nco->delivery == 0 && $nco->self == 0 && $nco->shop == 0 && $nco->sending == 0) {
            $data['nco'] = 0;
        }*/

        return view('pages.index', $data);
    }

    public function actionChangeTheme(string $theme)
    {
        user()->update([
            'theme' => $theme,
        ]);
    }
}

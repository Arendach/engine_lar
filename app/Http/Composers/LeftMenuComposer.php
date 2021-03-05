<?php

namespace App\Http\Composers;

use App\Models\Site;
use Illuminate\View\View;

class LeftMenuComposer
{
    public function compose(View $view)
    {
        $alertDanger = 'yes is it skillet';
        $siteList = Site::where('key', !'IS NULL')->get();
        $view->with(compact('alertDanger','siteList'));
    }
}
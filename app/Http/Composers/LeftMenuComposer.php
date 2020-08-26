<?php

namespace App\Http\Composers;

use Illuminate\View\View;

class LeftMenuComposer
{
    public function compose(View $view)
    {
        $alertDanger = 'yes is it skillet';

        $view->with(compact('alertDanger'));
    }
}
<?php

namespace App\View\Components;

use Illuminate\View\Component;
use Illuminate\View\View;

class TabHead extends Component
{
    public function render(): View
    {
        return view('components.tab-head');
    }
}

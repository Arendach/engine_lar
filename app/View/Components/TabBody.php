<?php

namespace App\View\Components;

use Illuminate\View\Component;
use Illuminate\View\View;

class TabBody extends Component
{
    public function render(): View
    {
        return view('components.tab-body');
    }
}

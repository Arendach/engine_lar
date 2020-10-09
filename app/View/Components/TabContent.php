<?php

namespace App\View\Components;

use Illuminate\View\Component;
use Illuminate\View\View;

class TabContent extends Component
{
    public $isActive;
    public $href;

    public function __construct(string $href = '', bool $isActive = false)
    {
        $this->href = $href;
        $this->isActive = $isActive;
    }

    public function render(): View
    {
        return view('components.tab-content');
    }
}

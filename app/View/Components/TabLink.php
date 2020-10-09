<?php

namespace App\View\Components;

use Illuminate\View\Component;
use Illuminate\View\View;

class TabLink extends Component
{
    public $href;
    public $label;
    public $isActive;

    public function __construct(string $href = '', string $label = '', bool $isActive = false)
    {
        $this->href = $href;
        $this->label = $label;
        $this->isActive = $isActive;
    }

    public function render(): View
    {
        return view('components.tab-link');
    }
}

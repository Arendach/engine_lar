<?php

namespace App\View\Components;

use Illuminate\View\Component;

class Checkbox extends Component
{
    public $name;
    public $isSelected;

    public function __construct($name, $isSelected = false)
    {
        $this->name = $name;
        $this->isSelected = $isSelected;
    }

    public function render()
    {
        return view('components.checkbox');
    }
}

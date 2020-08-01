<?php

namespace App\View\Components;

use Illuminate\View\Component;

class InputFile extends Component
{
    public $name;
    public $required;
    public $multiple;

    public function __construct($name, $required = false, $multiple = false)
    {
        $this->name = $name;
        $this->required = $required;
        $this->multiple = $multiple;
    }

    public function render()
    {
        return view('components.input-file');
    }
}

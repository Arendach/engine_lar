<?php

namespace App\View\Components;

use Illuminate\View\Component;

class Input extends Component
{
    public $name;
    public $value;
    public $valueRu;
    public $lang;
    public $required;

    public function __construct($name, $value = null, $valueRu = null, $lang = false, $required = false)
    {
        $this->name = $name;
        $this->value = $value;
        $this->valueRu = $valueRu;
        $this->lang = $lang;
        $this->required = $required;
    }

    public function render()
    {
        return view('components.input');
    }
}

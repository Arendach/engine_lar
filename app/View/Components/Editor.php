<?php

namespace App\View\Components;

use Illuminate\View\Component;

class Editor extends Component
{
    public $name;
    public $value;
    public $valueRu;
    public $lang;

    public function __construct($name, $value = null, $valueRu = null, $lang = false)
    {
        $this->name = $name;
        $this->value = $value;
        $this->valueRu = $valueRu;
        $this->lang = $lang;
    }

    public function render()
    {
        return view('components.editor');
    }
}

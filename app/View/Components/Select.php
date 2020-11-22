<?php

namespace App\View\Components;

use Illuminate\View\Component;

class Select extends Component
{
    public $options;
    public $name;
    public $required;
    public $selected;
    public $multiple;

    public function __construct($name, $options = [], $required = false, $selected = null, bool $multiple = false)
    {
        $this->options = $options;
        $this->name = $name;
        $this->required = $required;
        $this->selected = $selected;
        $this->multiple = $multiple;

        $this->setOptions();
    }

    public function render()
    {
        return view('components.select');
    }

    private function setOptions()
    {
        if ($this->options == 'boolean') {
            $this->options = ['Ні', 'Так'];
        }
    }
}

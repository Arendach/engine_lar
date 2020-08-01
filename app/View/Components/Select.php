<?php

namespace App\View\Components;

use Illuminate\View\Component;

class Select extends Component
{
    public $options;
    public $name;
    public $required;
    public $selected;

    public function __construct($name, $options = [], $required = false, $selected = null)
    {
        $this->options = $options;
        $this->name = $name;
        $this->required = $required;
        $this->selected = $selected;

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

<?php

namespace App\Editable;

use Exception;

class Select extends EditableBasic
{
    public $options;

    public function __toString(): string
    {
        return view('assets.select')->with(['select' => $this])->render();
    }

    public function options(array $options): self
    {
        $this->options = $options;

        return $this;
    }
}
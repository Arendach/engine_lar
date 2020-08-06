<?php

namespace App\Editable;

use Exception;

class Select extends EditableBasic
{
    public $options;

    public function __toString(): string
    {
        if (env('APP_ENV') == 'testing') {
            return $this->model->{$this->field};
        }

        return view('assets.select')->with(['select' => $this])->render();
    }

    public function options(array $options): self
    {
        $this->options = $options;

        return $this;
    }
}
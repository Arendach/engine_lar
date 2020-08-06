<?php

namespace App\Editable;

class Checkbox extends EditableBasic
{
    public function __toString(): string
    {
        if (env('APP_ENV') == 'testing') {
            return $this->model->{$this->field};
        }

        return view('assets.checkbox')->with(['checkbox' => $this])->render();
    }
}
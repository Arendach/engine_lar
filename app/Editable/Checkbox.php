<?php

namespace App\Editable;

class Checkbox extends EditableBasic
{
    public function __toString(): string
    {
        return view('assets.checkbox')->with(['checkbox' => $this])->render();
    }
}
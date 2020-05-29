<?php

namespace App\Traits;

trait Editable
{
    public function editable(string $field)
    {
        $value = $this->$field;
        $model = $this;

        return view('assets.content-editable', compact('value', 'model', 'field'))->render();
    }
}
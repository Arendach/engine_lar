<?php

namespace App\Editable;

abstract class EditableBasic
{
    public $model;
    public $isRequired;
    public $class = 'form-control input-sm';
    public $field;
    public $value;

    public function __construct($model)
    {
        $this->model = $model;
    }

    public function field(string $field): self
    {
        $this->field = $field;

        return $this;
    }

    public function class(string $class): self
    {
        $this->class = $class;

        return $this;
    }

    public function required(bool $required = true): self
    {
        $this->isRequired = $required;

        return $this;
    }

    public function value($value): self
    {
        $this->value = $value;

        return $this;
    }
}
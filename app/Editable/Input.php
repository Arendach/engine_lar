<?php

namespace App\Editable;

class Input extends EditableBasic
{
    public $editor = false;
    public $element = 'input';
    public $type = 'text';
    public $localize = false;

    public function __toString(): string
    {
        return view('assets.input')->with(['input' => $this])->render();
    }

    public function editor(bool $editor = true): self
    {
        $this->editor = $editor;

        return $this;
    }

    public function element(string $element = 'textarea'): self
    {
        $this->element = $element;

        return $this;
    }

    public function type(string $type = 'text'): self
    {
        $this->type = $type;

        return $this;
    }

    public function localize($localize = true): self
    {
        $this->localize = $localize;

        return $this;
    }
}
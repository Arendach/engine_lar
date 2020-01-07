<?php

namespace App\Traits;

trait Image
{
    public function getImageSizeAttribute(): ?string
    {
        if (!is_file(public_path($this->path))) return null;

        list($width, $height) = getimagesize($this->path);

        return "{$width}x{$height}";
    }
}
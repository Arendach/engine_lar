<?php

namespace App\Traits;

trait Image
{
    public function getImageSizeAttribute(): ?string
    {
        if (!is_file(public_path($this->path))) return null;

        [$width, $height] = getimagesize(public_path($this->path));

        return "{$width}x{$height}";
    }
}
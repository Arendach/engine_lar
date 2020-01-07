<?php

namespace App\Traits;

trait File
{
    public function getIconAttribute()
    {
        $extension = mb_strtolower(pathinfo($this->path)['extension']);

        if (in_array($extension, ['png', 'gif', 'jpeg', 'jpg', 'bmp'])) {
            return asset($this->path);
        } else {
            return asset("images/formats/$extension.png");
        }
    }

    public function getPublicPathAttribute()
    {
        return asset($this->path);
    }

    public function getBaseNameAttribute()
    {
        return pathinfo($this->path)['basename'];
    }

    public function getCreateDateAttribute()
    {
        if (!is_file(public_path($this->path))) return '0000.00.00 00:00';

        return date("Y.m.d H:i", filemtime(public_path($this->path)));
    }

    public function getSizeAttribute()
    {
        if (!is_file(public_path($this->path))) return '0 mb';
        return my_file_size(filesize(public_path($this->path)));
    }
}
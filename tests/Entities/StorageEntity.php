<?php

namespace Tests\Entities;

use App\Models\Storage;

trait StorageEntity
{
    public $storage;

    public function getStorage(): Storage
    {
        if (!$this->storage) {
            $this->storage = factory(Storage::class)->create();
        }

        return $this->storage;
    }
}
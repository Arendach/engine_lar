<?php

namespace Tests\Entities;

use App\Models\Storage;

trait StorageEntity
{
    public $storage;

    public function getStorage(): Storage
    {
        if (!$this->storage) {
            $this->storage = Storage::factory()->create();
        }

        return $this->storage;
    }
}
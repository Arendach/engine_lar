<?php

namespace Tests\Feature;

use App\Models\Storage;
use Tests\TestCase;

class StorageTest extends TestCase
{
    public function testShowMain(): void
    {
        $this->authenticate();

        $storage = $this->getStorage();

        $this->get('/storage/main')
            ->assertStatus(200)
            ->assertSee($storage->name)
            ->assertSee($storage->info)
            ->assertSee($storage->priority)
        ;
    }

    public function testCreate(): void
    {
        $this->authenticate();

        $data = factory(Storage::class)->make()->getAttributes();

        $this->post('/storage/create', $data)->assertStatus(200);

        $this->assertDatabaseHas('storage', $data);
    }

    public function testUpdate(): void
    {
        $this->authenticate();

        $asset = $this->getStorage();
        $data = factory(Storage::class)->make()->getAttributes();

        $this->post('/storage/update', array_merge($asset->getAttributes(), $data))
            ->assertStatus(200);

        $this->assertDatabaseHas('storage', $data);
    }
}
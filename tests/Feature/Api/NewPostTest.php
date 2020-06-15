<?php

namespace Tests\Feature\Api;

use App\Models\NewPostCity;
use Tests\TestCase;

class NewPostTest extends TestCase
{
    public function testSearchCities()
    {
        factory(NewPostCity::class)->create(['name' => 'test']);

        $this->postJson('/api/new_post/search_cities', ['name' => 'test'])
            ->assertStatus(200);
    }
}

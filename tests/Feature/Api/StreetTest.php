<?php

namespace Tests\Feature\Api;

use App\Models\Street;
use Tests\TestCase;

class StreetTest extends TestCase
{
    public function testSearch()
    {
        $street = factory(Street::class)->create();

        $request = $this->postJson('/api/streets/search', [
            'name' => $street->name
        ]);

        $request->assertStatus(200);

        $request->assertJsonFragment([
            'id'          => $street->id,
            'city'        => $street->city,
            'district'    => $street->district,
            'name'        => $street->name,
            'street_type' => $street->street_type
        ]);
    }
}

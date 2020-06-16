<?php

namespace Tests\Feature\Api;

use App\Models\NewPostCity;
use App\Models\NewPostWarehouse;
use Tests\TestCase;

class NewPostTest extends TestCase
{
    public function testSearchCities()
    {
        $city = factory(NewPostCity::class)->create();

        $request = $this->postJson('/api/new_post/search_cities', [
            'name' => $city->name
        ]);

        $request->assertStatus(200);

        $request->assertJsonFragment([
            'id'     => $city->id,
            'name'   => $city->name,
            'ref'    => $city->ref,
            'prefix' => $city->prefix
        ]);
    }

    public function testSearchWarehouses()
    {
        // test search by ref
        $cityRef = factory(NewPostCity::class)->create();

        $warehouseRef = factory(NewPostWarehouse::class)->create([
            'city_ref' => $cityRef->ref,
            'city_id'  => $cityRef->id
        ]);

        $this->postJson('/api/new_post/search_warehouses', [
            'city' => $warehouseRef->city_ref
        ])
            ->assertStatus(200)
            ->assertJsonFragment([
                'id'               => $warehouseRef->id,
                'name'             => $warehouseRef->name,
                'ref'              => $warehouseRef->ref,
                'city_ref'         => $warehouseRef->city_ref,
                'number'           => $warehouseRef->number,
                'max_weight_place' => $warehouseRef->max_weight_place,
                'max_weight_all'   => $warehouseRef->max_weight_all,
                'phone'            => $warehouseRef->phone,
                'city_id'          => $warehouseRef->city_id
            ]);


        // test search by id
        $cityId = factory(NewPostCity::class)->create();

        $warehouseId = factory(NewPostWarehouse::class)->create([
            'city_id'  => $cityId->id,
            'city_ref' => $cityId->ref
        ]);

        $this->postJson('/api/new_post/search_warehouses', [
            'city' => $warehouseId->city_id
        ])
            ->assertStatus(200)
            ->assertJsonFragment([
                'id'               => $warehouseId->id,
                'name'             => $warehouseId->name,
                'ref'              => $warehouseId->ref,
                'city_ref'         => $warehouseId->city_ref,
                'number'           => $warehouseId->number,
                'max_weight_place' => $warehouseId->max_weight_place,
                'max_weight_all'   => $warehouseId->max_weight_all,
                'phone'            => $warehouseId->phone,
                'city_id'          => $warehouseId->city_id
            ]);
    }
}

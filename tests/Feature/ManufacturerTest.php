<?php

namespace Tests\Feature;

use App\Models\Manufacturer;
use Tests\TestCase;

class ManufacturerTest extends TestCase
{
    public function testShow(): void
    {
        $this->authenticate();

        $manufacturer = $this->getManufacturer();

        $this->get('/manufacturer/main')
            ->assertStatus(200)
            ->assertSee($manufacturer->name)
            ->assertSee($manufacturer->email)
            ->assertSee($manufacturer->phone)
            ->assertSee($manufacturer->id);
    }

    public function testCreateForm(): void
    {
        $this->authenticate();

        $this->post('/manufacturer/create_form')
            ->assertStatus(200);
    }

    public function testCreate(): void
    {
        $this->authenticate();

        $nameUk = $this->faker->name;
        $nameRu = $this->faker->name;
        $address = $this->faker->address;
        $phone = rand(100, 999) . '-' . rand(100, 999) . '-' . rand(10, 99) . '-' . rand(10, 99);
        $email = $this->faker->email;
        $info = $this->faker->randomHtml();

        $data = [
            'name_uk' => $nameUk,
            'name_ru' => $nameRu,
            'address' => $address,
            'phone'   => $phone,
            'email'   => $email,
            'info'    => $info,
        ];

        $this->post('/manufacturer/create', $data)
            ->assertStatus(200);

        $this->assertDatabaseHas('manufacturers', $data);
    }

    public function testUpdateForm(): void
    {
        $this->authenticate();

        $manufacturer = $this->getManufacturer();

        $this->post('/manufacturer/update_form', ['id' => $manufacturer->id])
            ->assertStatus(200);
    }

    public function testUpdate(): void
    {
        $this->authenticate();

        $nameUk = $this->faker->name;
        $nameRu = $this->faker->name;
        $address = $this->faker->address;
        $phone = rand(100, 999) . '-' . rand(100, 999) . '-' . rand(10, 99) . '-' . rand(10, 99);
        $email = $this->faker->email;
        $info = $this->faker->randomHtml();

        $manufacturer = $this->getManufacturer();

        $data = [
            'id'      => $manufacturer->id,
            'name_uk' => $nameUk,
            'name_ru' => $nameRu,
            'address' => $address,
            'phone'   => $phone,
            'email'   => $email,
            'info'    => $info,
        ];

        $this->post('/manufacturer/update', $data)
            ->assertStatus(200);

        $this->assertDatabaseHas('manufacturers', $data);
    }

    public function testPrint(): void
    {
        $this->authenticate();

        $manufacturer = $this->getManufacturer();

        $this->get("/manufacturer/print?ids[]={$manufacturer->id}")
            ->assertStatus(200);
    }

    public function testDelete(): void
    {
        $this->authenticate();

        $manufacturer = factory(Manufacturer::class)->create();

        $this->post('/manufacturer/delete', ['id' => $manufacturer->id])
            ->assertStatus(200);
    }
}
<?php

namespace Tests\Feature;

use App\Models\Category;
use Tests\TestCase;

class CategoryTest extends TestCase
{
    public function testShow(): void
    {
        $this->authenticate();


        $category = $this->getCategory();
        $this->get('/category/main')
            ->assertStatus(200)
            ->assertSee($category->name)
            ->assertSee($category->service_code);
    }

    public function testCreate(): void
    {
        $this->authenticate();
        $category = $this->getCategory();
        $name = $this->faker->name;
        $serviceCode = $this->faker->numberBetween(1000, 99999);
        $parentId = rand(0, 1) ? $category->id : null;

        $this->post('/category/create', [
            'name'         => $name,
            'service_code' => $serviceCode,
            'parent_id'    => $parentId
        ])
            ->assertStatus(200);

        $this->assertDatabaseHas('categories', [
            'name'         => $name,
            'service_code' => $serviceCode,
            'parent_id'    => $parentId
        ]);
    }

    public function testUpdate(): void
    {
        $this->authenticate();

        $category = $this->getCategory();
        $newCategory = factory(Category::class)->create();

        $name = $this->faker->name;
        $serviceCode = $this->faker->numberBetween(1000, 99999);

        $this->post('/category/update', [
            'id'           => $category->id,
            'service_code' => $serviceCode,
            'name'         => $name,
            'parent_id'    => $newCategory->id
        ]);

        $this->assertDatabaseHas('categories', [
            'id'           => $category->id,
            'service_code' => $serviceCode,
            'name'         => $name,
            'parent_id'    => $newCategory->id
        ]);
    }

    public function testUpdateForm(): void
    {
        $this->authenticate();

        $category = $this->getCategory();

        $this->post('/category/update_form', ['id' => $category->id])
            ->assertStatus(200);
    }

    public function testDelete(): void
    {
        $this->authenticate();

        $category = $this->getCategory();

        $this->post('/category/delete', ['id' => $category->id])
            ->assertStatus(200);
    }
}
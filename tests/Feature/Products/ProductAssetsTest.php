<?php

namespace Tests\Feature\Products;

use App\Models\ProductAsset;
use Tests\TestCase;

class ProductAssetsTest extends TestCase
{
    public function testShowMain(): void
    {
        $this->authenticate();

        $productAsset = $this->getProductAsset();

        $this->get('/product/assets')
            ->assertStatus(200)/*->assertSee($productAsset->name)
            ->assertSee($productAsset->description)
            ->assertSee($productAsset->price)
            ->assertSee($productAsset->course)*/
        ;
    }

    public function testCreate(): void
    {
        $this->authenticate();

        $data = factory(ProductAsset::class)->make()->getAttributes();

        $this->post('/product/create_assets', $data)->assertStatus(200);

        $this->assertDatabaseHas('product_assets', $data);
    }

    public function testUpdate(): void
    {
        $this->authenticate();

        $asset = $this->getProductAsset();
        $data = factory(ProductAsset::class)->make()->getAttributes();

        $this->post('/product/update_assets', array_merge($asset->getAttributes(), $data))
            ->assertStatus(200);

        $this->assertDatabaseHas('product_assets', $data);
    }
}
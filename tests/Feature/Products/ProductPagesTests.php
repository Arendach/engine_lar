<?php

namespace Tests\Feature\Products;

use Tests\TestCase;

class ProductPagesTests extends TestCase
{
    public function testShowMain()
    {
        $this->authenticate();

        $this->get('/product/main')
            ->assertStatus(200);
    }
}
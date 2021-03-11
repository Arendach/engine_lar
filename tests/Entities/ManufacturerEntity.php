<?php

namespace Tests\Entities;

use App\Models\Manufacturer;

trait ManufacturerEntity
{
    public $manufacturer;

    public function getManufacturer(): Manufacturer
    {
        if (!$this->manufacturer) {
            $this->manufacturer = Manufacturer::factory()->create();
        }

        return $this->manufacturer;
    }
}
<?php

namespace Tests\Entities;

use App\Models\Inventory;

trait InventoryEntity
{
    public $inventory;

    public function getInventory(): Inventory
    {
        if (!$this->inventory) {
            $this->inventory = Inventory::factory()->create([
                'user_id'         => $this->getUser()->id,
                'manufacturer_id' => $this->getManufacturer()->id,
                'storage_id'      => $this->getStorage()->id
            ]);

            $this->inventory->products()->attach($this->getProduct(), [
                'amount'          => $this->faker->numberBetween(1, 100),
                'previous_amount' => $this->faker->numberBetween(1, 100),
            ]);
        }

        return $this->inventory;
    }

}
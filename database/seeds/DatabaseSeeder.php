<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        $this->call(AttributesSeeder::class);
        // $this->call(BonusesSeeder::class);
        $this->call(CategoriesSeeder::class);
        // $this->call(ChangesSeeder::class);
        $this->call(CharacteristicsSeeder::class);
        $this->call(ClientsSeeder::class);
        $this->call(OrderHintsSeeder::class);
        $this->call(ProductsSeeder::class);
        $this->call(UsersSeeder::class);
    }
}

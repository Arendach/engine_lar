<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        Artisan::call('migrate:refresh');

        $this->call(AttributesSeeder::class);
        $this->call(BonusesSeeder::class);
        $this->call(CategoriesSeeder::class);
        $this->call(ChangesSeeder::class);
        $this->call(CharacteristicsSeeder::class);
        $this->call(ClientsSeeder::class);
        $this->call(InventorySeeder::class);
        $this->call(LogisticsSeeder::class);
        $this->call(ManufacturersSeeder::class);
        $this->call(MerchantsSeeder::class);
        $this->call(NotificationSeeder::class);
        $this->call(OrderFilesSeeder::class);
        $this->call(OrderHintsSeeder::class);
        $this->call(OrderProductsSeeder::class);
        $this->call(OrderProfessionalSeeder::class);
        $this->call(OrdersSeeder::class);
        $this->call(OrderTransactionsSeeder::class);
        $this->call(PayoutsSeeder::class);
        $this->call(ProductAttributesSeeder::class);
        $this->call(ProductCharacteristicsSeeder::class);
        $this->call(ProductHistorySeeder::class);
        $this->call(ProductImagesSeeder::class);
        $this->call(ProductMovingSeeder::class);
        $this->call(ProductsSeeder::class);
        $this->call(PurchasesSeeder::class);
        $this->call(ReportsSeeder::class);
        $this->call(ScheduleSeeder::class);
        $this->call(ShopsSeeder::class);
        $this->call(SitesSeeder::class);
        $this->call(SmsSeeder::class);
        $this->call(StorageIdsSeeder::class);
        $this->call(StorageSeeder::class);
        $this->call(StreetsSeeder::class);
        $this->call(TasksSeeder::class);
        $this->call(UserAccessSeeder::class);
        $this->call(UserPositionsSeeder::class);
        $this->call(UsersSeeder::class);
        $this->call(VacationsSeeder::class);
    }
}

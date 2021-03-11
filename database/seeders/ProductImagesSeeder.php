<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\ProductImage;

class ProductImagesSeeder extends Seeder
{
    public function run()
    {
        $directories = scandir(public_path('storage/products'));

        unset($directories[0], $directories[1]);

        foreach ($directories as $directory) {
            $files = scandir(public_path("storage/products/$directory"));
            unset($files[0], $files[1]);

            foreach ($files as $file) {
                $path = "/storage/products/$directory/$file";

                ProductImage::create([
                    'product_id' => $directory,
                    'path'       => $path,
                    'alt'        => $file,
                    'is_main'    => false
                ]);
            }
        }
    }
}

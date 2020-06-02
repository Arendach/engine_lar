<?php

use Illuminate\Database\Seeder;
use App\Models\Product;
use App\Models\ProductStorage;
use App\Models\ProductLinked;
use App\Models\ProductAsset;

class ProductsSeeder extends Seeder
{
    public function run()
    {
        DB::connection('old')->table('products')->get()->each(function (stdClass $item) {
            if (in_array($item->date, ['0', '0000-00-00 00:00:00', '', null])) {
                $date = now();
            } else {
                $date = \Carbon\Carbon::parse($item->date);
            }

            if (!$item->product_key) {
                $productKey = rand32();
            } else {
                $productKey = $item->product_key;
            }

            Product::create([
                'id'                  => $item->id,
                'name_uk'             => htmlspecialchars_decode($item->name),
                'name_ru'             => htmlspecialchars_decode($item->name_ru),
                'article'             => htmlspecialchars_decode($item->articul),
                'model_uk'            => htmlspecialchars_decode($item->model),
                'model_ru'            => htmlspecialchars_decode($item->model_ru),
                'service_code'        => $item->services_code,
                'description_uk'      => htmlspecialchars_decode($item->description),
                'description_ru'      => htmlspecialchars_decode($item->description_ru),
                'price'               => $item->costs,
                'procurement_price'   => $item->procurement_costs,
                'is_accounted'        => $item->accounted,
                'is_combine'          => $item->combine,
                'attributes'          => in_array($item->attributes, ['', null, 'null', '[]']) ? null : htmlspecialchars_decode($item->attributes),
                'weight'              => $item->weight,
                'volume'              => in_array($item->volume, ['', 0, null, 'null']) or is_numeric($item->volume) ? null : $item->volume,
                'author_id'           => $item->author,
                'created_at'          => $date,
                'updated_at'          => $date,
                'meta_title_uk'       => $item->meta_title_uk,
                'meta_title_ru'       => $item->meta_title_ru,
                'meta_keywords_uk'    => $item->meta_keywords_uk,
                'meta_keywords_ru'    => $item->meta_keywords_ru,
                'meta_description_uk' => $item->meta_description_uk,
                'meta_description_ru' => $item->meta_description_ru,
                'product_key'         => $productKey,
                'deleted_at'          => $item->archive ? now() : null,
                'category_id'         => $item->category,
                'manufacturer_id'     => $item->manufacturer,
                'video'               => $item->video,
                'packing'             => json_encode([$item->count_1, $item->count_2, $item->count_3]),
                'id_storage'          => $item->identefire_storage
            ]);
        });

        DB::connection('old')->table('product_to_storage')->get()->each(function (stdClass $item) {
            ProductStorage::create([
                'product_id' => $item->product_id,
                'storage_id' => $item->storage_id,
                'count'      => $item->count,
                'deleted_at' => null
            ]);
        });

        DB::connection('old')->table('products_assets')->get()->each(function (stdClass $item) {
            ProductAsset::create([
                'id'          => $item->id,
                'name'        => $item->name,
                'storage_id'  => $item->storage,
                'price'       => $item->price,
                'created_at'  => $item->date,
                'updated_at'  => $item->date,
                'course'      => $item->course,
                'code'        => $item->id_in_storage,
                'deleted_at'  => $item->archive ? now() : null,
                'description' => htmlspecialchars_decode($item->description)
            ]);
        });

        DB::connection('old')->table('combine_product')->get()->each(function ($item) {
            ProductLinked::create([
                'product_id' => $item->product_id,
                'linked_id'  => $item->linked_id,
                'price'      => $item->combine_price,
                'minus'      => $item->combine_minus
            ]);
        });

    }
}
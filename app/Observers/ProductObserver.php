<?php

namespace App\Observers;

use App\Models\Product;
use App\Services\TranslateService;

class ProductObserver
{
    private $translatable = [
        'name',
        'model',
        'description',
        'meta_title',
        'meta_description',
        'meta_keywords'
    ];

    public function creating(Product $product)
    {
        foreach ($this->translatable as $field) {
            if (!$product->{"{$field}_ru"} and $product->{"{$field}_uk"}) {
                $product->{"{$field}_ru"} = app(TranslateService::class)->get(
                    $product->{"{$field}_uk"}
                );
            }
        }

        try {
            if (!$product->author_id) {
                $product->author_id = user()->id;
            }
        } catch (\Exception $exception) {

        }


        if (!$product->product_key) {
            $product->product_key = rand32();
        }
    }
}

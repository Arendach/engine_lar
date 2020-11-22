<?php

namespace App\Http\Controllers\Rozetka;

use App\Http\Controllers\Controller;
use App\Models\Product;

class ProductsController extends Controller
{
    public function sectionMain()
    {
        $products = Product::where('is_rozetka', true)->get();

        return view('rozetka.products.main', compact('products'));
    }
}
<?php

namespace App\Http\Controllers\Shop;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Shop\Category;
use App\Models\Shop\Order;
use App\Repositories\Shop\ProductRepository;
use Illuminate\View\View;

class ProductsController extends Controller
{
    private $productRepository;

    public function __construct(ProductRepository $productRepository)
    {
        $this->productRepository = $productRepository;
    }

    public function sectionMain(): View
    {
        $products = $this->productRepository->getForList();
        $categories = Category::getTreeSelect();

        return view('shop.products.main', compact('products', 'categories'));
    }

    public function sectionUpdate(int $id): View
    {
        $product = Product::findOrFail($id);

        return view('shop.products.update.main', compact('product'));
    }

    public function sectionImport(): View
    {
        return view('shop.products.import');
    }

    public function sectionDetails(int $id): View
    {
        $order = Order::findOrFail($id);

        return view('shop.orders.details', compact('order'));
    }


    public function actionSearchForImport(string $search): View
    {
        $exclude = \App\Models\Shop\Product::all()->map(function (\App\Models\Shop\Product $product) {
            return $product->product_key;
        })->toArray();

        $products = Product::search($search)->whereNotIn('product_key', $exclude)->limit(30)->get();

        return view('shop.products.search_results', compact('products'));
    }
}
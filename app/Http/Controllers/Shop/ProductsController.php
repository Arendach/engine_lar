<?php

namespace App\Http\Controllers\Shop;

use App\Http\Controllers\Controller;
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

    public function sectionDetails(int $id): View
    {
        $order = Order::findOrFail($id);

        return view('shop.orders.details', compact('order'));
    }
}
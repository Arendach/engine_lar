<?php

namespace App\Http\Controllers;

use App\Models\Inventory;
use App\Models\InventoryProduct;
use App\Models\Manufacturer;
use App\Models\Product;
use App\Models\ProductStorage;
use App\Models\Storage;
use App\Services\CategoryTree;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;

class InventoryController extends Controller
{
    public $access = 'inventory';

    public function sectionMain()
    {
        $inventory = Inventory::with( 'user', 'manufacturer', 'storage')
            ->withCount('products')
            ->latest()
            ->paginate(config('app.items'));

        return view('inventory.main', compact('inventory'));
    }

    public function sectionPrint(int $id)
    {
        $inventory = Inventory::with('products')->findOrFail($id);

        return view('inventory.print', compact('inventory'));
    }

    public function sectionCreate(CategoryTree $categoryTree)
    {
        $categories = $categoryTree->option();
        $storage = Storage::all();
        $manufacturers = Manufacturer::all();

        return view('inventory.create', compact('categories', 'storage', 'manufacturers'));
    }

    public function actionForm(int $manufacturer_id, int $storage_id, int $category_id = null)
    {
        $builder = Product::with('storage', 'storage_list')
            ->where('manufacturer_id', $manufacturer_id)
            ->whereHas('storage_list', function (Builder $builder) use ($storage_id) {
                $builder->where('storage_id', $storage_id);
            });

        if (!is_null($category_id) && $category_id != 0) {
            $builder->where('category_id', $category_id);
        }

        $products = $builder->get();

        return view('inventory.form', compact('products'));
    }

    public function actionCreate(Request $request)
    {
        $inventory = Inventory::create($request->only('comment', 'manufacturer_id', 'storage_id'));

        foreach ($request->products as $id => $amount) {
            if (is_null($amount) || $amount == 0) {
                continue;
            }

            $pts = ProductStorage::filter($request->storage_id, $id);
            if (!$pts->count()) {
                ProductStorage::create([
                    'storage_id' => $request->storage_id,
                    'product_id' => $id,
                    'count'      => 0
                ]);
            }
            $pts = $pts->first();

            $oldCount = $pts->count;

            $pts->count += $amount;
            $pts->save();

            InventoryProduct::create([
                'inventory_id' => $inventory->id,
                'product_id'   => $id,
                'amount'       => $amount,
                'old_count'    => $oldCount
            ]);
        }
    }
}
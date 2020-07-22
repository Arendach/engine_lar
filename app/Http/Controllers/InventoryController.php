<?php

namespace App\Http\Controllers;

use App\Http\Requests\Inventory\CreateInventoryRequest;
use App\Models\Inventory;
use App\Models\Manufacturer;
use App\Models\Product;
use App\Models\Storage;
use App\Services\CategoryTree;
use App\Services\InventoryService;
use Illuminate\Database\Eloquent\Builder;

class InventoryController extends Controller
{
    public $access = 'inventory';

    private $inventoryService;

    public function __construct(InventoryService $inventoryService)
    {
        $this->inventoryService = $inventoryService;
    }

    public function sectionMain()
    {
        $inventory = Inventory::with('user', 'manufacturer', 'storage')
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
        $products = Product::with('storages', 'storage_list')
            ->where('manufacturer_id', $manufacturer_id)
            ->whereHas('storage_list', function (Builder $builder) use ($storage_id) {
                $builder->where('storage_id', $storage_id);
            })
            ->when(!is_null($category_id) && $category_id != 0, function (Builder $builder) use ($category_id) {
                $builder->where('category_id', $category_id);
            })
            ->get();

        return view('inventory.form', compact('products'));
    }

    public function actionCreate(CreateInventoryRequest $request)
    {
        $data = $request->validated();

        $products = $data['products'];

        unset($data['products']);

        $this->inventoryService->createInventory($data, $products);
    }
}
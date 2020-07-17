<?php

namespace App\Http\Controllers;

use App\Filters\ProductSearchFilter;
use App\Filters\PurchaseFilter;
use App\Http\Requests\Purchase\CreatePaymentRequest;
use App\Http\Requests\Purchase\CreatePurchaseRequest;
use App\Http\Requests\Purchase\UpdatePurchaseRequest;
use App\Http\Requests\Purchase\UpdatePurchaseTypeRequest;
use App\Models\Manufacturer;
use App\Models\Product;
use App\Models\Purchase;
use App\Models\Storage;
use App\Services\CategoryTree;
use App\Services\PurchaseService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class PurchaseController extends Controller
{
    public $access = 'purchase';

    private $service;

    public function __construct()
    {
        $this->service = app(PurchaseService::class);
    }

    public function sectionMain(PurchaseFilter $filter)
    {
        $purchases = Purchase::with('storage', 'manufacturer')
            ->filter($filter)
            ->paginate(config('app.items'))
            ->appends(request()->all());

        $storage = Storage::where('is_accounted', true)->orderBy('priority')->get();
        $manufacturers = Manufacturer::all();

        return view('purchase.main', compact('purchases', 'storage', 'manufacturers'));
    }

    public function sectionCreate(Request $request, CategoryTree $categoryTree)
    {
        $data = [
            'manufacturers' => Manufacturer::all(),
            'categories'    => $categoryTree->option(),
            'warehouses'    => Storage::where('is_accounted', true)->get()
        ];

        if ($request->has('storage_id')) {
            $data['storage'] = Storage::findOrFail($request->storage_id);
        }

        if ($request->has('manufacturer_id')) {
            $data['manufacturer'] = Manufacturer::findOrFail($request->manufacturer_id);
        }

        return view('purchase.create', $data);
    }

    public function sectionUpdate(int $id, CategoryTree $categoryTree)
    {
        $purchase = Purchase::findOrFail($id)->load('products', 'payments');
        $categories = $categoryTree->option();

        return view('purchase.update', compact('purchase', 'categories'));
    }

    public function sectionPrint(int $id)
    {
        $purchase = Purchase::findOrFail($id);

        return view('purchase.print', compact('purchase'));
    }


    public function actionCreate(CreatePurchaseRequest $request): JsonResponse
    {
        $purchase = $this->service->create($request->validated());

        return response()->json([
            'url' => $purchase->url
        ]);
    }

    public function actionSearchProducts(ProductSearchFilter $filter)
    {
        $products = Product::with('storages')->filter($filter)->get();

        return view('purchase.products', compact('products'));
    }

    public function actionUpdate(UpdatePurchaseRequest $request): void
    {
        $this->service->update($request->get('id'), $request->validated());
    }

    public function actionUpdateType(UpdatePurchaseTypeRequest $request): void
    {
        $this->service->updateType($request->get('id'));
    }

    public function actionGetProduct(Request $request)
    {
        $product = Product::findOrFail($request->id)->load('storages');
        $storageId = $request->storage_id;

        return view('purchase.get_product', compact('product', 'storageId'));
    }

    public function actionCreatePaymentForm(Request $request): View
    {
        $purchase = Purchase::findOrFail($request->get('id'));

        return view('purchase.create_payment_form', compact('purchase'));
    }

    public function actionCreatePayment(CreatePaymentRequest $request)
    {
        $this->service->createPayment($request->get('purchase_id'), $request->validated());
    }
}
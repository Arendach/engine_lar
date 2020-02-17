<?php

namespace App\Http\Controllers;

use App\Filters\ProductSearchFilter;
use App\Filters\PurchaseFilter;
use App\Models\Manufacturer;
use App\Models\Product;
use App\Models\Purchase;
use App\Models\Storage;
use App\Services\CategoryTree;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;

class PurchaseController extends Controller
{
    public $access = 'purchase';

    public function sectionMain(PurchaseFilter $filter)
    {
        $purchases = Purchase::with('storage', 'manufacturer')
            ->filter($filter)
            ->paginate(config('app.items'))
            ->appends(request()->all());

        $storage = Storage::accounted(true)->get();
        $manufacturers = Manufacturer::all();

        return view('purchase.main', compact('purchases', 'storage', 'manufacturers'));
    }

    public function sectionCreate(Request $request, CategoryTree $categoryTree)
    {
        $data = [
            'manufacturers' => Manufacturer::all(),
            'categories'    => $categoryTree->option(),
            'warehouses'    => Storage::accounted(true)->get()
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


    public function actionCreate(Request $request)
    {
//        if (!isset($post->products) || my_count($post->products) == 0)
//            response(400, 'Виберіть хоча-б один товар!');
//
//        if (!isset($post->manufacturer_id))
//            response(400, 'Виберіть виробника!');
//
//        if (!isset($post->storage_id))
//            response(400, 'Виберіть склад!');

        Purchase::create($request->except('products'))
            ->products()
            ->attach($request->products);
    }

    public function actionSearchProducts(Request $request, ProductSearchFilter $filter)
    {
        $products = Product::with('storages')->filter($filter)->get();

        return view('purchase.products', compact('products'));
    }

    public function action_update($post)
    {
        if (empty($post->products)) response(400, 'Виберіть хоча-б один товар!');

        $comment = isset($post->comment) ? $post->comment : '';

        Purchases::updateProducts($post->id, $post->products, $post->sum, $comment);

        response(200, DATA_SUCCESS_UPDATED);
    }

    public function action_update_type($post)
    {
        if ($post->type == 0) response(200, DATA_SUCCESS_UPDATED);

        Purchases::close($post->id);

        response(200, ['action' => 'redirect', 'uri' => uri('purchases'), 'message' => DATA_SUCCESS_UPDATED]);
    }

    public function actionGetProduct(Request $request)
    {
        $product = Product::findOrFail($request->id)->load('storages');
        $storageId = $request->storage_id;

        return view('purchase.get_product', compact('product', 'storageId'));
    }

    public function action_payment_create_form($post)
    {
        $payments = Purchases::getPayments($post->id);

        $payed = 0;
        foreach ($payments as $item) $payed += $item->sum;


        $sum = Purchases::getOne($post->id);

        $sum = $sum->sum;

        $data = [
            'title' => 'Нова проплата',
            'sum'   => $sum,
            'payed' => $payed,
            'id'    => $post->id
        ];

        $this->view->display('purchases.forms.create_payment', $data);
    }

    public function action_payment_create($post)
    {
        $payments = Purchases::getPayments($post->id);

        $payed = 0;
        foreach ($payments as $item) $payed += $item->sum;

        $sum = Purchases::getOne($post->id);

        $sum = $sum->sum;

        if (($sum - $payed) - $post->sum < 0) response(400, 'Сума проплати перевищує суму всієї закупки!');

        Purchases::createPayment($post, ($sum - $payed) - $post->sum);

        Reports::createPurchasePayment($post);

        response(200, DATA_SUCCESS_CREATED);
    }
}
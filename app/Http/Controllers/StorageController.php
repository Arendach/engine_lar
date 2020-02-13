<?php

namespace App\Http\Controllers;

use App\Http\Requests\Storage\UniversalRequest;
use App\Models\Storage;
use Illuminate\Http\Request;

class StorageController extends Controller
{
    public $access = 'storage';

    public function sectionMain()
    {
        $storage = Storage::all();

        return view('storage.main', compact('storage'));
    }

    public function actionFormCreate()
    {
        return view('storage.form_create');
    }

    public function actionFormUpdate(int $id)
    {
        $storage = Storage::findOrFail($id);

        return view('storage.form_update', compact('storage'));
    }

    public function actionDelete(int $id)
    {
        Storage::findOrFail($id)->delete();
    }

    public function actionCreate(UniversalRequest $request)
    {
        Storage::create($request->merge([
            'delivery' => $request->get('delivery', 0),
            'self'     => $request->get('self', 0),
            'sending'  => $request->get('sending', 0)
        ])->all());
    }

    public function actionUpdate(UniversalRequest $request)
    {
        Storage::findOrFail($request->id)->update($request->merge([
            'delivery' => $request->get('delivery', 0),
            'self'     => $request->get('self', 0),
            'sending'  => $request->get('sending', 0)
        ])->all());
    }

    /**
     * @param Request $request
     * @todo rewrite
     */
    public function apiCountProducts(Request $request)
    {
        $ids = implode("','", (array)$post->ids);

        $products = R::findAll('products', "`product_key` IN('$ids')");

        $result = [];
        foreach ($products as $product) {
            $pts = R::findAll('product_to_storage', 'product_id = ?', [$product->id]);

            $result[$product->product_key] = [];

            foreach ($pts as $pt) {
                $storage = R::load('storage', $pt->storage_id);

                $result[$product->product_key][] = [
                    'count' => $pt->count,
                    'name'  => $storage->name,
                    'id'    => $storage->id
                ];
            }
        }

        header('Content-Type: application/json');

        echo json($result);
    }
}

?>
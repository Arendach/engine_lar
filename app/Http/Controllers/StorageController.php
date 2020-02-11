<?php

namespace App\Http\Controllers;

use App\Http\Requests\Storage\UniversalRequest;
use App\Models\Storage;

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
        $data = [
            'title'      => 'Оновити склад',
            'storage'    => Storage::getOne($post->id),
            'modal_size' => 'lg'
        ];

        return view('storage.form_update', $data);
    }

    public function action_delete($post)
    {
        Storage::delete($post->id);

        response(200, DATA_SUCCESS_DELETED);
    }

    public function actionCreate(UniversalRequest $request)
    {
        Storage::create($request->all());
    }

    public function action_update($post)
    {
        if (!isset($post->self)) $post->self = 0;
        if (!isset($post->delivery)) $post->delivery = 0;
        if (!isset($post->shop)) $post->shop = 0;
        if (!isset($post->sending)) $post->sending = 0;

        if (empty($post->name))
            response(400, 'Заповніть назву складу!');

        Storage::update($post, $post->id);

        response(200, DATA_SUCCESS_UPDATED);
    }

    public function api_count_products($post)
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
<?php

namespace App\Http\Controllers;

use App\Http\Requests\Manufacturer\CreateRequest;
use App\Http\Requests\Manufacturer\UpdateRequest;
use App\Models\Manufacturer;

class ManufacturerController extends Controller
{
    public $access = 'manufacturer';

    public function sectionMain()
    {
        $manufacturers = Manufacturer::all();

        return view('manufacturer.main', compact('manufacturers'));
    }

    public function actionCreateForm()
    {
        return view('manufacturer.create_form');
    }

    public function actionCreate(CreateRequest $request)
    {
        Manufacturer::create($request->all());
    }

    public function actionUpdateForm(int $id)
    {
        $manufacturer = Manufacturer::findOrFail($id);

        return view('manufacturer.update_form', compact('manufacturer'));
    }

    public function actionUpdate(UpdateRequest $request)
    {
        Manufacturer::findOrFail($request->id)->update($request->all());
    }

    public function actionDelete(int $id)
    {
        Manufacturer::findOrFail($id)->delete();
    }

    public function sectionPrint(array $ids)
    {
        $manufacturers = Manufacturer::findMany($ids);

        return view('manufacturer.print', compact('manufacturers'));
    }

    public function api_test()
    {
        $array = [];
        $manufacturers = Manufacturers::getAll();
        foreach ($manufacturers as $item) {
            $array[] = [
                'id' => $item->id,
                'name_uk' => $item->name,
                'name_ru' => $item->name_ru,
                'photo_uk' => $item->photo_uk,
                'photo_ru' => $item->photo_ru,
            ];
        }

        echo \GuzzleHttp\json_encode($array);
    }
}
<?php

namespace App\Http\Controllers;

use App\Http\Requests\Manufacturer\CreateRequest;
use App\Http\Requests\Manufacturer\UpdateRequest;
use App\Models\Manufacturer;
use Illuminate\View\View;

class ManufacturerController extends Controller
{
    public $access = 'manufacturer';

    public function sectionMain(): View
    {
        $manufacturers = Manufacturer::all();

        return view('manufacturer.main', compact('manufacturers'));
    }

    public function actionCreateForm(): View
    {
        return view('manufacturer.create_form');
    }

    public function actionCreate(CreateRequest $request): void
    {
        Manufacturer::create($request->validated());
    }

    public function actionUpdateForm(int $id): View
    {
        $manufacturer = Manufacturer::findOrFail($id);

        return view('manufacturer.update_form', compact('manufacturer'));
    }

    public function actionUpdate(UpdateRequest $request): void
    {
        Manufacturer::findOrFail($request->id)->update($request->all());
    }

    public function actionDelete(int $id): void
    {
        Manufacturer::findOrFail($id)->delete();
    }

    public function sectionPrint(array $ids): View
    {
        $manufacturers = Manufacturer::findMany($ids);

        return view('manufacturer.print', compact('manufacturers'));
    }
}
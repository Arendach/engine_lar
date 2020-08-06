<?php

namespace App\Http\Controllers;

use App\Http\Requests\Storage\CreateRequest;
use App\Http\Requests\Storage\UpdateRequest;
use App\Models\Storage;
use Illuminate\View\View;

class StorageController extends Controller
{
    public $access = 'storage';

    public function sectionMain(): View
    {
        $storage = Storage::orderByDesc('priority')->get();

        return view('storage.main', compact('storage'));
    }

    public function actionFormCreate(): View
    {
        return view('storage.form_create');
    }

    public function actionFormUpdate(int $id): View
    {
        $storage = Storage::findOrFail($id);

        return view('storage.form_update', compact('storage'));
    }

    public function actionDelete(int $id): void
    {
        Storage::findOrFail($id)->delete();
    }

    public function actionCreate(CreateRequest $request): void
    {
        Storage::create($request->validated());
    }

    public function actionUpdate(UpdateRequest $request): void
    {
        Storage::findOrFail($request->id)->update($request->merge([
            'delivery' => $request->get('delivery', 0),
            'self'     => $request->get('self', 0),
            'sending'  => $request->get('sending', 0)
        ])->validated());
    }
}
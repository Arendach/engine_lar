<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UniversalController extends Controller
{
    public function destroy(Request $request)
    {

    }

    public function actionUpdate(Request $request)
    {
        $model = $request->get('model');
        $connection = $request->get('shop');

        $modelInstance = resolve($model);

        if ($connection) {
            $modelInstance = $modelInstance->connection($connection);
        }

        $modelInstance->findOrFail($request->id)->update([
            $request->field => $request->value
        ]);
    }
}
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
        $connection = app($model)->connection('shop'); // Надо как то передать  ТЕКУЩИЙ коннекшн вместо shop
        $connection->findOrFail($request->id)->update([
            $request->field => $request->value
        ]);
    }
}
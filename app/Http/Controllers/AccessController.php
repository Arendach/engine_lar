<?php

namespace App\Http\Controllers;

use App\Http\Requests\Access\UniversalAccessRequest;
use App\Models\UserAccess;

class AccessController extends Controller
{
    public $access = 'access';

    public function sectionMain()
    {
        $groups = UserAccess::all();

        return view('access.main', compact('groups'));
    }

    public function sectionUpdate(int $id)
    {
        $group = UserAccess::findOrFail($id);
        $access = assets('access');

        return view('access.update', compact('group', 'access'));
    }

    public function actionUpdate(UniversalAccessRequest $request)
    {
        UserAccess::findOrFail($request->id)->update($request->all());
    }

    public function sectionCreate()
    {
        $access = assets('access');

        return view('access.create', compact('access'));
    }

    public function actionCreate(UniversalAccessRequest $request)
    {
        $id = UserAccess::create($request->all())->id;

        return response()->json([
            'redirectTo' => uri('AccessController@sectionUpdate', ['id' => $id])
        ], 200);
    }

    public function actionDelete(int $id)
    {
        UserAccess::findOrFail($id)->delete();
    }
}
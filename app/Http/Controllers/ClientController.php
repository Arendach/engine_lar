<?php

namespace App\Http\Controllers;

use App\Filters\ClientFilter;
use App\Http\Requests\Client\CreateRequest;
use App\Http\Requests\Client\UniversalGroupRequest;
use App\Models\Client;
use App\Models\ClientGroup;
use App\Models\User;
use App\Http\Requests\Client\UpdateRequest;

class ClientController extends Controller
{
    public $access = 'client';

    public function sectionMain(ClientFilter $clientFilter)
    {
        $clients = Client::with('group')
            ->filter($clientFilter)
            ->orderByDesc('id')
            ->paginate(config('app.items'))
            ->appends(request()->all());

        $groups = ClientGroup::all();

        return view('client.main', compact('clients', 'groups'));
    }

    public function actionCreateForm()
    {
        $groups = ClientGroup::all();
        $users = User::all();
        return view('client.forms.create_client', compact('users', 'groups'));
    }


    public function actionUpdateForm(int $id)
    {
        $groups = ClientGroup::all();
        $client = Client::findOrFail($id);
        $users = User::all();

        return view('client.forms.update_client', compact('groups', 'client', 'users'));
    }

    public function actionCreate(CreateRequest $request)
    {
        Client::create($request->all());
    }

    public function actionUpdate(UpdateRequest $request)
    {
        Client::findOrFail($request->id)->update($request->all());
    }

    public function actionDelete(int $id)
    {
        Client::findOrFail($id)->delete();
    }

    public function sectionOrders(int $id)
    {
        $client = Client::findOrFail($id)->load('orders');

        return view('client.orders', compact('client'));
    }

    public function sectionGroups()
    {
        $groups = ClientGroup::all();

        return view('client.groups', compact('groups'));
    }

    public function actionCreateGroup(UniversalGroupRequest $request)
    {
        ClientGroup::create($request->all());
    }

    public function actionUpdateGroupForm(int $id)
    {
        $group = ClientGroup::findOrFail($id);

        return view('client.forms.update_group', compact('group'));
    }

    public function actionCreateGroupForm()
    {
        return view('client.forms.create_group');
    }

    public function actionUpdateGroup(UniversalGroupRequest $request)
    {
        ClientGroup::findOrFail($request->id)->update($request->all());
    }

    public function actionDeleteGroup(int $id)
    {
        ClientGroup::findOrFail($id)->delete();
    }

}
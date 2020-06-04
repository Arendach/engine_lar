<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SettingController extends Controller
{
    private $config = [];

    private $part = '';

    public function __construct()
    {
        if (request()->has('part')) {
            $this->part = request()->get('part', 'hints');
            $this->config = assets('settings')[$this->part];
        }
    }

    public function index()
    {
        return view('setting.index');
    }

    public function show($part)
    {
        $config = assets('settings')[$part];

        $items = isset($config['paginate'])
            ? $config['model']::paginate($config['paginate'])
            : $config['model']::all();

        $data = [
            'title'  => $config['title'],
            'items'  => $items,
            'fields' => $config['fields'],
            'part'   => $part
        ];

        return view('setting.show', $data);
    }

    public function create()
    {
        $data = [
            'fields' => $this->config['fields'],
            'part'   => $this->part
        ];

        return view('setting.create', $data);
    }

    public function store(Request $request)
    {
        $this->config['model']::create($request->except('_method', 'part'));
    }

    public function edit(Request $request, $id)
    {
        $row = $this->config['model']::findOrFail($id);

        $data = [
            'row'     => $row,
            'fields'  => $this->config['fields'],
            'part'    => $this->part,
            'hasMany' => $this->config['hasMany'] ?? []
        ];

        return view('setting.edit', $data);
    }

    public function update(Request $request, int $id)
    {
        $this->config['model']::findOrFail($id)->update($request->except('_method', 'part'));

        return response()->json();
    }

    public function destroy(int $id)
    {
        $this->config['model']::findOrFail($id)->delete();
    }

    public function actionHasManyCreate(Request $request)
    {
        $this->config['model']::findOrFail($request->id)
            ->{"$request->relation"}()
            ->create($request->except('relation', 'id', 'part'));
    }

    public function actionHasManyDelete(Request $request)
    {
        $this->config['model']::findOrFail($request->id)
            ->{"$request->relation"}()
            ->where('id', $request->relation_id)
            ->delete();
    }
}
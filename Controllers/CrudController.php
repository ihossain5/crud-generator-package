<?php

namespace Ismail\CrudGenerator\Controllers;

use App\Http\Controllers\Controller;
use Ismail\CrudGenerator\Models\CrudModel;
use Ismail\CrudGenerator\Requests\CrudRequest;

class CrudController extends Controller {
    public function index() {
        $data = CrudModel::all();

        return view('crud.index', compact('data'));
    }

    public function create() {
        return view('crud.create');
    }

    public function store(CrudRequest $request) {
        CrudModel::create($request->validated());

        return redirect()->route('crud.index')->with('success', 'Record created successfully.');
    }

    public function edit($id) {
        $data = CrudModel::findOrFail($id);

        return view('crud.edit', compact('data'));
    }

    public function update(CrudRequest $request, $id) {
        $data = CrudModel::findOrFail($id);

        $data->update($request->validated());

        return redirect()->route('crud.index')->with('success', 'Record updated successfully.');
    }

    public function destroy($id) {
        $data = CrudModel::findOrFail($id);

        $data->delete();

        return redirect()->route('crud.index')->with('success', 'Record deleted successfully.');
    }
}
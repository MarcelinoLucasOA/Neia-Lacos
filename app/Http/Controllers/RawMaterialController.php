<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\RawMaterials\{
    StoreRawMaterialsRequest,
    UpdateRawMaterialRequest,
};
use App\Models\{
    RawMaterial,
    Unit,
};

class RawMaterialController extends Controller
{
    public function index()
    {
        $rawMaterials = RawMaterial::orderBy('name')->paginate(10);
        $units = Unit::all();
        return view('raw_materials.index', compact('rawMaterials', 'units'));
    }

    public function store(StoreRawMaterialsRequest $request)
    {
        $validatedData = $request->validated();
        RawMaterial::create($validatedData);

        return redirect()->route('raw_materials.show')->with('success', 'Matéria-prima criada com sucesso!');
    }

    public function show(RawMaterial $rawMaterial)
    {
        $units = Unit::all();
        return view('raw_materials.show', compact(['rawMaterial', 'units']));
    }

    public function update(UpdateRawMaterialRequest $request, RawMaterial $rawMaterial)
    {
        $validatedData = $request->validated();
        $rawMaterial->update($validatedData);

        return redirect()->route('raw_materials.show', $rawMaterial->id)->with('success', 'Matéria-prima atualizada com sucesso!');
    }
}

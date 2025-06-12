<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\RawMaterial;
use App\Models\Unit;
use Illuminate\Validation\Rule;

use Exception;

class RawMaterialController extends Controller
{
    public function index()
    {
        $rawMaterials = RawMaterial::orderBy('name')->paginate(10);
        $units = Unit::all();
        return view('raw_materials.index', compact('rawMaterials', 'units'));
    }

    public function create()
    {
        $units = Unit::all();
        return view('raw_materials.create', compact('units'));
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255|unique:raw_materials,name',
            'description' => 'nullable|string',
            'unit_id' => 'required|exists:units,id',
            'cost_per_unit' => 'nullable|numeric|min:0',
            'min_stock_level' => 'required|integer|min:0',
        ]);

        RawMaterial::create($validatedData);

        return redirect()->route('raw_materials.index')->with('success', 'Matéria-prima criada com sucesso!');
    }

    public function show(RawMaterial $rawMaterial)
    {
        return view('raw_materials.show', compact('rawMaterial'));
    }

    public function edit(RawMaterial $rawMaterial)
    {
        $units = Unit::all();
        return view('raw_materials.edit', compact('rawMaterial', 'units'));
    }

    public function update(Request $request, RawMaterial $rawMaterial)
    {
        $validatedData = $request->validate([
            'name' => [
                'required',
                'string',
                'max:255',
                Rule::unique('raw_materials', 'name')->ignore($rawMaterial->id),
            ],
            'description' => 'nullable|string',
            'unit_id' => 'required|exists:units,id',
            'cost_per_unit' => 'nullable|numeric|min:0',
            'min_stock_level' => 'required|integer|min:0',
        ]);

        $rawMaterial->update($validatedData);

        return redirect()->route('raw_materials.index')->with('success', 'Matéria-prima atualizada com sucesso!');
    }

    public function destroy(RawMaterial $rawMaterial)
    {
        try {
            $rawMaterial->delete();
            return redirect()->route('raw_materials.index')->with('success', 'Matéria-prima excluída com sucesso!');
        } catch (Exception $e) {
            return redirect()->route('raw_materials.index')->with('error', 'Erro ao excluir matéria-prima: ' . $e->getMessage());
        }
    }
}

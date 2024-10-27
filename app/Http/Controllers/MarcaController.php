<?php

namespace App\Http\Controllers;

use App\Models\Marca;
use Illuminate\Http\Request;

class MarcaController extends Controller
{
    public function index()
    {
        $marcas = Marca::all();
        return view('marcas.index', compact('marcas'));
    }

    public function create()
    {
        return view('marcas.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string|max:255'
        ]);

        Marca::create($request->all());

        return redirect()->route('marcas.index')->with('success', 'Marca creada con éxito.');
    }

    public function show($id)
    {
        $marca = Marca::findOrFail($id);
        return view('marcas.show', compact('marca'));
    }

    public function edit($id)
    {
        $marca = Marca::findOrFail($id);
        return view('marcas.edit', compact('marca'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nombre' => 'required|string|max:255'
        ]);

        $marca = Marca::findOrFail($id);
        $marca->update($request->all());

        return redirect()->route('marcas.index')->with('success', 'Marca actualizada con éxito.');
    }

    public function destroy($id)
    {
        $marca = Marca::findOrFail($id);
        $marca->delete();

        return redirect()->route('marcas.index')->with('success', 'Marca eliminada con éxito.');
    }
}

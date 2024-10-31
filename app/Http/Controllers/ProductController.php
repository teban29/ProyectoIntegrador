<?php

namespace App\Http\Controllers;

use App\Models\Producto;
use App\Models\Marca; // Asegúrate de importar el modelo Marca
use App\Models\Categoria; // Asegúrate de importar el modelo Categoria
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        $query = Producto::query();
    
        if ($request->filled('search')) {
            $query->where('nombre', 'like', '%' . $request->input('search') . '%');
        }
        if ($request->filled('marca_id')) {
            $query->where('marca_id', $request->input('marca_id'));
        }
        if ($request->filled('categoria_id')) {
            $query->where('categoria_id', $request->input('categoria_id'));
        }
    
        $productos = $query->get();
        $marcas = Marca::all();
        $categorias = Categoria::all();
    
        return view('tienda.index', compact('productos', 'marcas', 'categorias'));
    }
    

    public function show($id)
    {
        // Encontrar el producto por su ID
        $producto = Producto::findOrFail($id);

        // Retornar la vista del detalle del producto
        return view('tienda.show', compact('producto'));
    }
}

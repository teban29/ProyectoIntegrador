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
        // Crear una consulta base
        $query = Producto::query();
    
        // Filtro por búsqueda (si el campo 'search' está lleno)
        if ($request->filled('search')) {
            $query->where('nombre', 'like', '%' . $request->input('search') . '%');
        }
    
        // Filtro por marca (si el campo 'marca_id' está lleno)
        if ($request->filled('marca_id')) {
            $query->where('marca_id', $request->input('marca_id'));
        }
    
        // Filtro por categoría (si el campo 'categoria_id' está lleno)
        if ($request->filled('categoria_id')) {
            $query->where('categoria_id', $request->input('categoria_id'));
        }
    
        // Obtener los productos filtrados
        $productos = $query->get();
    
        // Obtener todas las marcas y categorías para los select
        $marcas = Marca::all();
        $categorias = Categoria::all();
    
        // Retornar la vista con los productos de la tienda
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

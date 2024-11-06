<?php

namespace App\Http\Controllers;

use App\Models\Producto;
use App\Models\Marca;
use App\Models\Categoria;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AdminProductController extends Controller
{
    public function index(Request $request)
    {
        // Crear una consulta base
        $query = Producto::query();

        // Filtro por búsqueda (si el campo 'search' está lleno)
        if ($request->filled('search')) {
            $query->where('nombre', 'like', '%' . $request->input('search') . '%');
        }

        // Obtener los productos filtrados
        $productos = $query->get();

        // Retornar la vista con los productos
        return view('productos.index', compact('productos'));
    }

    public function create()
    {
        // Obtener todas las marcas y categorías para los select
        $marcas = Marca::all();
        $categorias = Categoria::all();

        return view('productos.create', compact('marcas', 'categorias'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
            'descripcion' => 'required|string|max:1000', // Validar la descripción
            'precio' => 'required|numeric',
            'stock' => 'required|integer|min:0',
            'imagen' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // Validar la imagen
            'marca_id' => 'required|exists:marcas,id', // Validar marca
            'categoria_id' => 'required|exists:categorias,id', // Validar categoría
        ]);

        // Crear un nuevo producto
        $producto = new Producto();
        $producto->nombre = $request->input('nombre');
        $producto->descripcion = $request->input('descripcion'); // Añadir descripción
        $producto->precio = $request->input('precio');
        $producto->stock = $request->input('stock');
        $producto->marca_id = $request->input('marca_id');
        $producto->categoria_id = $request->input('categoria_id');

        // Manejar la carga de la imagen
        if ($request->hasFile('imagen')) {
            $path = $request->file('imagen')->store('productos', 'public');
            $producto->imagen_url = $path; // Cambia 'imagen' a 'imagen_url'
        }
        

        $producto->save();

        return redirect()->route('productos.index')->with('success', 'Producto creado con éxito.');
    }

    public function show($id)
    {
        // Encontrar el producto por su ID
        $producto = Producto::findOrFail($id);

        // Retornar la vista del detalle del producto
        return view('productos.show', compact('producto'));
    }

    public function edit($id)
    {
        // Encontrar el producto por su ID
        $producto = Producto::findOrFail($id);

        // Obtener todas las marcas y categorías para los select
        $marcas = Marca::all();
        $categorias = Categoria::all();

        return view('productos.edit', compact('producto', 'marcas', 'categorias'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
            'descripcion' => 'required|string|max:1000', // Validar la descripción
            'precio' => 'required|numeric',
            'stock' => 'required|integer|min:0',
            'imagen' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // Validar la imagen
            'marca_id' => 'required|exists:marcas,id', // Validar marca
            'categoria_id' => 'required|exists:categorias,id', // Validar categoría
        ]);

        // Encontrar el producto
        $producto = Producto::findOrFail($id);
        $producto->nombre = $request->input('nombre');
        $producto->descripcion = $request->input('descripcion'); // Actualizar descripción
        $producto->precio = $request->input('precio');
        $producto->stock = $request->input('stock');
        $producto->marca_id = $request->input('marca_id');
        $producto->categoria_id = $request->input('categoria_id');

        // Manejar la carga de la imagen
        if ($request->hasFile('imagen')) {
            // Eliminar la imagen anterior si existe
            if ($producto->imagen_url) {
                Storage::disk('public')->delete($producto->imagen_url);
            }
            $path = $request->file('imagen')->store('productos', 'public'); // Guarda la nueva imagen
            $producto->imagen_url = $path; // Guarda la nueva ruta en la base de datos
        }

        $producto->save();

        return redirect()->route('productos.index')->with('success', 'Producto actualizado con éxito.');
    }

    public function destroy($id)
    {
        // Encontrar el producto
        $producto = Producto::findOrFail($id);

        // Eliminar la imagen si existe
        if ($producto->imagen_url) {
            Storage::disk('public')->delete($producto->imagen_url);
        }

        $producto->delete();

        return redirect()->route('productos.index')->with('success', 'Producto eliminado con éxito.');
    }
}

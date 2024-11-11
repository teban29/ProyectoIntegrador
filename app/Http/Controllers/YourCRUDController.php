<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Producto;
use App\Models\Cita;
use App\Models\Usuario;
use App\Models\Estado;

class YourCRUDController extends Controller
{
    public function index()
    {
        // Verificar si el usuario está autenticado y tiene el rol de administrador
        if (!Auth::check() || Auth::user()->rol_id != 1) {
            return redirect('/')->with('error', 'No tienes acceso a esta sección');
        }

        // Obtener estadísticas para el dashboard
        $totalProductos = Producto::count();
        $citasAgendadas = Cita::count();
        $citasCompletadas = Cita::whereHas('estado', function($query) {
            $query->where('nombre', 'Completada');
        })->count();
        $totalClientes = Usuario::where('rol_id', 3)->count();

        $citasEstadosLabels = Estado::pluck('nombre');
        $citasEstadosData = Estado::withCount('citas')->pluck('citas_count');

        $productosCategoriasLabels = Producto::distinct('categoria_id')->pluck('categoria_id');
        $productosCategoriasData = Producto::selectRaw('count(*) as total, categoria_id')
            ->groupBy('categoria_id')
            ->pluck('total');

        // Pasar los datos a la vista
        return view('gestion.index', compact('totalProductos', 'citasAgendadas', 'citasCompletadas', 'totalClientes', 'citasEstadosLabels', 'citasEstadosData', 'productosCategoriasLabels', 'productosCategoriasData'));
    }

    // Método para mostrar el formulario de creación
    public function create()
    {
        if (!Auth::check() || Auth::user()->rol_id != 1) {
            return redirect('/home')->with('error', 'No tienes acceso a esta sección');
        }

        return view('gestion.create'); // Asegúrate de que esta vista exista
    }

    // Método para almacenar el nuevo usuario
    public function store(Request $request)
    {
        if (!Auth::check() || Auth::user()->rol_id != 1) {
            return redirect('/home')->with('error', 'No tienes acceso a esta sección');
        }

        // Validar y almacenar el nuevo usuario
        // ...

        return redirect()->route('gestion.index')->with('success', 'Usuario creado exitosamente');
    }

    // Métodos para editar, actualizar, eliminar, etc.
}

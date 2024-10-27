<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class YourCRUDController extends Controller
{
    public function index()
    {
        // Verificar si el usuario está autenticado y tiene el rol de administrador
        if (!Auth::check() || Auth::user()->rol_id != 1) {
            return redirect('/')->with('error', 'No tienes acceso a esta sección');
        }

        // Lógica para obtener los datos que quieres mostrar
        return view('gestion.index'); // Asegúrate de que esta vista exista
    }

    // Método para mostrar el formulario de creación
    public function create()
    {
        if (!Auth::check() || Auth::user()->rol_id != 1) {
            return redirect('/')->with('error', 'No tienes acceso a esta sección');
        }

        return view('gestion.create'); // Asegúrate de que esta vista exista
    }

    // Método para almacenar el nuevo usuario
    public function store(Request $request)
    {
        if (!Auth::check() || Auth::user()->rol_id != 1) {
            return redirect('/')->with('error', 'No tienes acceso a esta sección');
        }

        // Validar y almacenar el nuevo usuario
        // ...

        return redirect()->route('gestion.index')->with('success', 'Usuario creado exitosamente');
    }

    // Métodos para editar, actualizar, eliminar, etc.
}

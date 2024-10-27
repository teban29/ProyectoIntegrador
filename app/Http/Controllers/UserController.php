<?php

namespace App\Http\Controllers;

use App\Models\Usuario; // Asegúrate de que estás importando el modelo correcto
use App\Models\Rol; // Importa el modelo Rol
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function index()
    {
        // Obtener todos los usuarios
        $usuarios = Usuario::all();
        return view('usuarios.index', compact('usuarios')); // Asegúrate de que esta vista exista
    }

    public function create()
    {
        // Obtener todos los roles para pasarlos a la vista
        $roles = Rol::all(); // Asegúrate de incluir el modelo Rol en la parte superior: use App\Models\Rol;
    
        return view('usuarios.create', compact('roles'));
    }

public function store(Request $request)
{
    $request->validate([
        'nombre' => 'required|string|max:255',
        'apellido' => 'required|string|max:255',
        'telefono' => 'required|string|max:15',
        'email' => 'required|string|email|max:255|unique:usuarios',
        'password' => 'required|string|min:8|confirmed',
        'rol_id' => 'required|exists:roles,id', // Asegúrate de que el rol exista
    ]);

    $usuario = new Usuario();
    $usuario->nombre = $request->nombre;
    $usuario->apellido = $request->apellido;
    $usuario->telefono = $request->telefono;
    $usuario->email = $request->email;
    $usuario->password = bcrypt($request->password); // Asegúrate de encriptar la contraseña
    $usuario->rol_id = $request->rol_id; // Asigna el rol
    $usuario->save();

    return redirect()->route('usuarios.index')->with('success', 'Usuario creado con éxito');
}
    

    public function show($id)
    {
        // Lógica para mostrar un usuario específico
        $usuario = Usuario::findOrFail($id);
        return view('usuarios.show', compact('usuario'));
    }

    public function edit($id)
    {
        // Lógica para mostrar el formulario de edición
        $usuario = Usuario::findOrFail($id);
        $roles = Rol::all();
        return view('usuarios.edit', compact('usuario', 'roles'));
    }

    public function update(Request $request, $id)
    {
        // Validación de los datos
        $request->validate([
            'nombre' => 'required|string|max:255',
            'apellido' => 'required|string|max:255',
            'telefono' => 'required|string|max:20',
            'email' => 'required|email|unique:usuarios,email,' . $id, // Permite el email actual
            'rol_id' => 'required|exists:roles,id', // Validar que el rol exista
        ]);
    
        // Buscar el usuario
        $usuario = Usuario::findOrFail($id);
    
        // Actualizar el usuario
        $usuario->update([
            'nombre' => $request->nombre,
            'apellido' => $request->apellido,
            'telefono' => $request->telefono,
            'email' => $request->email,
            'rol_id' => $request->rol_id, // Actualizar el rol
        ]);
    
        // Redirigir después de actualizar el usuario
        return redirect()->route('usuarios.index')->with('success', 'Usuario actualizado exitosamente.');
    }
    

    public function destroy($id)
    {
        // Lógica para eliminar el usuario
        $usuario = Usuario::findOrFail($id);
        $usuario->delete();
        return redirect()->route('usuarios.index')->with('success', 'Usuario eliminado exitosamente.');
    }
}

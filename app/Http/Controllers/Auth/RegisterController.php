<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Usuario;
use App\Models\Rol; // Importar el modelo Rol
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    public function showRegistrationForm()
    {
        return view('auth.register');
    }

    public function register(Request $request)
    {
        // Validar los datos del formulario
        $request->validate([
            'nombre' => 'required|string|max:255',
            'apellido' => 'required|string|max:255',
            'telefono' => 'required|string|max:15',
            'email' => 'required|string|email|max:255|unique:usuarios',
            'password' => 'required|string|min:8|confirmed',
        ]);

        // Obtener el rol de cliente
        $rolCliente = Rol::where('nombre', 'cliente')->first();

        // Crear el nuevo usuario con el rol de cliente
        Usuario::create([
            'nombre' => $request->nombre,
            'apellido' => $request->apellido,
            'telefono' => $request->telefono,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'rol_id' => $rolCliente->id, // Usar 'rol_id' en lugar de 'rol'
        ]);

        // Redirigir con mensaje de éxito
        return redirect()->route('login')->with('success', 'Registro exitoso. ¡Inicia sesión!');
    }
}

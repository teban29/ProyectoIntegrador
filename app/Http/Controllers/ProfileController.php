<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    public function edit()
    {
        // Devuelve la vista de editar perfil con los datos del usuario actual
        return view('profile.edit', ['user' => Auth::user()]);
    }

    public function update(Request $request)
    {
        $user = Auth::user();

        // Validar los datos del formulario
        $request->validate([
            'telefono' => 'nullable|string|max:15',
            'email' => 'required|email|max:255',
            'password' => 'nullable|string|min:8|confirmed',
            'profile_image' => 'nullable|image|mimes:jpg,png,jpeg|max:2048'
        ]);

        // Actualizar solo los campos permitidos
        $user->telefono = $request->telefono;
        $user->email = $request->email;

        // Si se proporciona una nueva contraseña
        if ($request->password) {
            $user->password = Hash::make($request->password);
        }

        // Manejar la imagen de perfil si se sube una
        if ($request->hasFile('profile_image')) {
            $path = $request->file('profile_image')->store('profile_images', 'public');
            $user->profile_image_url = $path;
        }

        // Guardar los cambios
        $user->save();

        return redirect()->route('profile.edit')->with('success', 'Perfil actualizado exitosamente.');
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Producto;

class CarritoController extends Controller
{
    public function mostrar()
    {
        $carrito = session()->get('carrito', []); 
        return view('carrito.mostrar', compact('carrito'));
    }

    public function agregar($id)
    {
        $producto = Producto::select('id', 'nombre', 'precio', 'imagen_url')->find($id);        
        // Verificación adicional para asegurar que el producto existe
        if (!$producto) {
            return redirect()->route('carrito.mostrar')->with('error', 'Producto no encontrado');
        }

        $carrito = session()->get('carrito', []);

        // Asigna el valor de imagen_url a la clave 'imagen'
        $carrito[$id] = [
            "nombre" => $producto->nombre,
            "cantidad" => isset($carrito[$id]) ? $carrito[$id]['cantidad'] + 1 : 1,
            "precio" => $producto->precio,
            "imagen" => $producto->imagen_url,
        ];

        session()->put('carrito', $carrito); 
        return redirect()->route('carrito.mostrar')->with('success', 'Producto agregado al carrito');
    }

    public function eliminar($id)
    {
        $carrito = session()->get('carrito', []);

        if(isset($carrito[$id])) {
            unset($carrito[$id]);
            session()->put('carrito', $carrito);
        }

        return redirect()->route('carrito.mostrar')->with('success', 'Producto eliminado del carrito');
    }

    public function sumar($id)
    {
        $carrito = session()->get('carrito', []);
        if (isset($carrito[$id])) {
            $carrito[$id]['cantidad']++;
            session()->put('carrito', $carrito);
        }

        return redirect()->route('carrito.mostrar')->with('success', 'Cantidad actualizada');
    }

    public function vaciar()
    {
        session()->forget('carrito');
        return redirect()->route('carrito.mostrar')->with('success', 'Carrito vaciado');
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Producto;

class CarritoController extends Controller
{
    public function mostrar()
    {
        $carrito = session()->get('carrito', []); // Esta línea es correcta
        return view('carrito.mostrar', compact('carrito')); // Esta línea también es correcta
    }

    public function agregar($id)
    {
        $producto = Producto::find($id);
        $carrito = session()->get('carrito', []);

        $carrito[$id] = [
            "nombre" => $producto->nombre,
            "cantidad" => isset($carrito[$id]) ? $carrito[$id]['cantidad'] + 1 : 1,
            "precio" => $producto->precio,
            "imagen" => $producto->imagen
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

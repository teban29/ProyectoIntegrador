<?php

namespace App\Http\Controllers;

use App\Models\Cita;
use App\Models\Servicio;
use App\Models\Usuario; // Para clientes y barberos
use Illuminate\Http\Request;

class AdminCitaController extends Controller
{
    public function index()
    {
        $citas = Cita::with(['servicio', 'cliente', 'barbero'])->get();
        return view('citas.index', compact('citas'));
    }

    public function create()
    {
        $servicios = Servicio::all();
        $clientes = Usuario::where('rol_id', 'cliente_id')->get(); // Ajusta la condición según sea necesario
        $barberos = Usuario::where('rol_id', 'barbero_id')->get();
        
        return view('citas.create', compact('servicios', 'clientes', 'barberos'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'fecha' => 'required|date',
            'hora' => 'required|date_format:H:i',
            'servicio_id' => 'required|exists:servicios,id',
            'cliente_id' => 'required|exists:usuarios,id',
            'barbero_id' => 'required|exists:usuarios,id',
        ]);

        Cita::create($request->all());

        return redirect()->route('citas.index')->with('success', 'Cita creada con éxito.');
    }

    public function show($id)
    {
        $cita = Cita::with(['servicio', 'cliente', 'barbero'])->findOrFail($id);
        return view('citas.show', compact('cita'));
    }

    public function edit($id)
    {
        $cita = Cita::findOrFail($id);
        $servicios = Servicio::all();
        $clientes = Usuario::where('rol_id', 'cliente_id')->get();
        $barberos = Usuario::where('rol_id', 'barbero_id')->get();
        
        return view('citas.edit', compact('cita', 'servicios', 'clientes', 'barberos'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'fecha' => 'required|date',
            'hora' => 'required|date_format:H:i',
            'servicio_id' => 'required|exists:servicios,id',
            'cliente_id' => 'required|exists:usuarios,id',
            'barbero_id' => 'required|exists:usuarios,id',
        ]);

        $cita = Cita::findOrFail($id);
        $cita->update($request->all());

        return redirect()->route('citas.index')->with('success', 'Cita actualizada con éxito.');
    }

    public function destroy($id)
    {
        $cita = Cita::findOrFail($id);
        $cita->delete();

        return redirect()->route('citas.index')->with('success', 'Cita eliminada con éxito.');
    }
}

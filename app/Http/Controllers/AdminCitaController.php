<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

namespace App\Http\Controllers;

use App\Models\Cita;
use App\Models\Servicio;
use App\Models\Usuario;
use Illuminate\Http\Request;

class AdminCitaController extends Controller
{
    public function index()
    {


        $citas = Cita::with(['servicio', 'cliente', 'barbero'])->get();
        return view('admin.citas.index', compact('citas'));
    }

    public function create(Request $request)
    {
        $clientes = Usuario::where('rol_id', 3)->get();
        $servicios = Servicio::all();
        $fecha = now()->format('Y-m-d');
        $horas = $this->getAvailableHours($fecha);

        return view('admin.citas.create', compact('clientes', 'servicios', 'fecha', 'horas'));

    }

    public function filtrar(Request $request)
    {
        $request->validate([
            'cliente_id' => 'required|exists:usuarios,id',
            'servicio_id' => 'required|exists:servicios,id',
            'fecha' => 'required|date|after_or_equal:today',
            'hora' => 'required',
        ]);

        $clientes = Usuario::where('rol_id', 3)->get();
        $servicios = Servicio::all();

        $cliente_id = $request->cliente_id;
        $servicio_id = $request->servicio_id;
        $fecha = $request->fecha;
        $horaSeleccionada = $request->hora;
        $horas = $this->getAvailableHours($fecha);

        // Filtrar barberos disponibles
        $barberosDisponibles = Usuario::where('rol_id', 2) // Rol de barbero
            ->whereDoesntHave('citas', function ($query) use ($fecha, $horaSeleccionada) {
                $query->where('fecha', $fecha)
                      ->where('hora', $horaSeleccionada);
            })
            ->get();

        return view('admin.citas.create', compact('clientes', 'servicios', 'barberosDisponibles', 'fecha', 'horas', 'cliente_id', 'servicio_id', 'horaSeleccionada'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'cliente_id' => 'required|exists:usuarios,id',
            'servicio_id' => 'required|exists:servicios,id',
            'fecha' => 'required|date|after_or_equal:today',
            'hora' => 'required',
            'barbero_id' => 'required|exists:usuarios,id',
        ]);

        Cita::create([
            'cliente_id' => $request->cliente_id,
            'servicio_id' => $request->servicio_id,
            'fecha' => $request->fecha,
            'hora' => $request->hora,
            'barbero_id' => $request->barbero_id,
        ]);

        return redirect()->route('admin.citas.index')->with('success', 'Cita creada con éxito.');
    }

    private function getAvailableHours($fecha)
    {
        $horas = [];
        $horaInicio = 9; // 9 AM
        $horaFin = 19; // 7 PM

        for ($hora = $horaInicio; $hora < $horaFin; $hora++) {
            $horas[] = date('H:i', strtotime("$hora:00"));
            $horas[] = date('H:i', strtotime("$hora:30")); // Intervalo de 30 minutos
        }

        $citas = Cita::where('fecha', $fecha)->pluck('hora')->toArray();
        return array_diff($horas, $citas);
    }

    public function show($id)
    {

        $cita = Cita::with(['servicio', 'cliente', 'barbero'])->findOrFail($id);
        return view('admin.citas.show', compact('cita'));
    }

    public function edit($id)
    {

        $cita = Cita::findOrFail($id);
        $servicios = Servicio::all();
        $clientes = Usuario::where('rol_id', 3)->get(); // Clientes
        $barberos = Usuario::where('rol_id', 2)->get(); // Barberos

        return view('admin.citas.edit', compact('cita', 'servicios', 'clientes', 'barberos'));
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

        return redirect()->route('admin.citas.index')->with('success', 'Cita actualizada con éxito.');
    }

    public function destroy($id)
    {
        $cita = Cita::findOrFail($id);
        $cita->delete();

        return redirect()->route('admin.citas.index')->with('success', 'Cita eliminada con éxito.');
    }
}

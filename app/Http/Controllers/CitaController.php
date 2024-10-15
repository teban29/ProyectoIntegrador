<?php

namespace App\Http\Controllers;

use App\Models\Cita;
use App\Models\Servicio;
use App\Models\Usuario;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CitaController extends Controller
{
    public function index()
    {
        // Cargar las citas con la relación del barbero
        $citas = Cita::with(['servicio', 'barbero'])->where('usuario_id', auth()->id())->get();
        return view('citas.index', compact('citas'));
    }

    public function create()
    {
        $servicios = Servicio::all(); // Obtener todos los servicios
        $horas = $this->getAvailableHours(now()->format('Y-m-d')); // Horas disponibles para la fecha actual
        return view('citas.create', compact('servicios', 'horas'));
    }

    public function filtrar(Request $request)
    {
        $request->validate([
            'servicio_id' => 'required|exists:servicios,id',
            'fecha' => 'required|date',
            'hora' => 'required',
        ]);

        // Obtener servicios
        $servicios = Servicio::all();

        $servicio_id = $request->servicio_id;
        $fecha = $request->fecha;
        $horaSeleccionada = $request->hora;

        // Obtener horas disponibles
        $horas = $this->getAvailableHours($fecha);

        // Obtener barberos disponibles
        $barberosDisponibles = Usuario::where('rol_id', 2) // Asumiendo que rol_id 2 es barbero
            ->whereDoesntHave('citas', function ($query) use ($fecha, $horaSeleccionada) {
                $query->where('fecha', $fecha)
                      ->where('hora', $horaSeleccionada);
            })
            ->get();

        return view('citas.create', compact('servicios', 'barberosDisponibles', 'fecha', 'horas', 'servicio_id', 'horaSeleccionada'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'servicio_id' => 'required|exists:servicios,id',
            'fecha' => 'required|date',
            'hora' => 'required',
            'barbero_id' => 'required|exists:usuarios,id',
        ]);

        // Crear la cita con los datos proporcionados
        Cita::create([
            'servicio_id' => $request->servicio_id,
            'fecha' => $request->fecha,
            'hora' => $request->hora,
            'barbero_id' => $request->barbero_id,
            'cliente_id' => Auth::id(), // Obtener el id del cliente autenticado
        ]);

        return redirect()->route('citas.ver')->with('success', 'Cita agendada con éxito.');
    }

    private function getAvailableHours($fecha)
    {
        $horas = [];
        $horaInicio = 9; // 9 AM
        $horaFin = 19; // 7 PM
    
        for ($hora = $horaInicio; $hora < $horaFin; $hora++) {
            $horas[] = date('H:i', strtotime("$hora:00"));
            $horas[] = date('H:i', strtotime("$hora:30")); // Agregar el intervalo de 30 minutos
        }
    
        // Filtrar horas ya ocupadas
        $citas = Cita::where('fecha', $fecha)->pluck('hora')->toArray();
        return array_diff($horas, $citas); // Devolver horas disponibles
    }

    public function verCitas()
    {
        $citas = Cita::with(['servicio', 'barbero'])
                     ->where('cliente_id', auth()->id())
                     ->get();
    
        return view('citas.ver', compact('citas'));
    }
    
    public function cancelar($id)
    {
        // Buscar la cita por ID
        $cita = Cita::findOrFail($id);
    
        // Eliminar la cita
        $cita->delete();
    
        return redirect()->route('citas.ver')->with('success', 'Cita cancelada exitosamente.');
    }
    
    
    
}

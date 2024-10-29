<?php
namespace App\Http\Controllers;

use App\Models\Cita;
use App\Models\Servicio;
use App\Models\Usuario;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CitaController extends Controller
{
    public function create()
    {
        // Obtener todos los servicios
        $servicios = Servicio::all();
        // Definir la fecha actual para la selección
        $fecha = now()->format('Y-m-d');
        // Obtener las horas disponibles para la fecha actual
        $horas = $this->getAvailableHours($fecha);
        
        return view('citas.agendar', compact('servicios', 'horas', 'fecha'));
    }

    public function filtrar(Request $request)
    {
        // Validar la solicitud
        $request->validate([
            'servicio_id' => 'required|exists:servicios,id',
            'fecha' => 'required|date',
            'hora' => 'required',
        ]);
    
        $servicios = Servicio::all();
        $servicio_id = $request->servicio_id;
        $fecha = $request->fecha;
        $horaSeleccionada = $request->hora;
        $horas = $this->getAvailableHours($fecha);
        $barberosDisponibles = Usuario::where('rol_id', 2)
            ->whereDoesntHave('citas', function ($query) use ($fecha, $horaSeleccionada) {
                $query->where('fecha', $fecha)
                      ->where('hora', $horaSeleccionada);
            })
            ->get();
    
        // Pasar los datos a la vista nuevamente
        return view('citas.agendar', compact('servicios', 'barberosDisponibles', 'fecha', 'horas', 'servicio_id', 'horaSeleccionada'));
    }
    

    public function store(Request $request)
    {
        // Validar la solicitud
        $request->validate([
            'servicio_id' => 'required|exists:servicios,id',
            'fecha' => 'required|date',
            'hora' => 'required',
            'barbero_id' => 'required|exists:usuarios,id',
        ]);

        // Crear la cita
        Cita::create([
            'servicio_id' => $request->servicio_id,
            'fecha' => $request->fecha,
            'hora' => $request->hora,
            'barbero_id' => $request->barbero_id,
            'cliente_id' => Auth::id(),
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
    
        // Filtrar horas ocupadas
        $citas = Cita::where('fecha', $fecha)->pluck('hora')->toArray();
        return array_diff($horas, $citas); // Devolver horas disponibles
    }

    public function ver()
    {
        // Cargar las citas del usuario autenticado
        $citas = Cita::with(['servicio', 'barbero'])
                    ->where('cliente_id', auth()->id())
                    ->get();

        return view('citas.ver', compact('citas'));
    }

    public function cancelar(Request $request, $id)
    {
        $cita = Cita::findOrFail($id);
        $cita->delete();

        return redirect()->route('citas.ver')->with('success', 'Cita cancelada con éxito.');
    }

}

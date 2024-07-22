<?php
namespace App\Http\Controllers;

use App\Models\Acciones;
use App\Models\AsignacionEquipo;
use App\Models\Empleado;
use App\Models\Equipo;
use App\Models\User;
use App\Models\Empresa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use PDF;

class AsignacionEquipoController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search');
        $sortField = $request->input('sort', 'fecha_asignacion');
        $sortOrder = $request->input('order', 'desc');
    
        $asignacionesequipos = AsignacionEquipo::with(['empleado', 'equipo', 'usuario', 'empresa'])
            ->when($search, function ($query, $search) {
                return $query->whereHas('empleado', function ($q) use ($search) {
                    $q->whereRaw("CONCAT(nombre, ' ', apellidoP, ' ', apellidoM) LIKE ?", ["%{$search}%"]);
                })->orWhereHas('equipo', function ($q) use ($search) {
                    $q->where('numero_serie', 'like', "%{$search}%");
                })->orWhere('fecha_asignacion', 'like', "%{$search}%")
                  ->orWhere('ticket', 'like', "%{$search}%");
            })
            ->orderBy($sortField, $sortOrder)
            ->paginate(10);
    
        return view('asignacionesequipos.index', compact('asignacionesequipos', 'search', 'sortField', 'sortOrder'));
    }
    

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function create()
    {
        $empleados = Empleado::all();
        $equipos = Equipo::all();
        $empresas = Empresa::all();
        
        return view('asignacionesequipos.create', compact('empleados', 'equipos', 'empresas'));
    }

    public function edit($id)
    {
        $asignacion = AsignacionEquipo::findOrFail($id);
        $empleados = Empleado::all();
        $equipos = Equipo::all();
        $empresas = Empresa::all();

        return view('asignacionesequipos.edit', compact('asignacion', 'empleados', 'equipos', 'empresas'));
    }

    public function update(Request $request, $id)
{
    $request->validate([
        'empleado_id' => 'required|exists:empleados,id',
        'equipo_id' => 'required|exists:equipos,id',
        'fecha_asignacion' => 'required|date',
        'ticket' => 'required|integer',
        'nota_descriptiva' => 'nullable|string|max:100',
        'empresa_id' => 'required|exists:empresas,id',
        'estado' => 'required|string|max:50',
    ]);

    $asignacion = AsignacionEquipo::findOrFail($id);
    $request['usuario_responsable'] = Auth::id(); // Establecer el usuario autenticado
    $asignacion->update($request->all());

    // Actualizar el estado del equipo
    $equipo = Equipo::findOrFail($request->equipo_id);
    $equipo->update(['estado' => $request->estado]);

    return redirect()->route('asignacionesequipos.index')
        ->with('success', 'Asignación de equipo actualizada correctamente');
}


    public function store(Request $request)
    {
        $request->validate([
            'empleado_id' => 'required|exists:empleados,id',
            'equipo_id' => 'required|exists:equipos,id',
            'fecha_asignacion' => 'required|date',
            'ticket' => 'required|integer',
            'nota_descriptiva' => 'nullable|string|max:100',
            'empresa_id' => 'required|exists:empresas,id',
            'estado' => 'required|string|max:50',
        ]);

        $request['usuario_responsable'] = Auth::id(); // Establecer el usuario autenticado
        $asignacion = AsignacionEquipo::create($request->all());

        // Actualizar el estado del equipo
        $equipo = Equipo::findOrFail($request->equipo_id);
        $equipo->update(['estado' => $request->estado]);

        return redirect()->route('asignacionesequipos.index')
            ->with('success', 'Asignación de equipo creada correctamente');
    }
    
    public function show($id)
    {
        $asignacion = AsignacionEquipo::with(['empleado', 'equipo', 'usuario', 'empresa'])->findOrFail($id);
        return view('asignacionesequipos.show', compact('asignacion'));
    }

    public function generatePdf($id)
    {
        $asignacion = AsignacionEquipo::with(['empleado', 'equipo', 'usuario', 'empresa'])->findOrFail($id);

        $pdf = PDF::loadView('asignaciones.pdf', compact('asignacion'));
        return $pdf->download('asignacion_' . $asignacion->id . '.pdf');
    }

    public function destroy($id)
    {
        $asignacion = AsignacionEquipo::findOrFail($id);
        $equipo_id = $asignacion->equipo_id;
        $asignacion->delete();

        // Actualizar el estado del equipo a 'No asignado' cuando se elimina la asignación
        $equipo = Equipo::findOrFail($equipo_id);
        $equipo->update(['estado' => 'No asignado']);

        return redirect()->route('asignacionesequipos.index')
            ->with('success', 'Asignación de equipo eliminada correctamente');
    }
}

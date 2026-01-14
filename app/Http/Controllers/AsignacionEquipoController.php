<?php

namespace App\Http\Controllers;

use App\Models\Acciones;
use App\Models\AsignacionEquipo;
use App\Models\Empleado;
use App\Models\Equipo;
use App\Models\User;
use App\Models\Empresa;
use App\Models\Prestamo;
use Barryvdh\DomPDF\Facade\Pdf as FacadePdf;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use PDF;
use App\Exports\AsignacionesEquiposExport;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;


class AsignacionEquipoController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search');
        $sortField = $request->input('sort', 'id');
        $sortOrder = $request->input('order', 'desc');

        $asignacionesequipos = AsignacionEquipo::with(['empleado', 'equipo', 'usuario', 'empresa'])
            ->when($search, function ($query, $search) {
                return $query->whereHas('empleado', function ($q) use ($search) {
                    $q->whereRaw("CONCAT(nombre, ' ', apellidoP, ' ', apellidoM) LIKE ?", ["%{$search}%"]);
                })->orWhereHas('equipo', function ($q) use ($search) {
                    $q->where('etiqueta_skytex', 'like', "%{$search}%");
                })->orWhere('fecha_asignacion', 'like', "%{$search}%")
                    ->orWhere('ticket', 'like', "%{$search}%");
            })
            ->orderBy($sortField, $sortOrder)
            ->paginate(20);


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

    public function store(Request $request)
    {
        // 1. Validar y decodificar la entrada
        $validated = $request->validate(['asignaciones' => 'required|json']);
        $asignaciones = json_decode($validated['asignaciones'], true);

        // Extraer todos los IDs de equipo para una sola consulta
        $equipoIds = array_column($asignaciones, 'equipo_id');
        $equipos = Equipo::whereIn('id', $equipoIds)->get()->keyBy('id'); // Una sola consulta para todos los equipos

        // 2. Bucle de Validación PREVIA (sin tocar la base de datos)
        $errors = [];
        foreach ($asignaciones as $index => $asignacionData) {
            $equipo = $equipos->get($asignacionData['equipo_id']);

            if (!$equipo) {
                $errors[] = "El equipo con ID {$asignacionData['equipo_id']} no fue encontrado (registro " . ($index + 1) . ").";
                continue; // Salta al siguiente item
            }
            if ($equipo->estado === 'Asignado') {
                $errors[] = "El equipo {$equipo->etiqueta_skytex} ya está asignado (registro " . ($index + 1) . ").";
            }
            if ($equipo->estado === 'Baja') {
                $errors[] = "El equipo {$equipo->etiqueta_skytex} está dado de baja (registro " . ($index + 1) . ").";
            }
        }

        // Si encontramos algún error en la validación, regresamos con todos los errores a la vez.
        if (!empty($errors)) {
            return redirect()->back()->withErrors($errors);
        }

        // 3. Transacción a la Base de Datos (Todo o nada)
        DB::beginTransaction();
        try {
            $now = Carbon::now('America/Mexico_City');
            $userId = Auth::id();
            $accionesParaInsertar = [];

            foreach ($asignaciones as $asignacionData) {
                // Asignar el equipo
                $asignacionData['usuario_responsable'] = $userId;
                $asignacionData['created_at'] = $now;
                $asignacionData['updated_at'] = $now;
                AsignacionEquipo::create($asignacionData);

                // Actualizar el estado del equipo
                $equipo = $equipos->get($asignacionData['equipo_id']);
                $equipo->update(['estado' => $asignacionData['estado']]);

                // Preparar la acción para inserción masiva
                $accionesParaInsertar[] = [
                    'modulo' => 'Asignación de Equipo',
                    'descripcion' => "Se creó la asignación del Equipo: " . $equipo->etiqueta_skytex,
                    'usuario_responsable_id' => $userId,
                    'created_at' => $now,
                    'updated_at' => $now,
                ];
            }

            // Insertar todas las acciones en una sola consulta
            Acciones::insert($accionesParaInsertar);

            DB::commit(); // Si todo salió bien, confirmamos los cambios.

        } catch (\Exception $e) {
            DB::rollBack(); // Si algo falló, revertimos todos los cambios.
            // Opcional: registrar el error $e->getMessage() en los logs
            return redirect()->back()->withErrors(['error' => 'Ocurrió un error al procesar las asignaciones. Ninguna fue guardada.']);
        }

        return redirect()->route('asignacionesequipos.index')->with('success', 'Las asignaciones de equipos se han creado correctamente.');
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
        // 1. Validación básica de Laravel
        $validatedData = $request->validate([
            'empleado_id' => 'required|exists:empleados,id',
            'equipo_id' => 'required|exists:equipos,id',
            'fecha_asignacion' => 'required|date',
            'ticket' => 'required|integer|max:9223372036854775807',
            'nota_descriptiva' => 'nullable|string',
            'empresa_id' => 'required|exists:empresas,id',
            'estado' => 'required|string|max:50',
        ]);

        // =======================================================
        // == INICIO DE VALIDACIONES DE LÓGICA DE NEGOCIO ==
        // =======================================================
        $asignacionActual = AsignacionEquipo::findOrFail($id);
        $equipoSeleccionado = Equipo::findOrFail($validatedData['equipo_id']);

        // Validar si el equipo está dado de baja
        if ($equipoSeleccionado->estado === 'Baja') {
            return redirect()->back()
                ->withErrors(['equipo_id' => 'Este equipo está dado de baja y no puede ser asignado.'])
                ->withInput();
        }

        // Validar si el equipo ya está asignado a OTRA persona
        // Esta condición solo se activa si el equipo está "Asignado" Y no es el mismo equipo que ya tenía esta asignación
        if ($equipoSeleccionado->estado === 'Asignado' && $equipoSeleccionado->id != $asignacionActual->equipo_id) {
            return redirect()->back()
                ->withErrors(['equipo_id' => 'Este equipo ya se encuentra asignado. Por favor, seleccione otro.'])
                ->withInput();
        }
        // =======================================================
        // == FIN DE VALIDACIONES DE LÓGICA DE NEGOCIO ==
        // =======================================================

        try {
            // Inicia una transacción para garantizar la integridad de los datos
            DB::transaction(function () use ($validatedData, $asignacionActual,$equipoSeleccionado) {

                // Si el equipo fue cambiado, poner el anterior como "No asignado"
                if ($asignacionActual->equipo_id != $validatedData['equipo_id']) {
                    $equipoAnterior = Equipo::find($asignacionActual->equipo_id);
                    if ($equipoAnterior) {
                        $equipoAnterior->update(['estado' => 'No asignado']);
                    }
                }

                // 1. Actualiza la asignación con los nuevos datos
                $asignacionActual->update($validatedData + ['usuario_responsable' => Auth::id()]);

                // 2. Actualiza el estado del nuevo equipo seleccionado
                $equipoSeleccionado->update(['estado' => $validatedData['estado']]);

                // 3. Registra la acción
                $asignacionActual->load('empleado'); // Recarga la relación para obtener el nombre actualizado

                Acciones::create([
                    'modulo' => "Asignacion de Equipo",
                    'descripcion' => "Se actualizó la asignación del equipo: " . $equipoSeleccionado->etiqueta_skytex . " para el empleado: " . $asignacionActual->empleado->nombre . " " . $asignacionActual->empleado->apellidoP,
                    'usuario_responsable_id' => Auth::id(),
                ]);
            });
        } catch (\Exception $e) {
            // Si algo falla, la transacción se revierte y mostramos un error
            return redirect()->back()->withErrors(['error' => 'No se pudo actualizar la asignación. Error: ' . $e->getMessage()])->withInput();
        }

        return redirect()->route('asignacionesequipos.index')
            ->with('success', 'Asignación de equipo actualizada correctamente');
    }


    public function show($id)
    {
        $asignacion = AsignacionEquipo::with(['empleado', 'equipo', 'usuario', 'empresa'])->findOrFail($id);
        return view('asignacionesequipos.show', compact('asignacion'));
    }


    public function generatePdf($id)
    {
        $asignacion = AsignacionEquipo::findOrFail($id);
        $asignaciones = AsignacionEquipo::where('ticket', $asignacion->ticket)->get();

        $pdf = FacadePdf::loadView('documentos.pdf', compact('asignacion', 'asignaciones'));

        return $pdf->stream('asignacion_' . $asignacion->empleado->nombre . '.pdf');
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

    public function exportExcel()
    {
        return Excel::download(new AsignacionesEquiposExport, 'asignaciones_equipos.xlsx');
    }
}

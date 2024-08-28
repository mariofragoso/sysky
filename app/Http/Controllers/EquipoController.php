<?php

namespace App\Http\Controllers;

use App\Models\Acciones;
use App\Models\Equipo;
use App\Models\Marca;
use App\Models\TipoEquipo;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EquipoController extends Controller
{
    // Mostrar una lista de empleados
    // En EquipoController.php
    public function index(Request $request)
    {
        $search = $request->input('search');
        $sortField = $request->input('sort', 'created_at');
        $sortOrder = $request->input('order', 'desc');

        // Guardar la página actual en la sesión
        $request->session()->put('equipo_page', $request->input('page', 1));

        $equipos = Equipo::with(['marca', 'tipoEquipo'])
            ->when($search, function ($query, $search) {
                return $query->where('numero_serie', 'like', "%{$search}%")
                    ->orWhereHas('marca', function ($q) use ($search) {
                        $q->where('nombre', 'like', "%{$search}%");
                    })
                    ->orWhere('modelo', 'like', "%{$search}%")
                    ->orWhere('etiqueta_skytex', 'like', "%{$search}%")
                    ->orWhereHas('tipoEquipo', function ($q) use ($search) {
                        $q->where('nombre', 'like', "%{$search}%");
                    })
                    ->orWhere('orden_compra', 'like', "%{$search}%")
                    ->orWhere('requisicion', 'like', "%{$search}%")
                    ->orWhere('estado', 'like', "%{$search}%");
            })->orderBy($sortField, $sortOrder)->paginate(50);

        return view('equipos.index', compact('equipos', 'search', 'sortField', 'sortOrder'));
    }


    public function create()
    {
        $marcas = Marca::all();
        $tipoequipos = TipoEquipo::all();
        return view('equipos.create', compact('marcas', 'tipoequipos'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'numero_serie' => 'required|unique:equipos',
            'marca_id' => 'required|exists:marcas,id',
            'modelo' => 'required',
            'etiqueta_skytex' => 'required|unique:equipos,etiqueta_skytex',
            'tipo_equipo_id' => 'required|exists:tipos_equipos,id',  // Cambio aquí
            'orden_compra' => 'nullable',
            'requisicion' => 'nullable',
            'estado' => 'required',
        ], [
            'numero_serie.unique' => 'El Numero de serie ya está registrado.',
            'etiqueta_skytex.unique' => 'La etiqueta Skytex ya está registrada.',
        ]);

        $equipo = Equipo::create($request->all());

        // Registrar la acción
        $accion = new Acciones();
        $accion->modulo = "Equipo";
        $accion->descripcion = "Se creó el equipo: " . $equipo->etiqueta_skytex;
        $accion->usuario_responsable_id = Auth::user()->id;
        $accion->created_at = Carbon::now('America/Mexico_City')->toDateTimeString();
        $accion->save();

        return redirect()->route('equipos.index')
            ->with('success', 'Equipo creado correctamente.');
    }

    public function show(Equipo $equipo)
    {
        return view('equipos.show', compact('equipo'));
    }

    public function edit($id)
    {
        $marcas = Marca::all();
        $tipoequipos = TipoEquipo::all();
        $equipo = Equipo::findOrFail($id);
        return view('equipos.edit', compact('equipo', 'marcas', 'tipoequipos'));
    }


    public function update(Request $request, Equipo $equipo)
    {
        // Validación y actualización del equipo
        $request->validate([
            'numero_serie' => 'required|unique:equipos,numero_serie,' . $equipo->id,
            'marca_id' => 'required|exists:marcas,id',
            'modelo' => 'required',
            'etiqueta_skytex' => 'required|unique:equipos,etiqueta_skytex,' . $equipo->id,
            'tipo_equipo_id' => 'required|exists:tipos_equipos,id',
            'orden_compra' => 'nullable',
            'requisicion' => 'nullable',
            'estado' => 'required',
        ], [
            'numero_serie.unique' => 'El Numero de serie ya está registrado.',
            'etiqueta_skytex.unique' => 'La etiqueta Skytex ya está registrada.',
        ]);

        $equipo->update($request->all());

        // Registrar la acción
        $accion = new Acciones();
        $accion->modulo = "Equipo";
        $accion->descripcion = "Se Edito el equipo: " . $equipo->etiqueta_skytex;
        $accion->usuario_responsable_id = Auth::user()->id;
        $accion->created_at = Carbon::now('America/Mexico_City')->toDateTimeString();
        $accion->save();

        // Obtener la página actual desde la sesión
        $page = session('equipo_page', 1);

        // Redirigir a la página actual
        return redirect()->route('equipos.index', ['page' => $page])
            ->with('success', 'Equipo actualizado correctamente.');
    }



    public function destroy(Equipo $equipo)
    {
        $equipo->delete();

        return redirect()->route('equipos.index')
            ->with('success', 'Equipo eliminado correctamente.');
    }
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function baja(Request $request)
    {
        $search = $request->input('search');
        $sortField = $request->input('sort', 'created_at');
        $sortOrder = $request->input('order', 'desc');

        $equipos = Equipo::where('estado', 'Baja')
            ->when($search, function ($query, $search) {
                return $query->where('numero_serie', 'like', "%{$search}%")
                    ->orWhere('marca', 'like', "%{$search}%")
                    ->orWhere('modelo', 'like', "%{$search}%")
                    ->orWhere('etiqueta_skytex', 'like', "%{$search}%")
                    ->orWhere('tipo', 'like', "%{$search}%")
                    ->orWhere('orden_compra', 'like', "%{$search}%")
                    ->orWhere('requisicion', 'like', "%{$search}%");
            })
            ->orderBy($sortField, $sortOrder)
            ->paginate(10);

        return view('equipos.baja', compact('equipos', 'search', 'sortField', 'sortOrder'));
    }
}

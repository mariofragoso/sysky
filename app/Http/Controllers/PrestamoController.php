<?php

namespace App\Http\Controllers;

use App\Models\Prestamo;
use App\Models\Equipo;
use App\Models\Empleado;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Acciones;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class PrestamoController extends Controller
{
    public function index()
    {
        $prestamos = Prestamo::with(['equipo', 'empleado'])->paginate(10);
        return view('prestamos.index', compact('prestamos'));
    }

    public function create()
    {
        $equipos = Equipo::all();
        $empleados = Empleado::all();
        $usuarios = User::all();

        return view('prestamos.create', compact('equipos', 'empleados', 'usuarios'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'equipo_id' => 'required|exists:equipos,id',
            'empleado_id' => 'required|exists:empleados,id',
            'fecha_prestamo' => 'required|date',
            'fecha_regreso' => 'required|date|after_or_equal:fecha_prestamo',
            'usuario_responsable_id' => 'required|exists:users,id',
        ]);

        $prestamo = Prestamo::create($request->all());

        // Registrar la acción
        $accion = new Acciones();
        $accion->modulo = "Préstamo";
        $accion->descripcion = "Se creo el préstamo para el equipo con numero de serie: " . $prestamo->equipo->numero_serie;
        $accion->usuario_responsable_id = Auth::user()->id;
        $accion->created_at = Carbon::now('America/Mexico_City')->toDateTimeString();
        $accion->save();

        

        return redirect()->route('prestamos.index')->with('success', 'Préstamo creado exitosamente.');
    }

    public function show($id)
    {
        $prestamo = Prestamo::with(['empleado', 'equipo', 'usuario'])->findOrFail($id);
        return view('prestamos.show', compact('prestamo'));
    }

    public function edit($id)
    {
        $prestamo = Prestamo::with(['empleado', 'equipo', 'usuario'])->findOrFail($id);
        $empleados = Empleado::all();
        $equipos = Equipo::all();
        $usuarios = User::all();
        return view('prestamos.edit', compact('prestamo', 'empleados', 'equipos', 'usuarios'));
    }


    public function update(Request $request, Prestamo $prestamo)
    {
        $request->validate([
            'equipo_id' => 'required|exists:equipos,id',
            'empleado_id' => 'required|exists:empleados,id',
            'fecha_prestamo' => 'required|date',
            'fecha_regreso' => 'required|date|after_or_equal:fecha_prestamo',
            'usuario_responsable_id' => 'required|exists:users,id',
            'devuelto' => 'boolean',
        ]);

        $prestamo->update($request->all());

         // Registrar la acción
         $accion = new Acciones();
         $accion->modulo = "Préstamo";
         $accion->descripcion = "Se actualizó el préstamo del equipo con numero de serie: " . $prestamo->equipo->numero_serie;
         $accion->usuario_responsable_id = Auth::user()->id;
         $accion->created_at = Carbon::now('America/Mexico_City')->toDateTimeString();
         $accion->save();

       
        return redirect()->route('prestamos.index')->with('success', 'Préstamo actualizado exitosamente.');
    }

    public function destroy(Prestamo $prestamo)
    {
        $prestamo->delete();

        // Registrar la acción
        $accion = new Acciones();
        $accion->modulo = "Préstamo";
        $accion->descripcion = "Se elimino el préstamo de el equipo con numero de serie: " . $prestamo->equipo->numero_serie;
        $accion->usuario_responsable_id = Auth::user()->id;
        $accion->created_at = Carbon::now('America/Mexico_City')->toDateTimeString();
        $accion->save();

        

        return redirect()->route('prestamos.index')->with('success', 'Préstamo eliminado exitosamente.');
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Prestamo;
use App\Models\Equipo;
use App\Models\Empleado;
use Illuminate\Http\Request;
use App\Models\User;


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

        Prestamo::create($request->all());

        // Aquí puedes agregar la lógica para notificar el día de entrega

        return redirect()->route('prestamos.index')->with('success', 'Préstamo creado exitosamente.');
    }

    public function show(Prestamo $prestamo)
    {
        return view('prestamos.show', compact('prestamo'));
    }

    public function edit(Prestamo $prestamo)
    {
        $equipos = Equipo::all();
        $empleados = Empleado::all();
        $usuarios = User::all();

        return view('prestamos.edit', compact('prestamo', 'equipos', 'empleados', 'usuarios'));
    }

    public function update(Request $request, Prestamo $prestamo)
    {
        $request->validate([
            'equipo_id' => 'required|exists:equipos,id',
            'empleado_id' => 'required|exists:empleados,id',
            'fecha_prestamo' => 'required|date',
            'fecha_regreso' => 'required|date|after_or_equal:fecha_prestamo',
            'usuario_responsable_id' => 'required|exists:users,id',

        ]);

        $prestamo->update($request->all());

        // Aquí puedes agregar la lógica para notificar el día de entrega

        return redirect()->route('prestamos.index')->with('success', 'Préstamo actualizado exitosamente.');
    }

    public function destroy(Prestamo $prestamo)
    {
        $prestamo->delete();
        return redirect()->route('prestamos.index')->with('success', 'Préstamo eliminado exitosamente.');
    }
}

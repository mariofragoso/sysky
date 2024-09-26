<?php

namespace App\Http\Controllers;

use App\Models\Licencia;
use App\Models\TipoLicencia;
use Illuminate\Http\Request;
use App\Notifications\LicenciaVencimientoNotification;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Notification;


class LicenciaController extends Controller
{
    // app/Http/Controllers/LicenciaController.php
    public function index()
    {
        $licencias = Licencia::with('usuario', 'tipoLicencia')->get();

        return view('licencias.index', compact('licencias'));
    }


    public function create()
    {
        $tiposLicencias = TipoLicencia::all();
        return view('licencias.create', compact('tiposLicencias'));
    }
    public function show($id)
    {
        $licencias = Licencia::findOrFail($id);
        return view('licencias.show', compact('licencias'));
    }

    public function edit($id)
    {
        $licencias = Licencia::findOrFail($id);
        return view('licencias.edit', compact('licencias'));
    }



    public function store(Request $request)
{
    $request->validate([
        'tipo_licencia_id' => 'required|exists:tipos_licencias,id', // Asegurarse que este campo es correcto
        'nombre' => 'required|string|max:255',
        'fecha_adquisicion' => 'required|date',
        'frecuencia_pago' => 'required|in:mensual,semestral,anual',
        'fecha_siguiente_pago' => 'required|date',
        'fecha_recordatorio' => 'nullable|date',
        'estado' => 'required|in:activa,vencida,cancelada',
        'observaciones' => 'nullable|string',
    ]);

    Licencia::create([
        'tipo_licencia_id' => $request->input('tipo_licencia_id'), // Asegúrate de que es el nombre correcto en la base de datos
        'nombre' => $request->input('nombre'),
        'fecha_adquisicion' => $request->input('fecha_adquisicion'),
        'frecuencia_pago' => $request->input('frecuencia_pago'),
        'fecha_siguiente_pago' => $request->input('fecha_siguiente_pago'),
        'fecha_recordatorio' => $request->input('fecha_recordatorio'),
        'estado' => $request->input('estado'),
        'observaciones' => $request->input('observaciones'),
        'usuario_responsable' => Auth::id(), // Guardar el usuario autenticado
    ]);

    return redirect()->route('licencias.index')->with('success', 'Licencia creada exitosamente.');
}


public function update(Request $request, Licencia $licencia)
{
    $request->validate([
        'tipo_licencia_id' => 'required|exists:tipos_licencias,id', // Asegúrate de validar esto también
        'nombre' => 'required|string|max:255',
        'fecha_adquisicion' => 'required|date',
        'frecuencia_pago' => 'required|in:mensual,semestral,anual',
        'fecha_siguiente_pago' => 'required|date',
        'fecha_recordatorio' => 'nullable|date',
        'estado' => 'required|in:activa,vencida,cancelada',
        'observaciones' => 'nullable|string',
    ]);

    $licencia->update([
        'tipo_licencia_id' => $request->input('tipo_licencia_id'), // Asegúrate de que este campo se actualiza correctamente
        'nombre' => $request->input('nombre'),
        'fecha_adquisicion' => $request->input('fecha_adquisicion'),
        'frecuencia_pago' => $request->input('frecuencia_pago'),
        'fecha_siguiente_pago' => $request->input('fecha_siguiente_pago'),
        'fecha_recordatorio' => $request->input('fecha_recordatorio'),
        'estado' => $request->input('estado'),
        'observaciones' => $request->input('observaciones'),
        'usuario_responsable' => Auth::id(), // Actualizar el usuario responsable
    ]);

    return redirect()->route('licencias.index')->with('success', 'Licencia actualizada exitosamente.');
}


    public function sendLicenciaNotification($licenciaId)
    {
        $licencia = Licencia::findOrFail($licenciaId);

        // Dirección de correo específica
        $emailEspecifico = 'soporte.hw3@skytex.com.mx';

        // Enviar la notificación usando colas
        Notification::route('mail', $emailEspecifico)
            ->notify((new LicenciaVencimientoNotification($licencia))->delay(now()->addSeconds(5)));

        return redirect()->route('licencias.index')->with('success', 'Notificación enviada al correo especificado.');
    }
}

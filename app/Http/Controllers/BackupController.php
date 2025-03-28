<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Storage;
use Carbon\Carbon;

class BackupController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    // Mostrar la vista de configuración y backups
    public function index()
    {
        $backups = Storage::files('backups'); // Obtener lista de respaldos
        return view('backups.index', compact('backups'));
    }

    // Generar respaldo manualmente
    public function createBackup()
    {
        try {
            $filename = 'backup_' . Carbon::now()->format('Y-m-d_H-i-s') . '.sql';
            $path = storage_path("app/backups/{$filename}");

            // Comando para generar respaldo (ajusta según tu base de datos)
            $command = "mysqldump --user=" . env('DB_USERNAME') .
                " --password=" . env('DB_PASSWORD') .
                " --host=" . env('DB_HOST') .
                " " . env('DB_DATABASE') . " > $path";

            exec($command);

            return back()->with('success', 'Respaldo generado exitosamente.');
        } catch (\Exception $e) {
            return back()->with('error', 'Error al generar el respaldo.');
        }
    }

    public function scheduleBackup(Request $request)
    {
        $request->validate([
            'day' => 'required|string',
            'time' => 'required',
        ]);

        // Guardamos la configuración en un archivo de configuración o base de datos
        $config = [
            'day' => $request->day,
            'time' => $request->time,
        ];

        Storage::put('backup_schedule.json', json_encode($config));

        return back()->with('success', 'Respaldo programado exitosamente.');
    }


    // Descargar respaldo
    public function downloadBackup($filename)
    {
        return Storage::download("backups/$filename");
    }

    // Eliminar respaldo
    public function deleteBackup($filename)
    {
        Storage::delete("backups/$filename");
        return back()->with('success', 'Respaldo eliminado.');
    }
}

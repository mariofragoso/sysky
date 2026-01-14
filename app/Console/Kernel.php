<?php

namespace App\Console;

use App\Http\Controllers\ImpresoraController;
use App\Models\Impresora;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;
use Illuminate\Support\Facades\Storage;

class Kernel extends ConsoleKernel
{
    protected function schedule(Schedule $schedule)
    {
        $schedule->command('prestamos:notificar')->dailyAt('08:30');
        // Programa la sincronización para que se ejecute cada ho
        $schedule->command('sync:empleados')->hourly();

        //$schedule->command('licencias:enviar-recordatorios')->daily();
        $schedule->command('licencias:enviar-recordatorios')->dailyAt('08:30');

        if (Storage::exists('backup_schedule.json')) {
            $config = json_decode(Storage::get('backup_schedule.json'), true);
            $day = $config['day'];
            $time = $config['time'];

            if ($day == 'daily') {
                $schedule->command('backup:run')->dailyAt($time);
            } else {
                $schedule->command('backup:run')->weeklyOn($this->getDayNumber($day), $time);
            }
        }
    }

    private function getDayNumber($day)
    {
        $days = [
            'sunday' => 0,
            'monday' => 1,
            'tuesday' => 2,
            'wednesday' => 3,
            'thursday' => 4,
            'friday' => 5,
            'saturday' => 6,
        ];
        return $days[$day] ?? 1; // Por defecto lunes
    }

    protected function commands()
    {
        $this->load(__DIR__ . '/Commands');
    }
    protected $commands = [
        Commands\SyncEmpleados::class,
    ];
}

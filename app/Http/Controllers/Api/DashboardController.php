<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
// Importamos todos los modelos que usa tu HomeController
use App\Models\Empleado;
use App\Models\Equipo;
use App\Models\Accesorio;
use App\Models\Prestamo;
use App\Models\SalidaEquipo;

class DashboardController extends Controller
{
    /**
     * Calcula y devuelve las estadísticas principales del inventario.
     * Esta lógica se ha copiado de tu HomeController para asegurar consistencia.
     */
    public function getStats()
    {
        // --- 1. Lógica de tu HomeController (copiada 1:1) ---
        $empleados_count = Empleado::where('status', 'A')->count();
        $equipos_count = Equipo::count();
        $accesorios_count = Accesorio::count(); // Asumiendo que el modelo es Accesorio
        $equiposAsignados = Equipo::where('estado', 'Asignado')->count();
        $equiposNoAsignados = Equipo::where('estado', 'No asignado')->count(); // Usamos tu lógica
        $equiposBaja = Equipo::where('estado', 'Baja')->count();
        $prestamosPendientes = Prestamo::where('devuelto', '0')->count(); // Usamos tu lógica
        $salidasPendientes = SalidaEquipo::where('fecha_regreso', NULL)->count(); // Usamos tu lógica

        // --- 2. Devolvemos la respuesta JSON ---
        // Usamos los mismos nombres de variables de tu controlador
        return response()->json([
            'empleados_count' => $empleados_count,
            'equipos_count' => $equipos_count,
            'accesorios_count' => $accesorios_count,
            'equiposAsignados' => $equiposAsignados, // Para el gráfico
            'equiposNoAsignados' => $equiposNoAsignados, // Para la tarjeta y el gráfico
            'equiposBaja' => $equiposBaja, // Para el gráfico
            'prestamosPendientes' => $prestamosPendientes,
            'salidasPendientes' => $salidasPendientes
        ]);
    }
}
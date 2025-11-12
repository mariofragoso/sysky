<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Empleado; // <-- ¡Importante!
use App\Http\Resources\EmpleadoResource; // <-- ¡Importante!
use Illuminate\Database\Eloquent\ModelNotFoundException; // <-- ¡Importante!

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB; // <-- ¡MUY IMPORTANTE!
use App\Http\Resources\EmpleadoSimpleResource; // <-- ¡NUEVO!

class EmpleadoController extends Controller
{
    /**
     * Busca un empleado por su numero_nomina y devuelve sus detalles y equipos.
     */
    public function search($numero_nomina)
    {
        try {
            // 1. Buscamos al empleado por su número de nómina
            $empleado = Empleado::where('numero_nomina', $numero_nomina)
                ->firstOrFail(); // Lanza un error 404 si no lo encuentra

            // 2. Cargamos las relaciones que definimos en el Resource
            // Esto es súper eficiente. Carga las asignaciones y, dentro de ellas, el equipo.
            $empleado->load('asignacionesequipos.equipo');

            // 3. Devolvemos el empleado usando nuestra plantilla (Resource)
            return new EmpleadoResource($empleado);
        } catch (ModelNotFoundException $e) {
            // 4. Si firstOrFail() falla, devolvemos un 404 claro
            return response()->json(['message' => 'Empleado no encontrado'], 404);
        }
    }

    public function autocomplete(Request $request)
    {
        // 1. Obtenemos el término de búsqueda de la URL (ej. ?search=juan)
        $search = $request->input('search');

        // 2. Si no hay término de búsqueda (o es muy corto), devolvemos una lista vacía.
        if (strlen($search) < 2) {
            return EmpleadoSimpleResource::collection([]);
        }

        // 3. Construimos la consulta.
        // Usamos CONCAT para buscar en el nombre completo, aunque esté en 3 columnas.
        $empleados = Empleado::where(DB::raw("CONCAT(nombre, ' ', apellidoP, ' ', apellidoM)"), 'LIKE', "%{$search}%")
            ->orWhere('numero_nomina', 'LIKE', "{$search}%") // También buscamos por nómina
            ->select('id', 'numero_nomina', 'nombre', 'apellidoP', 'apellidoM') // Solo traemos lo necesario
            ->take(10) // ¡CRÍTICO! Limitamos los resultados a 10 para que sea rápido
            ->get();

        // 4. Devolvemos la lista usando nuestro nuevo resource "ligero".
        return EmpleadoSimpleResource::collection($empleados);
    }
}

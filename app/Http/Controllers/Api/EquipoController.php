<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request; // ¡Asegúrate de importar Request!
use App\Http\Controllers\Controller;
use App\Models\Equipo;
use App\Http\Resources\EquipoResource; // Usaremos un Resource para formatear la salida
use App\Models\Acciones;
use App\Models\Marca; // <-- ¡ASEGÚRATE DE TENER ESTE!
use App\Models\TipoEquipo; // <-- ¡Y ESTE!
use App\Models\AsignacionEquipo; // <-- ¡AÑADE ESTE IMPORT!
use App\Models\Empleado;
use Illuminate\Support\Facades\Auth; // <-- ¡AÑADE ESTE IMPORT!
use Carbon\Carbon; // <-- ¡AÑADE ESTE IMPORT!
use Illuminate\Support\Facades\DB;

class EquipoController extends Controller
{
    /**
     * Muestra la información detallada de un equipo.
     *
     * @param  \App\Models\Equipo  $equipo
     * @return \App\Http\Resources\EquipoResource
     */
    public function show(Equipo $equipo)
    {
        // Gracias al Route Model Binding, Laravel ya encontró el equipo.
        // Si no lo encuentra, automáticamente devuelve un error 404 (Not Found).

        // Cargamos las relaciones que necesitamos para que sean eficientes.
        // Específicamente, la asignación más reciente y el empleado de esa asignación.
        $equipo->load(['asignacionActual.empleado', 'marca', 'tipoEquipo']);

        // Devolvemos la información usando un API Resource para tener un JSON limpio.
        return new EquipoResource($equipo);
    }
    public function store(Request $request)
    {
        // 1. Validación (Copiada de tu controlador web, que SÍ funciona)
        $validatedData = $request->validate([
            'numero_serie' => 'required|unique:equipos',
            'marca_id' => 'required|exists:marcas,id',
            'modelo' => 'required',
            'etiqueta_skytex' => 'required|unique:equipos,etiqueta_skytex',
            'tipo_equipo_id' => 'required|exists:tipos_equipos,id',
            'orden_compra' => 'nullable',
            'requisicion' => 'nullable',
            'estado' => 'required',
        ], [
            'numero_serie.unique' => 'El Numero de serie ya está registrado.',
            'etiqueta_skytex.unique' => 'La etiqueta Skytex ya está registrada.',
        ]);

        // 2. Creación
        // Esto funciona porque tu $fillable en el modelo Equipo.php SÍ incluye 'marca_id' y 'tipo_equipo_id'
        $equipo = Equipo::create($validatedData);

        // 3. Respuesta
        // No necesitamos cargar 'marca' o 'tipoEquipo' aquí porque el Resource lo hará.
        return (new EquipoResource($equipo))
            ->response()
            ->setStatusCode(201); // 201 = Creado
    }

    /**
     * Busca un equipo por su etiqueta_skytex O su numero_serie.
     */
    public function search($identifier)
    {
        try {
            // 1. Buscamos en ambas columnas
            $equipo = Equipo::where('etiqueta_skytex', $identifier)
                ->orWhere('numero_serie', $identifier)
                ->firstOrFail(); // Lanza un error 404 si no encuentra nada

            // 2. Cargamos las relaciones (igual que en 'show')
            $equipo->load(['asignacionActual.empleado', 'marca', 'tipoEquipo']);

            // 3. Devolvemos el recurso
            return new EquipoResource($equipo);
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            // 4. Si firstOrFail() falla, devolvemos un 404 claro
            return response()->json(['message' => 'Equipo no encontrado'], 404);
        }
    }

    public function getMarcas()
    {
        return Marca::select('id', 'nombre')->get();
    }

    /**
     * Devuelve una lista de todos los tipos de equipo.
     */
    public function getTiposEquipos()
    {
        return TipoEquipo::select('id', 'nombre')->get();
    }


    public function asignarEquipo(Request $request)
    {
        // 1. Validar los datos que nos envía la app
        $data = $request->validate([
            'equipo_id' => 'required|integer|exists:equipos,id',
            'empleado_id' => 'required|integer|exists:empleados,id',
            'ticket' => 'nullable|string',
            'nota_descriptiva' => 'nullable|string',
            
        ]);

        // Usamos una transacción para asegurar que todo o nada se ejecute
        DB::beginTransaction();
        try {
            // 2. Buscamos el equipo y el empleado
            $equipo = Equipo::findOrFail($data['equipo_id']);
            $empleado = Empleado::findOrFail($data['empleado_id']);

            // 3. Verificamos la lógica de negocio (de tu controlador web)
            if ($equipo->estado == 'Asignado') {
                return response()->json(['message' => 'Este equipo ya está asignado.'], 409); // 409 Conflict
            }
            if ($equipo->estado == 'Baja') {
                return response()->json(['message' => 'Este equipo está dado de baja y no puede ser asignado.'], 409);
            }

            // 4. Creamos el nuevo registro de asignación (de tu controlador web)
            $asignacion = AsignacionEquipo::create([
                'empleado_id' => $data['empleado_id'],
                'equipo_id' => $data['equipo_id'],
                'fecha_asignacion' => Carbon::now('America/Mexico_City')->toDateString(), // O ->toDateTimeString()
                'usuario_responsable' => Auth::id(), // ID del usuario de la app
                'ticket' => $data['ticket'] ?? null,
                'nota_descriptiva' => $data['nota_descriptiva'] ?? null,
                'estado' => 'Asignado', // Tu lógica de 'store' actualiza el estado del equipo
            ]);

            // 5. Actualizamos el estado del equipo (de tu controlador web)
            $equipo->estado = 'Asignado';
            $equipo->save();

            // 6. Registramos la acción (de tu controlador web)
            Acciones::create([
                'modulo' => 'Asignación de Equipo',
                'descripcion' => "Se creó la asignación del Equipo: " . $equipo->etiqueta_skytex . " para el empleado: " . $empleado->nombre . " " . $empleado->apellidoP,
                'usuario_responsable_id' => Auth::id(),
                'created_at' => Carbon::now('America/Mexico_City'),
            ]);

            // 7. Si todo salió bien, confirmamos la transacción
            DB::commit();

            // 8. Devolvemos una respuesta exitosa
            return response()->json([
                'message' => '¡Equipo asignado correctamente!',
                'asignacion' => $asignacion
            ], 201); // 201 Created

        } catch (\Exception $e) {
            // 9. Si algo falló, revertimos todos los cambios
            DB::rollBack();
            return response()->json(['message' => 'Error al asignar el equipo: ' . $e->getMessage()], 500);
        }
    }
}

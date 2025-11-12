<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class EmpleadoResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'numero_nomina' => $this->numero_nomina,
            'nombre_completo' => "{$this->nombre} {$this->apellidoP} {$this->apellidoM}",
            'puesto' => $this->puesto,
            'area' => $this->area,
            'status' => $this->status,
            'equipos_asignados' => $this->whenLoaded('asignacionesequipos', function () {
                // Mapeamos la lista de asignaciones para mostrar solo los datos del equipo
                return $this->asignacionesequipos->map(function ($asignacion) {
                    if ($asignacion->equipo) {
                        return [
                            'id_equipo' => $asignacion->equipo->id,
                            'etiqueta_skytex' => $asignacion->equipo->etiqueta_skytex,
                            'tipo' => $asignacion->equipo->tipo, // Asumiendo que 'tipo' está en la migración que vimos
                            'modelo' => $asignacion->equipo->modelo,
                            'numero_serie' => $asignacion->equipo->numero_serie,
                            'fecha_asignacion' => $asignacion->fecha_asignacion,
                        ];
                    }
                    return null;
                })->filter(); // filter() elimina cualquier valor nulo (si un equipo fue borrado)
            }),
        ];
    }
}
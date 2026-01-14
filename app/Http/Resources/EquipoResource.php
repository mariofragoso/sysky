<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class EquipoResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        // Aquí definimos la estructura exacta del JSON que la app móvil recibirá.
        return [
            'etiqueta_skytex' => $this->etiqueta_skytex,
            'numero_serie' => $this->numero_serie,
            'tipo' => $this->whenLoaded('tipoEquipo', $this->tipoEquipo->nombre), // Asume que el modelo TipoEquipo tiene un campo 'nombre'
            'marca' => $this->whenLoaded('marca', $this->marca->nombre), // Asume que el modelo Marca tiene un campo 'nombre'
            'modelo' => $this->modelo,
            'estado_actual' => $this->estado,
            'asignacion' => $this->whenLoaded('asignacionActual', function () {
                if ($this->asignacionActual) {
                    return [
                        'fecha_asignacion' => $this->asignacionActual->fecha_asignacion,
                        'ticket' => $this->asignacionActual->ticket,
                        'empleado' => [
                            'numero_nomina' => $this->asignacionActual->empleado->numero_nomina,
                            'nombre_completo' => "{$this->asignacionActual->empleado->nombre} {$this->asignacionActual->empleado->apellidoP} {$this->asignacionActual->empleado->apellidoM}",
                            'puesto' => $this->asignacionActual->empleado->puesto,
                            'area' => $this->asignacionActual->empleado->area,
                        ],
                    ];
                }
                return null; // Devuelve null si no hay asignación
            })
        ];
    }
}

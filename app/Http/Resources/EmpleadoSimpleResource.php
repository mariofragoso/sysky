<?php
namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class EmpleadoSimpleResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        // Solo devolvemos lo mínimo necesario para la lista
        return [
            'id' => $this->id,
            'numero_nomina' => $this->numero_nomina,
            'nombre_completo' => "{$this->nombre} {$this->apellidoP} {$this->apellidoM}"
        ];
    }
}
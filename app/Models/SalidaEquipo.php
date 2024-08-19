<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SalidaEquipo extends Model
{
    protected $table = 'salidas_equipos';

    protected $fillable = [
        'equipo_id',
        'empleado_id',
        'fecha_salida',
        'fecha_regreso',
        'nota_salida',
        'nota_regreso',
        'imagen',
        'imagen_regreso',
    ];
    

    public function equipo()
    {
        return $this->belongsTo(Equipo::class);
    }

    public function empleado()
    {
        return $this->belongsTo(Empleado::class);
    }
}

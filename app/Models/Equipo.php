<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Equipo extends Model
{
    use HasFactory;

    protected $table = 'equipos';

    protected $fillable = [
        'numero_serie', 
        'marca', 
        'modelo', 
        'etiqueta_skytex', 
        'tipo', 
        'orden_compra', 
        'requisicion', 
        'estado'
    ];
}

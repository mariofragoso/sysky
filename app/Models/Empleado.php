<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Empleado extends Model
{
    use HasFactory;

    protected $fillable = [
        'numero_nomina', 'nombre','apellidoP','apellidoM', 'puesto', 'area',
    ];
}

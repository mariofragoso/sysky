<?php
// app/Models/Prestamo.php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Prestamo extends Model
{
    use HasFactory;

    protected $fillable = [
        'equipo_id',
        'empleado_id',
        'fecha_prestamo',
        'fecha_regreso',
        'usuario_responsable_id',
    ];

    public function empleado()
    {
        return $this->belongsTo(Empleado::class);
    }

    public function equipo()
    {
        return $this->belongsTo(Equipo::class);
    }

    public function usuarioResponsable()
    {
        return $this->belongsTo(User::class, 'usuario_responsable_id');
    }
}


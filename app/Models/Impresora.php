<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Impresora extends Model
{
    protected $fillable = ['nombre', 'marca', 'modelo', 'area', 'ip', 'en_linea', 'estado'];
}

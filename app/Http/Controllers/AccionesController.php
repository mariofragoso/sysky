<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Acciones;


class AccionesController extends Controller
{
    public function index()
    {
        $acciones = Acciones::with('usuario')->get();
        return view('acciones.index', compact('acciones'));
    }
}

<?php

// routes/api.php
use App\Http\Controllers\Api\EquipoController;
use App\Http\Controllers\Api\EmpleadoController;
use App\Http\Controllers\Api\AuthController; // <-- ¡AÑADE ESTE IMPORT!
use App\Http\Controllers\Api\DashboardController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

// --- RUTAS PÚBLICAS (No requieren token) ---
Route::post('/login', [AuthController::class, 'login']);


// --- RUTAS PROTEGIDAS (Requieren token) ---
Route::middleware('auth:sanctum')->group(function () {

    // Ruta de usuario (ya la tenías)
    Route::get('/user', function (Request $request) {
        return $request->user();
    });

    // Nueva ruta de Logout
    Route::post('/logout', [AuthController::class, 'logout']);

    // Grupo de Rutas de Equipos
    Route::get('/equipos/buscar/{identifier}', [EquipoController::class, 'search']);
    Route::post('/equipos', [EquipoController::class, 'store']);
    Route::get('/marcas', [EquipoController::class, 'getMarcas']);
    Route::get('/tipos-equipos', [EquipoController::class, 'getTiposEquipos']);

    // Grupo de Rutas de Empleados
    Route::get('/empleados/buscar/{numero_nomina}', [EmpleadoController::class, 'search']);
    Route::get('/empleados/autocompletar', [EmpleadoController::class, 'autocomplete']);

    Route::get('/dashboard', [App\Http\Controllers\Api\DashboardController::class, 'getStats']);
    Route::post('/equipos/asignar', [EquipoController::class, 'asignarEquipo']);
});

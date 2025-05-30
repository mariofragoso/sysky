<?php

namespace App\Http\Controllers;

use App\Models\Empresa;
use App\Models\Acciones;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EmpresaController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    // Mostrar lista de empresas
    public function index()
    {
        $empresas = Empresa::paginate(10);

        return view('empresas.index', compact('empresas'));
    }

    // Mostrar formulario para crear una nueva empresa
    public function create()
    {
        return view('empresas.create');
    }

    // Almacenar una nueva empresa
    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required|max:50|unique:empresas,nombre',
        ], [
            'nombre.unique' => 'El nombre de la empresa ya está registrado.',
            'nombre.required' => 'El nombre de la empresa es obligatorio.',
            'nombre.max' => 'El nombre de la empresa no puede tener más de 50 caracteres.',
        ]);
        try {
            $empresa = Empresa::create($request->all());

            // Registrar la acción
            $this->registrarAccion('Crear', "Se creó la empresa: {$empresa->nombre}");

            return redirect()->route('empresas.index')
                ->with('success', 'Empresa creada exitosamente.');
        } catch (\Exception $e) {
            return redirect()->route('empresas.index')
                ->with('error', 'Ocurrió un error al crear la empresa. Intente nuevamente.');
        }
    }

    // Mostrar detalles de una empresa
    public function show(Empresa $empresa)
    {
        return view('empresas.show', compact('empresa'));
    }

    // Mostrar formulario para editar una empresa
    public function edit(Empresa $empresa)
    {
        return view('empresas.edit', compact('empresa'));
    }

    // Actualizar una empresa
    public function update(Request $request, Empresa $empresa)
    {
        $request->validate([
            'nombre' => 'required|max:50|unique:empresas,nombre,' . $empresa->id,
        ], [
            'nombre.unique' => 'El nombre de la empresa ya está registrado.',
            'nombre.required' => 'El nombre de la empresa es obligatorio.',
            'nombre.max' => 'El nombre de la empresa no puede tener más de 50 caracteres.',
        ]);

        try {
            $empresa->update($request->all());

            // Registrar la acción
            $this->registrarAccion('Editar', "Se actualizó la empresa: {$empresa->nombre}");

            return redirect()->route('empresas.index')
                ->with('success', 'Empresa actualizada exitosamente.');
        } catch (\Exception $e) {
            return redirect()->route('empresas.index')
                ->with('error', 'Ocurrió un error al actualizar la empresa. Intente nuevamente.');
        }
    }

    // Eliminar una empresa
    public function destroy(Empresa $empresa)
    {
        try {
            $empresa->delete();

            // Registrar la acción
            $this->registrarAccion('Eliminar', "Se eliminó la empresa: {$empresa->nombre}");

            return redirect()->route('empresas.index')
                ->with('success', 'Empresa eliminada exitosamente.');
        } catch (\Exception $e) {
            return redirect()->route('empresas.index')
                ->with('error', 'Ocurrió un error al eliminar la empresa. Intente nuevamente.');
        }
    }

    // Método privado para registrar acciones
    private function registrarAccion($accion, $descripcion)
    {
        Acciones::create([
            'modulo' => 'Empresas',
            'descripcion' => $descripcion,
            'usuario_responsable_id' => Auth::user()->id, // Usuario autenticado
        ]);
    }
}

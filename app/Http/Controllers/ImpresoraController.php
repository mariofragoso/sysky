<?php

namespace App\Http\Controllers;

use App\Models\Impresora;
use Illuminate\Http\Request;
use App\Services\PingService;

class ImpresoraController extends Controller
{
    protected $pingService;

    /**
     * Constructor del controlador.
     *
     * @param PingService $pingService
     */
    public function __construct(PingService $pingService)
    {
        $this->middleware('auth');
        $this->pingService = $pingService;
    }

    /**
     * Muestra una lista de todas las impresoras.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $impresoras = Impresora::all();

        // Verificar el estado de cada impresora usando el servicio de ping
        $impresoras->each(function ($impresora) {
            $impresora->estado = $this->pingService->ping($impresora->ip) ? 'En línea' : 'Sin Red';
        });

        return view('impresoras.index', compact('impresoras'));
    }

    /**
     * Obtiene y actualiza el estado de todas las impresoras.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function getEstados()
    {
        $impresoras = Impresora::all();

        $impresoras->each(function ($impresora) {
            $impresora->estado = $this->pingService->ping($impresora->ip) ? 'En línea' : 'Sin Red';
            $impresora->save(); // Guardar el nuevo estado
        });

        return response()->json($impresoras);
    }

    /**
     * Muestra el formulario para crear una nueva impresora.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('impresoras.create');
    }

    /**
     * Almacena una nueva impresora en la base de datos.
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string',
            'marca' => 'required|string',
            'modelo' => 'required|string',
            'ip' => 'required|ip',
            'area' => 'required|string',
        ]);

        Impresora::create($request->all());
        return redirect()->route('impresoras.index')->with('success', 'Impresora registrada correctamente.');
    }

    /**
     * Muestra el formulario para editar una impresora.
     *
     * @param Impresora $impresora
     * @return \Illuminate\View\View
     */
    public function edit(Impresora $impresora)
    {
        return view('impresoras.edit', compact('impresora'));
    }

    /**
     * Actualiza una impresora en la base de datos.
     *
     * @param Request $request
     * @param Impresora $impresora
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, Impresora $impresora)
    {
        $request->validate([
            'modelo' => 'required',
            'marca' => 'required',
            'area' => 'required',
            'ip' => 'required|ip',
        ]);

        $impresora->update($request->all());
        return redirect()->route('impresoras.index')->with('success', 'Impresora actualizada correctamente.');
    }

    /**
     * Muestra los detalles de una impresora.
     *
     * @param int $id
     * @return \Illuminate\View\View
     */
    public function show($id)
    {
        $impresora = Impresora::findOrFail($id);
        return view('impresoras.show', compact('impresora'));
    }

    /**
     * Actualiza el estado de una impresora específica.
     *
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function updateEstado($id)
    {
        $impresora = Impresora::findOrFail($id);

        $enLinea = $this->pingService->ping($impresora->ip);
        $impresora->estado = $enLinea ? 'En línea' : 'Sin red';
        $impresora->save();

        return response()->json(['estado' => $impresora->estado]);
    }
}
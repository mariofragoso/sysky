<?php

namespace App\Exports;

use App\Models\AsignacionEquipo;
use Maatwebsite\Excel\Concerns\FromCollection;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx\Worksheet;

class AsignacionesEquiposExport implements FromCollection
{
    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        return AsignacionEquipo::with(['empleado', 'equipo', 'usuario'])
            ->get()
            ->map(function ($asignacion) {
                return [
                    $asignacion->empleado->nombre ?? 'N/A',
                    $asignacion->empleado->apellidoP ?? 'N/A',
                    $asignacion->empleado->apellidoM ?? 'N/A',
                    $asignacion->equipo->etiqueta_skytex ?? 'N/A',
                    $asignacion->equipo->tipoEquipo->nombre ?? 'Sin Tipo',
                    $asignacion->fecha_asignacion,
                    $asignacion->usuario->name ?? 'N/A',
                    $asignacion->ticket,
                ];
            });
    }

    /**
     * Encabezados de la hoja de Excel.
     */
    public function headings(): array
    {
        return [
            'Nombre Empleado',
            'Apellido Paterno',
            'Apellido Materno',
            'Etiqueta Skytex',
            'Tipo de Equipo',
            'Fecha de Asignación',
            'Usuario Responsable',
            'Ticket',
        ];
    }

    /**
     * Aplicar estilos a la hoja de Excel.
     */
    public function styles(Worksheet $sheet)
    {
        return [
            1 => ['font' => ['bold' => true, 'size' => 12], 'fill' => ['fillType' => 'solid', 'startColor' => ['argb' => 'FFD700']]], // Fondo dorado para los encabezados
            'A1:H1' => ['alignment' => ['horizontal' => 'center']], // Centrar encabezados
        ];
    }
}

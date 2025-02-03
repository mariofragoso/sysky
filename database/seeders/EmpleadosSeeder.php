<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Exception;

class EmpleadosSeeder extends Seeder
{
    public function run()
    {
        try {
            // Conexión a la base de datos SQL Server
            $oldDbConnection = DB::connection('sqlsrv');

            // Consulta para obtener empleados
            $empleados = $oldDbConnection->select('
                SELECT 
                    RH_TRAB.CLA_TRAB as Nomina, 
                    TRIM(RH_TRAB.NOM_TRAB) as Nombre,
                    TRIM(RH_TRAB.AP_PATERNO) as ApellidoP,
                    TRIM(RH_TRAB.AP_MATERNO) as ApellidoM,
                    TRIM(RH_PUESTO.NOM_PUESTO) as Puesto, 
                    TRIM(RH_DEPTO.NOM_DEPTO) as Area,
                    RH_TRAB.STATUS_TRAB as Estatus
                FROM RH_TRAB
                INNER JOIN RH_PUESTO 
                    ON RH_TRAB.CLA_EMPRESA = RH_PUESTO.CLA_EMPRESA 
                    AND RH_TRAB.CLA_PUESTO = RH_PUESTO.CLA_PUESTO 
                INNER JOIN RH_DEPTO 
                    ON RH_TRAB.CLA_DEPTO = RH_DEPTO.CLA_DEPTO 
                    AND RH_TRAB.CLA_EMPRESA = RH_DEPTO.CLA_EMPRESA
                WHERE RH_TRAB.STATUS_TRAB = \'A\'
                ORDER BY Nomina ASC;
            ');

            // Inicia una transacción
            DB::beginTransaction();

            foreach ($empleados as $empleado) {
                // Verificar si el empleado ya existe
                $existingEmpleado = DB::table('empleados')->where('numero_nomina', $empleado->Nomina)->first();

                if ($existingEmpleado) {
                    // Actualizar empleado existente
                    DB::table('empleados')
                        ->where('numero_nomina', $empleado->Nomina)
                        ->update([
                            'nombre' => $empleado->Nombre,
                            'apellidoP' => $empleado->ApellidoP,
                            'apellidoM' => $empleado->ApellidoM,
                            'puesto' => $empleado->Puesto,
                            'area' => $empleado->Area,
                            'status' => $empleado->Estatus,
                            'updated_at' => now(),
                        ]);
                } else {
                    // Insertar nuevo empleado
                    DB::table('empleados')->insert([
                        'numero_nomina' => $empleado->Nomina,
                        'nombre' => $empleado->Nombre,
                        'apellidoP' => $empleado->ApellidoP,
                        'apellidoM' => $empleado->ApellidoM,
                        'puesto' => $empleado->Puesto,
                        'area' => $empleado->Area,
                        'status' => $empleado->Estatus,
                        'created_at' => now(),
                        'updated_at' => now(),
                    ]);
                }
            }

            // Confirmar transacción
            DB::commit();

            Log::info('EmpleadosSeeder ejecutado con éxito.');
        } catch (Exception $e) {
            // Revertir cambios en caso de error
            DB::rollBack();
            Log::error('Error en EmpleadosSeeder: ' . $e->getMessage());
        }
    }
}

<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('asignaciones_equipos', function (Blueprint $table) {
            $table->id()->unique(); // id INT AUTO_INCREMENT PRIMARY KEY
            $table->unsignedBigInteger('empleado_id')->nullable(); // empleado_id INT
            $table->unsignedBigInteger('equipo_id')->nullable(); // equipo_id INT
            $table->date('fecha_asignacion')->nullable(); // fecha_asignacion DATE NOT NULL
            $table->unsignedBigInteger('usuario_responsable')->nullable(); // usuario_responsable INT
            $table->integer('ticket')->nullable(); // ticket INT
            $table->string('nota_descriptiva', 100)->nullable(); // nota_descriptiva VARCHAR(100)
            $table->unsignedBigInteger('empresa_id')->nullable(); // empresa_id INT
            $table->timestamps(); // Agrega created_at y updated_at

            // Definición de las claves foráneas
            $table->foreign('empleado_id')->references('id')->on('empleados')->onDelete('cascade');
            $table->foreign('equipo_id')->references('id')->on('equipos')->onDelete('cascade');
            $table->foreign('usuario_responsable')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('empresa_id')->references('id')->on('empresas')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Eliminar la restricción de clave foránea primero
        Schema::table('asignaciones_equipos', function (Blueprint $table) {
            $table->dropForeign(['empleado_id']);
            $table->dropForeign(['equipo_id']);
            $table->dropForeign(['usuario_responsable']);
            $table->dropForeign(['empresa_id']);
        });

        // Luego, eliminar la tabla
        Schema::dropIfExists('asignaciones_equipos');
    }
};

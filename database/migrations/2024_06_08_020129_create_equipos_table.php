<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(): void
    {
        Schema::create('equipos', function (Blueprint $table) {
            $table->id()->unique(); // id INT AUTO_INCREMENT PRIMARY KEY
            $table->string('numero_serie', 100)->unique()->nullable(); // numero_serie VARCHAR(100) UNIQUE NOT NULL
            $table->string('marca', 50)->nullable(); // marca VARCHAR(50) NOT NULL
            $table->string('modelo', 50)->nullable(); // modelo VARCHAR(50) NOT NULL
            $table->string('etiqueta_skytex', 50)->unique()->nullable(); // etiqueta_skytex VARCHAR(50) NOT NULL
            $table->string('tipo', 100)->nullable(); // tipo VARCHAR(100) NOT NULL
            $table->string('orden_compra', 50)->nullable(); // orden_compra VARCHAR(50)
            $table->string('requisicion', 50)->nullable(); // requisicion VARCHAR(50)
            $table->string('estado', 50)->nullable()->default('no asignado'); // estado VARCHAR(50) NOT NULL
            $table->timestamps(); // Agrega created_at y updated_at
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(): void
    {
        Schema::dropIfExists('equipos');
    }
};

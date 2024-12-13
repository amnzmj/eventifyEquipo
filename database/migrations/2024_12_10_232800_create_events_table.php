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
    public function up()
    {
        Schema::create('events', function (Blueprint $table) {
            $table->id(); // ID del evento (clave primaria)
            $table->string('name'); // Nombre del evento
            $table->string('location'); // Ubicación del evento
            $table->date('date'); // Fecha del evento
            $table->text('description')->nullable(); // Descripción del evento (opcional)
            $table->decimal('price', 8, 2); // Precio del evento
            $table->timestamps(); // Campos created_at y updated_at
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('events');
    }
};

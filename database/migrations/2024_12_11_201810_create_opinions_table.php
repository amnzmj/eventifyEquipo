<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOpinionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('opinions', function (Blueprint $table) {
            $table->id(); // ID autoincremental
            $table->unsignedBigInteger('user_id'); // Relación con la tabla users
            $table->unsignedBigInteger('event_id'); // Relación con la tabla events
            $table->text('opinion'); // Campo para almacenar la opinión
            $table->integer('rating'); // Calificación
            $table->timestamps(); // created_at y updated_at

            // Claves foráneas
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('event_id')->references('id')->on('events')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('opinions'); // Elimina la tabla si existe
    }
}

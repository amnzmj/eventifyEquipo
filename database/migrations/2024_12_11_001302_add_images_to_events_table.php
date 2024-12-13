<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('events', function (Blueprint $table) {
            $table->string('cover_image')->nullable()->after('price'); // Imagen de portada
            $table->string('venue_image')->nullable()->after('cover_image'); // Imagen del lugar
        });
    }

    public function down()
    {
        Schema::table('events', function (Blueprint $table) {
            $table->dropColumn(['cover_image', 'venue_image']);
        });
    }
};
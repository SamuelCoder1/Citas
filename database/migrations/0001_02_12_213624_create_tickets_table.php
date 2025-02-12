<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{

    public function up()
    {
        Schema::create('tiquetes', function (Blueprint $table) {
            $table->id();
            $table->integer('numero');
            $table->enum('estado', ['pendiente', 'en proceso', 'finalizado', 'cancelado']);
            $table->unsignedBigInteger('user_id');  // Sin FK por ahora
            $table->unsignedBigInteger('taquilla_id');  // Sin FK por ahora
            $table->timestamps();
        });
    }




    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tickets');
    }
};

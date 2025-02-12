<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    // database/migrations/xxxx_xx_xx_create_taquillas_table.php

    public function up()
    {
        Schema::create('taquillas', function (Blueprint $table) {
            $table->id();
            $table->string('nombre');
            $table->enum('estado', ['ocupado', 'libre', 'cerrada']);
            $table->timestamps();
        });
    }



    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ticket_offices');
    }
};

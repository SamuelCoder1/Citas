<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('turnos', function (Blueprint $table) {
            $table->foreignId('asesor_id')->nullable()->constrained('users')->onDelete('set null');
            $table->foreignId('taquilla_id')->nullable()->constrained('taquillas')->onDelete('set null');
        });
    }

    public function down()
    {
        Schema::table('turnos', function (Blueprint $table) {
            $table->dropForeign(['asesor_id']);
            $table->dropForeign(['taquilla_id']);
            $table->dropColumn(['asesor_id', 'taquilla_id']);
        });
    }
};

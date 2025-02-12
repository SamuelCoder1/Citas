<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::table('tiquetes', function (Blueprint $table) {
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('taquilla_id')->references('id')->on('taquillas')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::table('tiquetes', function (Blueprint $table) {
            $table->dropForeign(['user_id']);
            $table->dropForeign(['taquilla_id']);
        });
    }
};

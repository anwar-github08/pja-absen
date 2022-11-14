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
        Schema::create('pulangs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('karyawan_id');
            $table->date('tanggal_pulang');
            $table->time('jam_pulang');
            $table->string('lokasi_pulang');
            $table->string('foto_pulang');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pulangs');
    }
};

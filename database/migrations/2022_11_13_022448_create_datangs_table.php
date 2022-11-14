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
        Schema::create('datangs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('karyawan_id');
            $table->date('tanggal_datang');
            $table->time('jam_datang');
            $table->string('lokasi_datang');
            $table->string('foto_datang');
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
        Schema::dropIfExists('datangs');
    }
};

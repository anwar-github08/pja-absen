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
        Schema::create('is_masuks', function (Blueprint $table) {
            $table->id();
            $table->foreignId('karyawan_id');
            $table->date('tanggal_is_masuk');
            $table->time('jam_is_masuk');
            $table->string('lokasi_is_masuk');
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
        Schema::dropIfExists('is_masuks');
    }
};

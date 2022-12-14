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
        Schema::create('jam_kerjas', function (Blueprint $table) {
            $table->id();
            $table->string('nama_jam_kerja');
            $table->time('jam_datang');
            $table->time('jam_is_keluar');
            $table->time('jam_is_masuk');
            $table->time('jam_pulang');
            $table->time('jam_sebelum_datang');
            $table->time('jam_setelah_datang');
            $table->time('jam_sebelum_istirahat');
            $table->time('jam_setelah_istirahat');
            $table->time('jam_sebelum_pulang');
            $table->time('jam_setelah_pulang');
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
        Schema::dropIfExists('jam_kerjas');
    }
};

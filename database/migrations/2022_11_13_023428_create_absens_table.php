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
        Schema::create('absens', function (Blueprint $table) {
            $table->id();
            $table->foreignId('karyawan_id');
            $table->foreignId('datang_id')->nullable();
            $table->foreignId('is_keluar_id')->nullable();
            $table->foreignId('is_masuk_id')->nullable();
            $table->foreignId('pulang_id')->nullable();
            $table->foreignId('izin_id')->nullable();
            $table->date('tanggal_absen');
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
        Schema::dropIfExists('absens');
    }
};

<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Absen;
use App\Models\Datang;
use App\Models\Karyawan;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        // Karyawan::create([

        //     'nama_karyawan' => 'Supriyanto',
        //     'jabatan' => 'Administrasi'
        // ]);

        // Karyawan::create([

        //     'nama_karyawan' => 'Nusron',
        //     'jabatan' => 'Administrasi'
        // ]);
        // Karyawan::create([

        //     'nama_karyawan' => 'Roqib',
        //     'jabatan' => 'Administrasi'
        // ]);
        // Karyawan::create([

        //     'nama_karyawan' => 'Anwar',
        //     'jabatan' => 'Administrasi'
        // ]);
        // Karyawan::create([

        //     'nama_karyawan' => 'Suhadak',
        //     'jabatan' => 'Administrasi'
        // ]);
        // Karyawan::create([

        //     'nama_karyawan' => 'Dikin',
        //     'jabatan' => 'Administrasi'
        // ]);

        Absen::create([
            'karyawan_id' => 4,
            'datang_id' => 11,
            'tanggal_absen' => '2022-10-1'
        ]);
        Absen::create([
            'karyawan_id' => 6,
            'datang_id' => 12,
            'tanggal_absen' => '2022-10-10'
        ]);
        Absen::create([
            'karyawan_id' => 2,
            'datang_id' => 13,
            'tanggal_absen' => '2022-10-21'
        ]);

        Absen::create([
            'karyawan_id' => 4,
            'datang_id' => 11,
            'tanggal_absen' => '2022-09-4'
        ]);
        Absen::create([
            'karyawan_id' => 6,
            'datang_id' => 12,
            'tanggal_absen' => '2022-09-13'
        ]);
        Absen::create([
            'karyawan_id' => 2,
            'datang_id' => 13,
            'tanggal_absen' => '2022-09-26'
        ]);
    }
}

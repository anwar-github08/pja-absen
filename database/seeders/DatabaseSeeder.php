<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Absen;
use App\Models\Datang;
use App\Models\Jabatan;
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

        Karyawan::create([
            'jabatan_id' => 1,
            'nama_karyawan' => 'Afandi',
        ]);
        Karyawan::create([
            'jabatan_id' => 1,
            'nama_karyawan' => 'Sunaji',
        ]);
        Karyawan::create([

            'jabatan_id' => 5,
            'nama_karyawan' => 'Nusron',
        ]);
        Karyawan::create([

            'jabatan_id' => 5,
            'nama_karyawan' => 'Roqib',
        ]);
        Karyawan::create([

            'jabatan_id' => 5,
            'nama_karyawan' => 'Anwar',
        ]);
        Karyawan::create([

            'jabatan_id' => 5,
            'nama_karyawan' => 'Suhadak',
        ]);
        Karyawan::create([

            'jabatan_id' => 5,
            'nama_karyawan' => 'Dikin',
        ]);
        Karyawan::create([

            'jabatan_id' => 4,
            'nama_karyawan' => 'Juki',
        ]);
        Karyawan::create([

            'jabatan_id' => 4,
            'nama_karyawan' => 'Rohman',
        ]);
        Karyawan::create([

            'jabatan_id' => 4,
            'nama_karyawan' => 'Sufyan',
        ]);
        Karyawan::create([

            'jabatan_id' => 3,
            'nama_karyawan' => 'Lana',
        ]);
        Karyawan::create([

            'jabatan_id' => 3,
            'nama_karyawan' => 'Hajar',
        ]);
        Karyawan::create([

            'jabatan_id' => 3,
            'nama_karyawan' => 'Fikri',
        ]);
        Karyawan::create([

            'jabatan_id' => 2,
            'nama_karyawan' => 'Temon',
        ]);
        Karyawan::create([

            'jabatan_id' => 2,
            'nama_karyawan' => 'Agung',
        ]);
        Karyawan::create([

            'jabatan_id' => 2,
            'nama_karyawan' => 'Sihab',
        ]);
        Karyawan::create([

            'jabatan_id' => 2,
            'nama_karyawan' => 'Sucipto',
        ]);
        Karyawan::create([

            'jabatan_id' => 6,
            'nama_karyawan' => 'Suyatin',
        ]);

        // Absen::create([
        //     'karyawan_id' => 4,
        //     'datang_id' => 11,
        //     'tanggal_absen' => '2022-10-1'
        // ]);
        // Absen::create([
        //     'karyawan_id' => 6,
        //     'datang_id' => 12,
        //     'tanggal_absen' => '2022-10-10'
        // ]);
        // Absen::create([
        //     'karyawan_id' => 2,
        //     'datang_id' => 13,
        //     'tanggal_absen' => '2022-10-21'
        // ]);

        // Absen::create([
        //     'karyawan_id' => 4,
        //     'datang_id' => 11,
        //     'tanggal_absen' => '2022-09-4'
        // ]);
        // Absen::create([
        //     'karyawan_id' => 6,
        //     'datang_id' => 12,
        //     'tanggal_absen' => '2022-09-13'
        // ]);
        // Absen::create([
        //     'karyawan_id' => 2,
        //     'datang_id' => 13,
        //     'tanggal_absen' => '2022-09-26'
        // ]);

        Jabatan::create([
            'id' => 1,
            'nama_jabatan' => 'Koordinator'
        ]);
        Jabatan::create([
            'id' => 2,
            'nama_jabatan' => 'Sales'
        ]);
        Jabatan::create([
            'id' => 3,
            'nama_jabatan' => 'Helper'
        ]);
        Jabatan::create([
            'id' => 4,
            'nama_jabatan' => 'Drver'
        ]);
        Jabatan::create([
            'id' => 5,
            'nama_jabatan' => 'Administrasi'
        ]);
        Jabatan::create([
            'id' => 6,
            'nama_jabatan' => 'Manager'
        ]);
        Jabatan::create([
            'id' => 7,
            'nama_jabatan' => 'Auditor'
        ]);
    }
}

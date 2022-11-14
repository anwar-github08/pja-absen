<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

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

            'nama_karyawan' => 'Supriyanto',
            'jabatan' => 'Administrasi'
        ]);

        Karyawan::create([

            'nama_karyawan' => 'Nusron',
            'jabatan' => 'Administrasi'
        ]);
        Karyawan::create([

            'nama_karyawan' => 'Roqib',
            'jabatan' => 'Administrasi'
        ]);
        Karyawan::create([

            'nama_karyawan' => 'Anwar',
            'jabatan' => 'Administrasi'
        ]);
        Karyawan::create([

            'nama_karyawan' => 'Suhadak',
            'jabatan' => 'Administrasi'
        ]);
        Karyawan::create([

            'nama_karyawan' => 'Dikin',
            'jabatan' => 'Administrasi'
        ]);
    }
}

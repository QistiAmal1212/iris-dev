<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class SecurityMenuSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        \DB::table('security_menu')->delete();

        \DB::table('security_menu')->insert(array (
            0 =>
            array (
                'name' => 'Pengurusan Sistem',
                'type' => 'Menu',
                'module_id' => null,
                'level' => 1,
                'sequence' => 1,
                'menu_link' => null,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ),
            1 =>
            array (
                'name' => 'Maklumat Permohonan',
                'type' => 'Menu',
                'module_id' => null,
                'level' => 1,
                'sequence' => 2,
                'menu_link' => null,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ),
            2 =>
            array (
                'name' => 'Pengurusan Data',
                'type' => 'Menu',
                'module_id' => null,
                'level' => 2,
                'sequence' => 1,
                'menu_link' => 1,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ),
            3 =>
            array (
                'name' => 'Pengurusan Pengguna',
                'type' => 'Menu',
                'module_id' => null,
                'level' => 2,
                'sequence' => 2,
                'menu_link' => 1,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ),
            4 =>
            array (
                'name' => 'Pengurusan Keselamatan',
                'type' => 'Menu',
                'module_id' => null,
                'level' => 2,
                'sequence' => 3,
                'menu_link' => 1,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ),
            5 =>
            array (
                'name' => 'Transaksi Pengguna',
                'type' => 'Web',
                'module_id' => 7,
                'level' => 2,
                'sequence' => 4,
                'menu_link' => 1,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ),
            6 =>
            array (
                'name' => 'Pemohon',
                'type' => 'Menu',
                'module_id' => null,
                'level' => 2,
                'sequence' => 1,
                'menu_link' => 2,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ),
            7 =>
            array (
                'name' => 'Pengguna Dalaman',
                'type' => 'Web',
                'module_id' => 2,
                'level' => 3,
                'sequence' => 1,
                'menu_link' => 4,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ),
            8 =>
            array (
                'name' => 'Peranan',
                'type' => 'Web',
                'module_id' => 3,
                'level' => 3,
                'sequence' => 3,
                'menu_link' => 4,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ),
            9 =>
            array (
                'name' => 'Selenggara Menu',
                'type' => 'Web',
                'module_id' => 4,
                'level' => 3,
                'sequence' => 1,
                'menu_link' => 5,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ),
            10 =>
            array (
                'name' => 'Carian Pemohon',
                'type' => 'Web',
                'module_id' => 8,
                'level' => 3,
                'sequence' => 1,
                'menu_link' => 7,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ),
            11 =>
            array (
                'name' => 'Negeri',
                'type' => 'Web',
                'module_id' => 9,
                'level' => 3,
                'sequence' => 1,
                'menu_link' => 3,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ),
            12 =>
            array (
                'name' => 'Agama',
                'type' => 'Web',
                'module_id' => 10,
                'level' => 3,
                'sequence' => 2,
                'menu_link' => 3,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ),
            13 =>
            array (
                'name' => 'Taraf Perkahwinan',
                'type' => 'Web',
                'module_id' => 11,
                'level' => 3,
                'sequence' => 3,
                'menu_link' => 3,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ),
            14 =>
            array (
                'name' => 'Pengguna Luaran',
                'type' => 'Web',
                'module_id' => 12,
                'level' => 3,
                'sequence' => 2,
                'menu_link' => 4,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ),
            15 =>
            array (
                'name' => 'Kementerian',
                'type' => 'Web',
                'module_id' => 13,
                'level' => 3,
                'sequence' => 4,
                'menu_link' => 3,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ),
            16 =>
            array (
                'name' => 'Jawatan',
                'type' => 'Web',
                'module_id' => 14,
                'level' => 3,
                'sequence' => 5,
                'menu_link' => 3,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ),
            17 =>
            array (
                'name' => 'Institusi',
                'type' => 'Web',
                'module_id' => 15,
                'level' => 3,
                'sequence' => 6,
                'menu_link' => 3,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ),
            18 =>
            array (
                'name' => 'Pengkhususan',
                'type' => 'Web',
                'module_id' => 16,
                'level' => 3,
                'sequence' => 7,
                'menu_link' => 3,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ),
            19 =>
            array (
                'name' => 'Kelulusan',
                'type' => 'Web',
                'module_id' => 17,
                'level' => 3,
                'sequence' => 8,
                'menu_link' => 3,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ),
            20 =>
            array (
                'name' => 'Keturunan',
                'type' => 'Web',
                'module_id' => 18,
                'level' => 3,
                'sequence' => 9,
                'menu_link' => 3,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ),
            21 =>
            array (
                'name' => 'Kumpulan Pengguna',
                'type' => 'Web',
                'module_id' => 19,
                'level' => 3,
                'sequence' => 4,
                'menu_link' => 4,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ),
            22 =>
            array (
                'name' => 'Jantina',
                'type' => 'Web',
                'module_id' => 20,
                'level' => 3,
                'sequence' => 10,
                'menu_link' => 3,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ),
        ));
    }
}

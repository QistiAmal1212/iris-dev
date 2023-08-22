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
                'name' => 'Selenggara Pengguna',
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
                'name' => 'Role',
                'type' => 'Web',
                'module_id' => 3,
                'level' => 3,
                'sequence' => 2,
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
        ));
    }
}

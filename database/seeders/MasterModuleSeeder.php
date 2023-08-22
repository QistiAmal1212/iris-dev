<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class MasterModuleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        \DB::table('master_module')->delete();

        \DB::table('master_module')->insert(array (
            0 =>
            array (
                'name' => 'Utama',
                'data' => null,
                'code' => 'home',
                'type' => 1,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ),
            1 =>
            array (
                'name' => 'Pengguna',
                'data' => null,
                'code' => 'admin.internalUser',
                'type' => 2,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ),
            2 =>
            array (
                'name' => 'Kumpulan Pengguna',
                'data' => null,
                'code' => 'role.index',
                'type' => 2,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ),
            3 =>
            array (
                'name' => 'Menu',
                'data' => null,
                'code' => 'admin.security.menu',
                'type' => 2,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ),
            4 =>
            array (
                'name' => 'Capaian',
                'data' => null,
                'code' => 'admin.security.access',
                'type' => 2,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ),
            5 =>
            array (
                'name' => 'Turutan',
                'data' => null,
                'code' => 'admin.security.sequence',
                'type' => 2,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ),
            6 =>
            array (
                'name' => 'Transaksi Pengguna',
                'data' => null,
                'code' => 'admin.log',
                'type' => 2,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ),
            7 =>
            array (
                'name' => 'Pemohon',
                'data' => null,
                'code' => 'carian_pemohon',
                'type' => 2,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ),
        ));
    }
}

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
                'name' => 'Pengguna Dalaman',
                'data' => null,
                'code' => 'admin.internalUser',
                'type' => 2,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ),
            2 =>
            array (
                'name' => 'Peranan',
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
            8 =>
            array (
                'name' => 'Negeri',
                'data' => null,
                'code' => 'admin.reference.state',
                'type' => 2,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ),
            9 =>
            array (
                'name' => 'Agama',
                'data' => null,
                'code' => 'admin.reference.religion',
                'type' => 2,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ),
            10 =>
            array (
                'name' => 'Taraf Perkahwinan',
                'data' => null,
                'code' => 'admin.reference.marital-status',
                'type' => 2,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ),
            11 =>
            array (
                'name' => 'Pengguna Luar',
                'data' => null,
                'code' => 'admin.externalUser',
                'type' => 2,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ),
            12 =>
            array (
                'name' => 'Kementerian',
                'data' => null,
                'code' => 'admin.reference.department-ministry',
                'type' => 2,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ),
            13 =>
            array (
                'name' => 'Jawatan',
                'data' => null,
                'code' => 'admin.reference.skim',
                'type' => 2,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ),
            14 =>
            array (
                'name' => 'Institusi',
                'data' => null,
                'code' => 'admin.reference.institution',
                'type' => 2,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ),
            15 =>
            array (
                'name' => 'Pengkhususan',
                'data' => null,
                'code' => 'admin.reference.specialization',
                'type' => 2,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ),
            16 =>
            array (
                'name' => 'Kelulusan',
                'data' => null,
                'code' => 'admin.reference.qualification',
                'type' => 2,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ),
            17 =>
            array (
                'name' => 'Keturunan',
                'data' => null,
                'code' => 'admin.reference.race',
                'type' => 2,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ),
            18 =>
            array (
                'name' => 'Kumpulan Pengguna',
                'data' => null,
                'code' => 'admin.group-role',
                'type' => 2,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ),
            19 =>
            array (
                'name' => 'Jantina',
                'data' => null,
                'code' => 'admin.reference.gender',
                'type' => 2,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ),
        ));
    }
}

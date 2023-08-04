<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class RolesTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {


        \DB::table('roles')->delete();

        \DB::table('roles')->insert(array (
            0 =>
            array (
                'id' => 1,
                'name' => 'superadmin',
                'description' => 'Internal User with full permission and privilege',
                'display_name' => 'superadmin',
                'guard_name' => 'web',
                'is_internal' => 1,
                'created_at' => '2022-03-23 11:49:33',
                'updated_at' => '2022-03-23 11:49:36',
            ),
            1 =>
            array (
                'id' => 2,
                'name' => 'admin',
                'description' => 'Internal User with medium level privilege and permission',
                'display_name' => 'admin',
                'guard_name' => 'web',
                'is_internal' => 1,
                'created_at' => '2022-03-23 11:49:33',
                'updated_at' => '2022-03-24 06:22:07',
            ),
            2 =>
            array (
                'id' => 3,
                'name' => 'Pengguna Luar',
                'description' => 'External User with basic permission',
                'display_name' => 'pengguna_luar',
                'guard_name' => 'web',
                'is_internal' => 0,
                'created_at' => '2022-04-07 09:47:10',
                'updated_at' => '2022-04-07 09:47:10',
            ),
            3 =>
            array (
                'id' => 4,
                'name' => 'pengguna_luar_1',
                'description' => 'External User with basic permission',
                'display_name' => 'pengguna_luar_1',
                'guard_name' => 'web',
                'is_internal' => 0,
                'created_at' => '2022-04-07 09:47:10',
                'updated_at' => '2022-04-07 09:47:10',
            ),
            4 =>
            array (
                'id' => 5,
                'name' => 'pengguna_luar_2',
                'description' => 'External User with basic permission',
                'display_name' => 'pengguna_luar_2',
                'guard_name' => 'web',
                'is_internal' => 0,
                'created_at' => '2022-04-07 09:47:10',
                'updated_at' => '2022-04-07 09:47:10',
            ),
            5 =>
            array (
                'id' => 6,
                'name' => '[Test_Module]_Pengguna_Luar_1',
                'description' => 'Isi Permohonan',
                'display_name' => '[Test Module] Pengguna Luar 1',
                'guard_name' => 'web',
                'is_internal' => 0,
                'created_at' => '2022-09-27 18:17:12',
                'updated_at' => '2022-09-27 18:17:12',
            ),
            6 =>
            array (
                'id' => 7,
                'name' => '[Test_Module]_Pengguna_Luar_2',
                'description' => 'Isi Deklarasi',
                'display_name' => '[Test Module] Pengguna Luar 2',
                'guard_name' => 'web',
                'is_internal' => 0,
                'created_at' => '2022-09-27 18:17:32',
                'updated_at' => '2022-09-27 18:17:32',
            ),
            7 =>
            array (
                'id' => 8,
                'name' => '[Test_Module]_Admin',
                'description' => 'Lulus Permohonan',
                'display_name' => '[Test Module] Admin',
                'guard_name' => 'web',
                'is_internal' => 1,
                'created_at' => '2022-09-27 18:18:05',
                'updated_at' => '2022-09-27 18:18:05',
            ),
            8 =>
            array (
                'id' => 9,
                'name' => 'random',
                'description' => 'random',
                'display_name' => 'random',
                'guard_name' => 'web',
                'is_internal' => 1,
                'created_at' => '2022-09-28 15:15:40',
                'updated_at' => '2022-09-28 15:15:40',
            ),
            9 =>
            array (
                'id' => 10,
                'name' => 'Helpdesk_Vendor',
                'description' => 'Vendor of helpdesk module',
                'display_name' => '[Helpdesk] Vendor',
                'guard_name' => 'web',
                'is_internal' => 1,
                'created_at' => '2023-05-23 14:54:39',
                'updated_at' => '2023-05-23 15:03:55',
            ),
            10 =>
            array (
                'id' => 11,
                'name' => 'Helpdesk_Pegawai_btm',
                'description' => 'Officer of helpdesk module',
                'display_name' => '[Helpdesk] Pegawai BTM',
                'guard_name' => 'web',
                'is_internal' => 1,
                'created_at' => '2023-05-23 14:55:28',
                'updated_at' => '2023-05-23 15:04:07',
            ),
        ));


    }
}

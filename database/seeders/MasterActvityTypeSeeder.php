<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class MasterActvityTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        \DB::table('master_activity_type')->delete();

        \DB::table('master_activity_type')->insert(array (
            0 =>
            array (
                'name' => 'Lihat Senarai',
                'name_bi' => 'View List',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ),
            1 =>
            array (
                'name' => 'Lihat Maklumat',
                'name_bi' => 'View Detail',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ),
            2 =>
            array (
                'name' => 'Tambah Data',
                'name_bi' => 'Add Data',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ),
            3 =>
            array (
                'name' => 'Kemaskini Data',
                'name_bi' => 'Update Data',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ),
            4 =>
            array (
                'name' => 'Padam Data',
                'name_bi' => 'Delete Data',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ),
            5 =>
            array (
                'name' => 'Log Masuk',
                'name_bi' => 'Login',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ),
            6 =>
            array (
                'name' => 'Log Keluar',
                'name_bi' => 'Logout',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ),
        ));
    }
}

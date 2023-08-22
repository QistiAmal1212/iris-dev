<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class MasterFunctionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        \DB::table('master_function')->delete();

        \DB::table('master_function')->insert(array (
            0 =>
            array (
                'name' => 'Bahagian Pengambilan',
                'code' => 'SM',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ),
            1 =>
            array (
                'name' => 'Bahagian Pengambilan Khas',
                'code' => 'SK',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ),
            2 =>
            array (
                'name' => 'Urusetia Sarawak',
                'code' => 'SW',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ),
            3 =>
            array (
                'name' => 'Urusetia Sabah',
                'code' => 'SB',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ),
            4 =>
            array (
                'name' => 'Kumpulan Sokongan II',
                'code' => 'SS',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ),
            5 =>
            array (
                'name' => 'Temuduga Terbuka',
                'code' => 'ST',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ),
            6 =>
            array (
                'name' => 'Suruhanjaya Perkhidamatan Perundangan dan Kehakiman',
                'code' => 'SP',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ),
            7 =>
            array (
                'name' => 'Lain-Lain',
                'code' => 'SL',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ),
            8 =>
            array (
                'name' => 'Jabatan',
                'code' => 'SJ',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ),
        ));
    }
}

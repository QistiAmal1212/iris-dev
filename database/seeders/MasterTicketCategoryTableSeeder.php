<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class MasterTicketCategoryTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {


        \DB::table('master_ticket_category')->delete();

        \DB::table('master_ticket_category')->insert(array (
            0 =>
            array (
                'category_description' => 'UMUM',
                'category_name' => 'UMUM',
                'created_at' => '2023-05-22 17:42:25',
                'id' => 1,
                'updated_at' => '2023-05-22 17:42:25',
            ),
            1 =>
            array (
                'category_description' => 'PROGRAM BAHARU',
                'category_name' => 'PROGRAM BAHARU',
                'created_at' => '2023-05-22 17:42:25',
                'id' => 2,
                'updated_at' => '2023-05-22 17:42:25',
            ),
            2 =>
            array (
                'category_description' => 'LAPORAN BULANAN',
                'category_name' => 'LAPORAN BULANAN',
                'created_at' => '2023-05-22 17:42:25',
                'id' => 3,
                'updated_at' => '2023-05-22 17:42:25',
            ),
            3 =>
            array (
                'category_description' => 'JANA LAPORAN',
                'category_name' => 'JANA LAPORAN',
                'created_at' => '2023-05-22 17:42:25',
                'id' => 4,
                'updated_at' => '2023-05-22 17:42:25',
            ),
            4 =>
            array (
                'category_description' => 'DASHBOARD',
                'category_name' => 'DASHBOARD',
                'created_at' => '2023-05-22 17:42:25',
                'id' => 5,
                'updated_at' => '2023-05-22 17:42:25',
            ),
        ));


    }
}

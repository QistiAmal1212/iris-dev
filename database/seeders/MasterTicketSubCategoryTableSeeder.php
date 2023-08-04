<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class MasterTicketSubCategoryTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('master_ticket_sub_category')->delete();
        
        \DB::table('master_ticket_sub_category')->insert(array (
            0 => 
            array (
                'created_at' => '2023-05-22 17:42:25',
                'id' => 1,
                'master_ticket_category_id' => 1,
                'sub_category_description' => 'LOG MASUK',
                'sub_category_name' => 'LOG MASUK',
                'updated_at' => '2023-05-22 17:42:25',
            ),
            1 => 
            array (
                'created_at' => '2023-05-22 17:42:25',
                'id' => 2,
                'master_ticket_category_id' => 1,
                'sub_category_description' => 'AKSES KE SISTEM',
                'sub_category_name' => 'AKSES KE SISTEM',
                'updated_at' => '2023-05-22 17:42:25',
            ),
            2 => 
            array (
                'created_at' => '2023-05-22 17:42:25',
                'id' => 3,
                'master_ticket_category_id' => 1,
                'sub_category_description' => 'MODUL ADMIN',
                'sub_category_name' => 'MODUL ADMIN',
                'updated_at' => '2023-05-22 17:42:25',
            ),
            3 => 
            array (
                'created_at' => '2023-05-22 17:42:25',
                'id' => 4,
                'master_ticket_category_id' => 1,
                'sub_category_description' => 'LAIN-LAIN',
                'sub_category_name' => 'LAIN-LAIN',
                'updated_at' => '2023-05-22 17:42:25',
            ),
            4 => 
            array (
                'created_at' => '2023-05-22 17:42:25',
                'id' => 5,
                'master_ticket_category_id' => 2,
                'sub_category_description' => 'KEMASUKAN PROGRAM',
                'sub_category_name' => 'KEMASUKAN PROGRAM',
                'updated_at' => '2023-05-22 17:42:25',
            ),
            5 => 
            array (
                'created_at' => '2023-05-22 17:42:25',
                'id' => 6,
                'master_ticket_category_id' => 2,
                'sub_category_description' => 'SENARAI PROGRAM BAHARU',
                'sub_category_name' => 'SENARAI PROGRAM BAHARU',
                'updated_at' => '2023-05-22 17:42:25',
            ),
            6 => 
            array (
                'created_at' => '2023-05-22 17:42:25',
                'id' => 7,
                'master_ticket_category_id' => 2,
                'sub_category_description' => 'SEMAKAN PEMILIK PROGRAM',
                'sub_category_name' => 'SEMAKAN PEMILIK PROGRAM',
                'updated_at' => '2023-05-22 17:42:25',
            ),
            7 => 
            array (
                'created_at' => '2023-05-22 17:42:25',
                'id' => 8,
                'master_ticket_category_id' => 2,
                'sub_category_description' => 'SEMAKAN URUSETIA',
                'sub_category_name' => 'SEMAKAN URUSETIA',
                'updated_at' => '2023-05-22 17:42:25',
            ),
            8 => 
            array (
                'created_at' => '2023-05-22 17:42:25',
                'id' => 9,
                'master_ticket_category_id' => 3,
                'sub_category_description' => 'KEMASUKAN LAPORAN BULANAN',
                'sub_category_name' => 'KEMASUKAN LAPORAN BULANAN',
                'updated_at' => '2023-05-22 17:42:25',
            ),
            9 => 
            array (
                'created_at' => '2023-05-22 17:42:25',
                'id' => 10,
                'master_ticket_category_id' => 3,
                'sub_category_description' => 'SENARAI LAPORAN BULANAN',
                'sub_category_name' => 'SENARAI LAPORAN BULANAN',
                'updated_at' => '2023-05-22 17:42:25',
            ),
            10 => 
            array (
                'created_at' => '2023-05-22 17:42:25',
                'id' => 11,
                'master_ticket_category_id' => 3,
                'sub_category_description' => 'SEMAKAN PEMILIK PROGRAM',
                'sub_category_name' => 'SEMAKAN PEMILIK PROGRAM',
                'updated_at' => '2023-05-22 17:42:25',
            ),
            11 => 
            array (
                'created_at' => '2023-05-22 17:42:25',
                'id' => 12,
                'master_ticket_category_id' => 3,
                'sub_category_description' => 'SEMAKAN URUSETIA',
                'sub_category_name' => 'SEMAKAN URUSETIA',
                'updated_at' => '2023-05-22 17:42:25',
            ),
            12 => 
            array (
                'created_at' => '2023-05-22 17:42:25',
                'id' => 13,
                'master_ticket_category_id' => 4,
                'sub_category_description' => 'MAKLUMAT JANA LAPORAN',
                'sub_category_name' => 'MAKLUMAT JANA LAPORAN',
                'updated_at' => '2023-05-22 17:42:25',
            ),
            13 => 
            array (
                'created_at' => '2023-05-22 17:42:25',
                'id' => 14,
                'master_ticket_category_id' => 5,
                'sub_category_description' => 'MAKLUMAT DASHBOARD',
                'sub_category_name' => 'MAKLUMAT DASHBOARD',
                'updated_at' => '2023-05-22 17:42:25',
            ),
        ));
        
        
    }
}
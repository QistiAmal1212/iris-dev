<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class ModuleStatusTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('module_status')->delete();
        
        \DB::table('module_status')->insert(array (
            0 => 
            array (
                'id' => 1,
                'module_id' => 1,
                'status_index' => 1,
                'status_name' => 'Draft',
                'status_description' => 'Masih Diisi Oleh Pengguna Luar 1',
                'status_color' => 'primary',
                'active' => 1,
                'created_at' => '2022-09-26 18:21:06',
                'updated_at' => '2022-09-26 18:21:06',
            ),
            1 => 
            array (
                'id' => 2,
                'module_id' => 1,
                'status_index' => 2,
                'status_name' => 'Pengesahan PL2',
                'status_description' => 'Pengesahan oleh Pengguna Luar 2',
                'status_color' => 'primary',
                'active' => 1,
                'created_at' => '2022-09-26 18:21:36',
                'updated_at' => '2022-09-26 18:21:36',
            ),
            2 => 
            array (
                'id' => 3,
                'module_id' => 1,
                'status_index' => 3,
                'status_name' => 'Pengesahan Admin',
                'status_description' => 'Pengesahan Admin',
                'status_color' => 'primary',
                'active' => 1,
                'created_at' => '2022-09-26 18:21:50',
                'updated_at' => '2022-09-26 18:21:50',
            ),
            3 => 
            array (
                'id' => 4,
                'module_id' => 2,
                'status_index' => 1,
                'status_name' => 'New',
                'status_description' => 'New Ticket',
                'status_color' => 'warning',
                'active' => 1,
                'created_at' => '2023-06-19 18:45:02',
                'updated_at' => '2023-06-19 18:45:02',
            ),
            4 => 
            array (
                'id' => 5,
                'module_id' => 2,
                'status_index' => 2,
                'status_name' => 'Cancel',
                'status_description' => 'Cancel Ticket',
                'status_color' => 'danger',
                'active' => 1,
                'created_at' => '2023-06-19 18:45:02',
                'updated_at' => '2023-06-19 18:45:02',
            ),
            5 => 
            array (
                'id' => 6,
                'module_id' => 2,
                'status_index' => 3,
                'status_name' => 'Acknowledge',
                'status_description' => 'Acknowledge Ticket',
                'status_color' => 'primary',
                'active' => 1,
                'created_at' => '2023-06-19 18:45:02',
                'updated_at' => '2023-06-26 10:59:11',
            ),
            6 => 
            array (
                'id' => 7,
                'module_id' => 2,
                'status_index' => 4,
                'status_name' => 'In Progress',
                'status_description' => 'In Progress Ticket',
                'status_color' => 'info',
                'active' => 1,
                'created_at' => '2023-06-19 18:45:02',
                'updated_at' => '2023-06-19 18:45:02',
            ),
            7 => 
            array (
                'id' => 8,
                'module_id' => 2,
                'status_index' => 5,
                'status_name' => 'Push Staging',
                'status_description' => 'Push Staging Ticket',
                'status_color' => 'info',
                'active' => 1,
                'created_at' => '2023-06-19 18:45:02',
                'updated_at' => '2023-06-19 18:45:02',
            ),
            8 => 
            array (
                'id' => 9,
                'module_id' => 2,
                'status_index' => 6,
                'status_name' => 'Re Acknowledge',
                'status_description' => 'Re-Acknowledge Ticket',
                'status_color' => 'secondary',
                'active' => 1,
                'created_at' => '2023-06-19 18:45:02',
                'updated_at' => '2023-06-19 18:45:02',
            ),
            9 => 
            array (
                'id' => 10,
                'module_id' => 2,
                'status_index' => 7,
                'status_name' => 'Verified Staging',
                'status_description' => 'Verified Staging Ticket',
                'status_color' => 'info',
                'active' => 1,
                'created_at' => '2023-06-19 18:45:02',
                'updated_at' => '2023-06-19 18:45:02',
            ),
            10 => 
            array (
                'id' => 11,
                'module_id' => 2,
                'status_index' => 8,
                'status_name' => 'Push Production',
                'status_description' => 'Push Production Ticket',
                'status_color' => 'info',
                'active' => 1,
                'created_at' => '2023-06-19 18:45:02',
                'updated_at' => '2023-06-19 18:45:02',
            ),
            11 => 
            array (
                'id' => 12,
                'module_id' => 2,
                'status_index' => 9,
                'status_name' => 'Verified Production',
                'status_description' => 'Verified Production Ticket',
                'status_color' => 'info',
                'active' => 1,
                'created_at' => '2023-06-19 18:45:02',
                'updated_at' => '2023-06-19 18:45:02',
            ),
            12 => 
            array (
                'id' => 13,
                'module_id' => 2,
                'status_index' => 10,
                'status_name' => 'Resolved',
                'status_description' => 'Resolved Ticket',
                'status_color' => 'success',
                'active' => 1,
                'created_at' => '2023-06-19 18:45:02',
                'updated_at' => '2023-06-19 18:45:02',
            ),
        ));
        
        
    }
}
<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class ModuleFlowManagementTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('module_flow_management')->delete();
        
        \DB::table('module_flow_management')->insert(array (
            0 => 
            array (
                'id' => 1,
                'module_id' => 1,
                'current_status' => 1,
                'module_role_id' => 1,
                'action' => 'submit',
                'next_status' => 2,
                'active' => 1,
                'created_at' => '2022-09-27 12:38:47',
                'updated_at' => '2022-09-27 12:38:47',
            ),
            1 => 
            array (
                'id' => 2,
                'module_id' => 1,
                'current_status' => 2,
                'module_role_id' => 2,
                'action' => 'submit',
                'next_status' => 3,
                'active' => 1,
                'created_at' => '2022-09-27 16:51:39',
                'updated_at' => '2022-09-27 16:51:39',
            ),
            2 => 
            array (
                'id' => 3,
                'module_id' => 1,
                'current_status' => 3,
                'module_role_id' => 3,
                'action' => 'submit',
                'next_status' => 4,
                'active' => 1,
                'created_at' => '2022-09-27 16:51:46',
                'updated_at' => '2022-09-27 16:51:46',
            ),
            3 => 
            array (
                'id' => 4,
                'module_id' => 2,
                'current_status' => 4,
                'module_role_id' => 5,
                'action' => 'acknowledge',
                'next_status' => 6,
                'active' => 1,
                'created_at' => '2023-06-19 18:45:02',
                'updated_at' => '2023-06-19 18:45:02',
            ),
            4 => 
            array (
                'id' => 5,
                'module_id' => 2,
                'current_status' => 4,
                'module_role_id' => 5,
                'action' => 'cancel ticket',
                'next_status' => 5,
                'active' => 1,
                'created_at' => '2023-06-19 18:45:02',
                'updated_at' => '2023-06-19 18:45:02',
            ),
            5 => 
            array (
                'id' => 6,
                'module_id' => 2,
                'current_status' => 6,
                'module_role_id' => 6,
                'action' => 'in progress',
                'next_status' => 7,
                'active' => 1,
                'created_at' => '2023-06-19 18:45:02',
                'updated_at' => '2023-06-19 18:45:02',
            ),
            6 => 
            array (
                'id' => 7,
                'module_id' => 2,
                'current_status' => 7,
                'module_role_id' => 6,
                'action' => 'push staging',
                'next_status' => 8,
                'active' => 1,
                'created_at' => '2023-06-19 18:45:02',
                'updated_at' => '2023-06-19 18:45:02',
            ),
            7 => 
            array (
                'id' => 8,
                'module_id' => 2,
                'current_status' => 8,
                'module_role_id' => 5,
            'action' => 'solved (verified staging)',
                'next_status' => 10,
                'active' => 1,
                'created_at' => '2023-06-19 18:45:02',
                'updated_at' => '2023-06-19 18:45:02',
            ),
            8 => 
            array (
                'id' => 9,
                'module_id' => 2,
                'current_status' => 8,
                'module_role_id' => 5,
            'action' => 'not solved (re-acknowledge)',
                'next_status' => 9,
                'active' => 1,
                'created_at' => '2023-06-19 18:45:02',
                'updated_at' => '2023-06-19 18:45:02',
            ),
            9 => 
            array (
                'id' => 10,
                'module_id' => 2,
                'current_status' => 9,
                'module_role_id' => 6,
                'action' => 'in progress',
                'next_status' => 7,
                'active' => 1,
                'created_at' => '2023-06-19 18:45:02',
                'updated_at' => '2023-06-19 18:45:02',
            ),
            10 => 
            array (
                'id' => 11,
                'module_id' => 2,
                'current_status' => 10,
                'module_role_id' => 6,
                'action' => 'push production',
                'next_status' => 11,
                'active' => 1,
                'created_at' => '2023-06-19 18:45:02',
                'updated_at' => '2023-06-19 18:45:02',
            ),
            11 => 
            array (
                'id' => 12,
                'module_id' => 2,
                'current_status' => 11,
                'module_role_id' => 5,
            'action' => 'solved (verified production)',
                'next_status' => 12,
                'active' => 1,
                'created_at' => '2023-06-19 18:45:02',
                'updated_at' => '2023-06-19 18:45:02',
            ),
            12 => 
            array (
                'id' => 13,
                'module_id' => 2,
                'current_status' => 12,
                'module_role_id' => 5,
            'action' => 'not solved (re-acknowledge)',
                'next_status' => 9,
                'active' => 1,
                'created_at' => '2023-06-19 18:45:02',
                'updated_at' => '2023-06-19 18:45:02',
            ),
            13 => 
            array (
                'id' => 14,
                'module_id' => 2,
                'current_status' => 12,
                'module_role_id' => 6,
                'action' => 'resolved',
                'next_status' => 13,
                'active' => 1,
                'created_at' => '2023-06-19 18:45:02',
                'updated_at' => '2023-06-19 18:45:02',
            ),
        ));
        
        
    }
}
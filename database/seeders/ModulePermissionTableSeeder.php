<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class ModulePermissionTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('module_permission')->delete();
        
        \DB::table('module_permission')->insert(array (
            0 => 
            array (
                'id' => 1,
                'module_id' => 1,
                'perm_name' => 'Tab1_View',
                'perm_description' => 'View for Tab 1',
                'active' => 1,
                'created_at' => '2022-09-27 10:36:48',
                'updated_at' => '2022-09-27 11:15:40',
            ),
            1 => 
            array (
                'id' => 2,
                'module_id' => 1,
                'perm_name' => 'Tab1_Edit',
                'perm_description' => 'Edit for Tab 1',
                'active' => 1,
                'created_at' => '2022-09-27 10:36:42',
                'updated_at' => '2022-09-27 11:15:25',
            ),
            2 => 
            array (
                'id' => 3,
                'module_id' => 1,
                'perm_name' => 'Tab2_View',
                'perm_description' => 'View for Tab 2',
                'active' => 1,
                'created_at' => '2022-09-27 11:16:56',
                'updated_at' => '2022-09-27 11:16:56',
            ),
            3 => 
            array (
                'id' => 4,
                'module_id' => 1,
                'perm_name' => 'Tab2_Edit',
                'perm_description' => 'Edit for Tab 2',
                'active' => 1,
                'created_at' => '2022-09-27 11:16:44',
                'updated_at' => '2022-09-27 11:16:44',
            ),
            4 => 
            array (
                'id' => 5,
                'module_id' => 1,
                'perm_name' => 'Tab2_SectionA_View',
                'perm_description' => 'View for Tab 2 Section A',
                'active' => 1,
                'created_at' => '2022-09-27 10:37:04',
                'updated_at' => '2022-09-27 10:37:04',
            ),
            5 => 
            array (
                'id' => 6,
                'module_id' => 1,
                'perm_name' => 'Tab2_SectionA_Edit',
                'perm_description' => 'Edit for Tab 2 Section A',
                'active' => 1,
                'created_at' => '2022-09-27 10:37:16',
                'updated_at' => '2022-09-27 10:37:16',
            ),
            6 => 
            array (
                'id' => 7,
                'module_id' => 1,
                'perm_name' => 'Tab2_SectionB_View',
                'perm_description' => 'View for Tab 2 Section B',
                'active' => 1,
                'created_at' => '2022-09-27 10:37:29',
                'updated_at' => '2022-09-27 10:37:29',
            ),
            7 => 
            array (
                'id' => 8,
                'module_id' => 1,
                'perm_name' => 'Tab2_SectionB_Edit',
                'perm_description' => 'Edit for Tab 2 Section B',
                'active' => 1,
                'created_at' => '2022-09-27 10:37:37',
                'updated_at' => '2022-09-27 10:37:37',
            ),
            8 => 
            array (
                'id' => 9,
                'module_id' => 1,
                'perm_name' => 'Edit_Btn_Table',
                'perm_description' => 'Edit button in Table',
                'active' => 1,
                'created_at' => '2022-09-27 18:08:10',
                'updated_at' => '2022-09-27 18:08:10',
            ),
            9 => 
            array (
                'id' => 10,
                'module_id' => 1,
                'perm_name' => 'View_Btn_Table',
                'perm_description' => 'View Button in Table',
                'active' => 1,
                'created_at' => '2022-09-27 18:08:30',
                'updated_at' => '2022-09-27 18:08:30',
            ),
            10 => 
            array (
                'id' => 11,
                'module_id' => 1,
                'perm_name' => 'Delete_Btn_Table',
                'perm_description' => 'Delete Button in Table',
                'active' => 1,
                'created_at' => '2022-09-27 18:08:43',
                'updated_at' => '2022-09-27 18:08:43',
            ),
            11 => 
            array (
                'id' => 12,
                'module_id' => 2,
                'perm_name' => 'Form Update Priority',
                'perm_description' => 'Form Update Priority',
                'active' => 1,
                'created_at' => '2023-06-19 18:45:02',
                'updated_at' => '2023-06-19 18:45:02',
            ),
            12 => 
            array (
                'id' => 13,
                'module_id' => 2,
                'perm_name' => 'Form Update Ticket',
                'perm_description' => 'Form Update Ticket',
                'active' => 1,
                'created_at' => '2023-06-19 18:45:02',
                'updated_at' => '2023-06-19 18:45:02',
            ),
            13 => 
            array (
                'id' => 14,
                'module_id' => 2,
                'perm_name' => 'Form View Timeline',
                'perm_description' => 'Form View Timeline',
                'active' => 1,
                'created_at' => '2023-06-19 18:45:02',
                'updated_at' => '2023-06-19 18:45:02',
            ),
        ));
        
        
    }
}
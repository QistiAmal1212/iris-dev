<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class ModuleRoleTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('module_role')->delete();
        
        \DB::table('module_role')->insert(array (
            0 => 
            array (
                'id' => 1,
                'module_id' => 1,
                'role_id' => 6,
                'role_description' => 'Hanya isi Tab 1 Section A',
                'active' => 1,
                'created_at' => '2022-09-26 18:19:44',
                'updated_at' => '2022-09-27 18:22:36',
            ),
            1 => 
            array (
                'id' => 2,
                'module_id' => 1,
                'role_id' => 7,
                'role_description' => 'Hanya isi Tab 2 Section A',
                'active' => 1,
                'created_at' => '2022-09-26 18:20:18',
                'updated_at' => '2022-09-27 18:22:41',
            ),
            2 => 
            array (
                'id' => 3,
                'module_id' => 1,
                'role_id' => 8,
                'role_description' => 'Hanya isi Tab 2 Section B',
                'active' => 1,
                'created_at' => '2022-09-26 18:20:42',
                'updated_at' => '2022-09-27 18:22:45',
            ),
            3 => 
            array (
                'id' => 4,
                'module_id' => 2,
                'role_id' => 12,
                'role_description' => 'Module user',
                'active' => 1,
                'created_at' => '2023-06-19 18:45:02',
                'updated_at' => '2023-06-19 18:45:02',
            ),
            4 => 
            array (
                'id' => 5,
                'module_id' => 2,
                'role_id' => 11,
                'role_description' => 'Officer module',
                'active' => 1,
                'created_at' => '2023-06-19 18:45:02',
                'updated_at' => '2023-06-19 18:45:02',
            ),
            5 => 
            array (
                'id' => 6,
                'module_id' => 2,
                'role_id' => 10,
                'role_description' => 'Module vendor',
                'active' => 1,
                'created_at' => '2023-06-19 18:45:02',
                'updated_at' => '2023-06-19 18:45:02',
            ),
        ));
        
        
    }
}
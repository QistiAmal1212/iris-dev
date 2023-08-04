<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class ModuleTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('module')->delete();
        
        \DB::table('module')->insert(array (
            0 => 
            array (
                'id' => 1,
                'module_name' => 'Test Form Module',
                'module_short_name' => 'tf',
                'module_description' => 'for testing purposes',
                'active' => 1,
                'created_at' => '2022-09-26 18:18:44',
                'updated_at' => '2022-09-26 18:18:44',
            ),
            1 => 
            array (
                'id' => 2,
                'module_name' => 'HelpdeskModule',
                'module_short_name' => 'HDM',
                'module_description' => 'Helpdesk FMF Module',
                'active' => 1,
                'created_at' => '2023-06-19 18:45:02',
                'updated_at' => '2023-06-19 18:45:02',
            ),
        ));
        
        
    }
}
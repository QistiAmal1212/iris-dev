<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class TestFormTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('test_form')->delete();
        
        \DB::table('test_form')->insert(array (
            0 => 
            array (
                'created_at' => NULL,
                'id' => 1,
                'module_id' => 1,
                'module_status_id' => 1,
                'updated_at' => NULL,
            ),
            1 => 
            array (
                'created_at' => NULL,
                'id' => 2,
                'module_id' => 1,
                'module_status_id' => 2,
                'updated_at' => NULL,
            ),
            2 => 
            array (
                'created_at' => NULL,
                'id' => 3,
                'module_id' => 1,
                'module_status_id' => 3,
                'updated_at' => NULL,
            ),
            3 => 
            array (
                'created_at' => NULL,
                'id' => 4,
                'module_id' => 1,
                'module_status_id' => 4,
                'updated_at' => NULL,
            ),
        ));
        
        
    }
}
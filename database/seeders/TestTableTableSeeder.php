<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class TestTableTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('test_table')->delete();
        
        \DB::table('test_table')->insert(array (
            0 => 
            array (
                'age' => '24',
                'created_at' => '2022-11-22 16:25:57',
                'gender' => 'Lelaki',
                'id' => 1,
                'name' => 'Naruto',
                'updated_at' => '2022-11-22 17:12:29',
            ),
            1 => 
            array (
                'age' => '34',
                'created_at' => '2022-11-22 16:25:57',
                'gender' => 'Lelaki',
                'id' => 2,
                'name' => 'Ichigo',
                'updated_at' => '2022-11-22 16:25:59',
            ),
            2 => 
            array (
                'age' => '01',
                'created_at' => '2022-11-22 16:25:57',
                'gender' => 'Lelaki',
                'id' => 3,
                'name' => 'Hagemaru',
                'updated_at' => '2022-11-22 16:25:59',
            ),
            3 => 
            array (
                'age' => '15',
                'created_at' => '2022-11-22 16:25:57',
                'gender' => 'Perempuan',
                'id' => 4,
                'name' => 'Shizuka',
                'updated_at' => '2022-11-22 16:25:57',
            ),
        ));
        
        
    }
}
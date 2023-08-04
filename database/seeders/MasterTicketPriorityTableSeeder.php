<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class MasterTicketPriorityTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('master_ticket_priority')->delete();
        
        \DB::table('master_ticket_priority')->insert(array (
            0 => 
            array (
                'color' => 'red',
                'created_at' => '2022-11-16 08:07:02',
                'id' => 1,
                'max_hour' => 4,
                'priority_description' => 'Level 1 - Critical',
                'priority_name' => 'Level 1 - Critical',
                'updated_at' => '2022-11-16 08:07:03',
            ),
            1 => 
            array (
                'color' => 'orange',
                'created_at' => '2022-11-16 08:07:02',
                'id' => 2,
                'max_hour' => 24,
                'priority_description' => 'Level 2 - Serious',
                'priority_name' => 'Level 2 - Serious',
                'updated_at' => '2022-11-16 08:07:03',
            ),
            2 => 
            array (
                'color' => 'yellow',
                'created_at' => '2022-11-16 08:07:02',
                'id' => 3,
                'max_hour' => 48,
                'priority_description' => 'Level 3 - Moderate',
                'priority_name' => 'Level 3 - Moderate',
                'updated_at' => '2022-11-16 08:07:03',
            ),
        ));
        
        
    }
}
<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MasterInboxStatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \DB::table('master_inbox_status')->delete();
        
        DB::table('master_inbox_status')->insert([
            'name' => 'Draf',
        ]);

        DB::table('master_inbox_status')->insert([
            'name' => 'Telah Dihantar',
        ]);

        DB::table('master_inbox_status')->insert([
            'name' => 'Telah Dibaca',
        ]);
    }
}

<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MasterAnnouncementTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \DB::table('master_announcement_type')->delete();

        DB::table('master_announcement_type')->insert([
            'name' => 'Penting',
            'label' => 'warning'
        ]);

        DB::table('master_announcement_type')->insert([
            'name' => 'Segera',
            'label' => 'danger'
        ]);

        DB::table('master_announcement_type')->insert([
            'name' => 'Maklumat',
            'label' => 'info'
        ]);
    }
}

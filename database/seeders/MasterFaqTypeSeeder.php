<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MasterFaqTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \DB::table('master_faq_type')->delete();

        DB::table('master_faq_type')->insert([
            'name' => 'Umum',
        ]);

        DB::table('master_faq_type')->insert([
            'name' => 'Akaun',
        ]);

        DB::table('master_faq_type')->insert([
            'name' => 'Sulit & Persendirian',
        ]);

        DB::table('master_faq_type')->insert([
            'name' => 'Proses',
        ]);
    }
}

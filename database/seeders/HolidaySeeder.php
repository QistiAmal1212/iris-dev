<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class HolidaySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \DB::table('holiday')->delete();
        
        DB::table('holiday')->insert([
            'name' => 'Hari Pekerja',
            'holiday_type_id' => 3,
            'start_date' => Carbon::create(date('Y'), 5, 1),
            'duration' => 1,
            'created_by_user_id' => 1,
        ]);

        DB::table('holiday')->insert([
            'name' => 'Hari Wesak',
            'holiday_type_id' => 4,
            'start_date' => Carbon::create(date('Y'), 5, 29),
            'duration' => 1,
            'created_by_user_id' => 1,
        ]);

        DB::table('holiday')->insert([
            'name' => 'Hari Kebangsaan',
            'holiday_type_id' => 8,
            'start_date' => Carbon::create(date('Y'), 8, 31),
            'duration' => 1,
            'created_by_user_id' => 1,
        ]);

        DB::table('holiday')->insert([
            'name' => 'Hari Malaysia',
            'holiday_type_id' => 10,
            'start_date' => Carbon::create(date('Y'), 9, 16),
            'duration' => 1,
            'created_by_user_id' => 1,
        ]);

        DB::table('holiday')->insert([
            'name' => 'Hari Krismas',
            'holiday_type_id' => 12,
            'start_date' => Carbon::create(date('Y'), 12, 25),
            'duration' => 1,
            'created_by_user_id' => 1,
        ]);
    }
}

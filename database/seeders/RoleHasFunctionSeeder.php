<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class RoleHasFunctionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        \DB::table('role_has_function')->delete();

        \DB::table('role_has_function')->insert(array (
            0 =>
            array (
                'role_id' => 1,
                'function_id' => 1,
            ),
            1 =>
            array (
                'role_id' => 1,
                'function_id' => 2,
            ),
            2 =>
            array (
                'role_id' => 1,
                'function_id' => 3,
            ),
            3 =>
            array (
                'role_id' => 1,
                'function_id' => 4,
            ),
            4 =>
            array (
                'role_id' => 1,
                'function_id' => 5,
            ),
            5 =>
            array (
                'role_id' => 1,
                'function_id' => 6,
            ),
            6 =>
            array (
                'role_id' => 1,
                'function_id' => 7,
            ),
            7 =>
            array (
                'role_id' => 1,
                'function_id' => 8,
            ),
        ));
    }
}

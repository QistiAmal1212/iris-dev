<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class UserHasRoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        \DB::table('user_has_roles')->delete();
        
        \DB::table('user_has_roles')->insert(array (
            0 => 
            array (
                'role_id' => 1,
                'user_id' => 1,
            ),
            1 => 
            array (
                'role_id' => 2,
                'user_id' => 2,
            ),
            2 => 
            array (
                'role_id' => 2,
                'user_id' => 11,
            ),
            3 => 
            array (
                'role_id' => 2,
                'user_id' => 12,
            ),
            4 => 
            array (
                'role_id' => 2,
                'user_id' => 13,
            ),
            5 => 
            array (
                'role_id' => 2,
                'user_id' => 14,
            ),
            6 => 
            array (
                'role_id' => 2,
                'user_id' => 15,
            ),
            7 => 
            array (
                'role_id' => 2,
                'user_id' => 16,
            ),
            8 => 
            array (
                'role_id' => 2,
                'user_id' => 17,
            ),
            7 => 
            array (
                'role_id' => 2,
                'user_id' => 18,
            ),
            8 => 
            array (
                'role_id' => 2,
                'user_id' => 19,
            ),
            9 => 
            array (
                'role_id' => 2,
                'user_id' => 20,
            ),
            10 => 
            array (
                'role_id' => 2,
                'user_id' => 21,
            ),
            11 => 
            array (
                'role_id' => 2,
                'user_id' => 22,
            ),
            12 => 
            array (
                'role_id' => 2,
                'user_id' => 23,
            ),
            13 => 
            array (
                'role_id' => 2,
                'user_id' => 24,
            ),
            14 => 
            array (
                'role_id' => 2,
                'user_id' => 25,
            ),
            15 => 
            array (
                'role_id' => 2,
                'user_id' => 26,
            ),
            16 => 
            array (
                'role_id' => 2,
                'user_id' => 27,
            ),
            17 => 
            array (
                'role_id' => 2,
                'user_id' => 28,
            ),
            18 => 
            array (
                'role_id' => 2,
                'user_id' => 29,
            ),
            19 => 
            array (
                'role_id' => 2,
                'user_id' => 30,
            ),
            20 => 
            array (
                'role_id' => 2,
                'user_id' => 31,
            ),
            21 => 
            array (
                'role_id' => 2,
                'user_id' => 32,
            ),
            22 => 
            array (
                'role_id' => 2,
                'user_id' => 33,
            ),
            23 => 
            array (
                'role_id' => 2,
                'user_id' => 34,
            ),
        ));
    }
}

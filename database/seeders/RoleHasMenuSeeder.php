<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class RoleHasMenuSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        \DB::table('role_has_menu')->delete();

        \DB::table('role_has_menu')->insert(array (
            0 =>
            array (
                'role_id' => 1,
                'menu_id' => 1,
                'access' => true,
                'search' => true,
                'add' => true,
                'update' => true,
                'delete' => true,
                'report' => true,
            ),
            1 =>
            array (
                'role_id' => 1,
                'menu_id' => 2,
                'access' => true,
                'search' => true,
                'add' => true,
                'update' => true,
                'delete' => true,
                'report' => true,
            ),
            2 =>
            array (
                'role_id' => 1,
                'menu_id' => 3,
                'access' => true,
                'search' => true,
                'add' => true,
                'update' => true,
                'delete' => true,
                'report' => true,
            ),
            3 =>
            array (
                'role_id' => 1,
                'menu_id' => 4,
                'access' => true,
                'search' => true,
                'add' => true,
                'update' => true,
                'delete' => true,
                'report' => true,
            ),
            4 =>
            array (
                'role_id' => 1,
                'menu_id' => 5,
                'access' => true,
                'search' => true,
                'add' => true,
                'update' => true,
                'delete' => true,
                'report' => true,
            ),
            5 =>
            array (
                'role_id' => 1,
                'menu_id' => 6,
                'access' => true,
                'search' => true,
                'add' => true,
                'update' => true,
                'delete' => true,
                'report' => true,
            ),
            6 =>
            array (
                'role_id' => 1,
                'menu_id' => 7,
                'access' => true,
                'search' => true,
                'add' => true,
                'update' => true,
                'delete' => true,
                'report' => true,
            ),
            7 =>
            array (
                'role_id' => 1,
                'menu_id' => 8,
                'access' => true,
                'search' => true,
                'add' => true,
                'update' => true,
                'delete' => true,
                'report' => true,
            ),
            8 =>
            array (
                'role_id' => 1,
                'menu_id' => 9,
                'access' => true,
                'search' => true,
                'add' => true,
                'update' => true,
                'delete' => true,
                'report' => true,
            ),
            9 =>
            array (
                'role_id' => 1,
                'menu_id' => 10,
                'access' => true,
                'search' => true,
                'add' => true,
                'update' => true,
                'delete' => true,
                'report' => true,
            ),
            10 =>
            array (
                'role_id' => 1,
                'menu_id' => 11,
                'access' => true,
                'search' => true,
                'add' => true,
                'update' => true,
                'delete' => true,
                'report' => true,
            ),
        ));
    }
}

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
                'add' => true,
                'update' => true,
                'delete' => true,
            ),
            1 =>
            array (
                'role_id' => 1,
                'menu_id' => 2,
                'add' => true,
                'update' => true,
                'delete' => true,
            ),
            2 =>
            array (
                'role_id' => 1,
                'menu_id' => 3,
                'add' => true,
                'update' => true,
                'delete' => true,
            ),
            3 =>
            array (
                'role_id' => 1,
                'menu_id' => 4,
                'add' => true,
                'update' => true,
                'delete' => true,
            ),
            4 =>
            array (
                'role_id' => 1,
                'menu_id' => 5,
                'add' => true,
                'update' => true,
                'delete' => true,
            ),
            5 =>
            array (
                'role_id' => 1,
                'menu_id' => 6,
                'add' => true,
                'update' => true,
                'delete' => true,
            ),
            6 =>
            array (
                'role_id' => 1,
                'menu_id' => 7,
                'add' => true,
                'update' => true,
                'delete' => true,
            ),
            7 =>
            array (
                'role_id' => 1,
                'menu_id' => 8,
                'add' => true,
                'update' => true,
                'delete' => true,
            ),
            8 =>
            array (
                'role_id' => 1,
                'menu_id' => 9,
                'add' => true,
                'update' => true,
                'delete' => true,
            ),
            9 =>
            array (
                'role_id' => 1,
                'menu_id' => 10,
                'add' => true,
                'update' => true,
                'delete' => true,
            ),
            10 =>
            array (
                'role_id' => 1,
                'menu_id' => 11,
                'add' => true,
                'update' => true,
                'delete' => true,
            ),
            11 =>
            array (
                'role_id' => 1,
                'menu_id' => 12,
                'add' => true,
                'update' => true,
                'delete' => true,
            ),
            12 =>
            array (
                'role_id' => 1,
                'menu_id' => 13,
                'add' => true,
                'update' => true,
                'delete' => true,
            ),
            13 =>
            array (
                'role_id' => 1,
                'menu_id' => 14,
                'add' => true,
                'update' => true,
                'delete' => true,
            ),
            14 =>
            array (
                'role_id' => 1,
                'menu_id' => 15,
                'add' => true,
                'update' => true,
                'delete' => true,
            ),
            15 =>
            array (
                'role_id' => 1,
                'menu_id' => 16,
                'add' => true,
                'update' => true,
                'delete' => true,
            ),
            16 =>
            array (
                'role_id' => 1,
                'menu_id' => 17,
                'add' => true,
                'update' => true,
                'delete' => true,
            ),
            17 =>
            array (
                'role_id' => 1,
                'menu_id' => 18,
                'add' => true,
                'update' => true,
                'delete' => true,
            ),
            18 =>
            array (
                'role_id' => 1,
                'menu_id' => 19,
                'add' => true,
                'update' => true,
                'delete' => true,
            ),
            19 =>
            array (
                'role_id' => 1,
                'menu_id' => 20,
                'add' => true,
                'update' => true,
                'delete' => true,
            ),
            20 =>
            array (
                'role_id' => 1,
                'menu_id' => 21,
                'add' => true,
                'update' => true,
                'delete' => true,
            ),
            21 =>
            array (
                'role_id' => 1,
                'menu_id' => 22,
                'add' => true,
                'update' => true,
                'delete' => true,
            ),
            22 =>
            array (
                'role_id' => 1,
                'menu_id' => 23,
                'add' => true,
                'update' => true,
                'delete' => true,
            ),
        ));
    }
}

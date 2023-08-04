<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class SettingsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        \DB::table('settings')->delete();

        \DB::table('settings')->insert(array (
            0 =>
            array (
                'id' => 1,
                'key' => 'system_name',
                'value' => 'Quickstart',
                'created_at' => NULL,
                'updated_at' => '2022-07-09 00:09:16',
            ),
            1 =>
            array (
                'id' => 2,
                'key' => 'background_login_page',
                'value' => 'images/pages/content-img-4.jpg',
                'created_at' => NULL,
                'updated_at' => '2022-07-08 18:42:20',
            ),
            2 =>
            array (
                'id' => 3,
                'key' => 'logo_header',
                'value' => 'images/logo/logo-icon.png',
                'created_at' => NULL,
                'updated_at' => '2022-07-09 00:00:16',
            ),
            3 =>
            array (
                'id' => 4,
                'key' => 'favicon',
                'value' => 'images/logo/favicon-32x32.png',
                'created_at' => NULL,
                'updated_at' => '2022-07-09 00:00:16',
            ),
            4 =>
            array (
                'id' => 5,
                'key' => 'copyright',
                'value' => '2022 © Quickstart Unijaya',
                'created_at' => NULL,
                'updated_at' => '2022-07-09 00:09:16',
            ),
        ));


    }
}

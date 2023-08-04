<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class MasterMonthTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        \DB::table('master_month')->delete();

        \DB::table('master_month')->insert(array (
            0 =>
            array (
                'id' => 1,
                'name' => 'Januari',
                'name_en' => 'January',
                'code' => 'Jan',
                'created_at' => '2019-09-19 13:03:31',
            ),
            1 =>
            array (
                'id' => 2,
                'name' => 'Februari',
                'name_en' => 'February',
                'code' => 'Feb',
                'created_at' => '2019-09-19 13:03:31',
            ),
            2 =>
            array (
                'id' => 3,
                'name' => 'Mac',
                'name_en' => 'March',
                'code' => 'Mac',
                'created_at' => '2019-09-19 13:03:31',
            ),
            3 =>
            array (
                'id' => 4,
                'name' => 'April',
                'name_en' => 'April',
                'code' => 'Apr',
                'created_at' => '2019-09-19 13:03:31',
            ),
            4 =>
            array (
                'id' => 5,
                'name' => 'Mei',
                'name_en' => 'May',
                'code' => 'Mei',
                'created_at' => '2019-09-19 13:03:31',
            ),
            5 =>
            array (
                'id' => 6,
                'name' => 'Jun',
                'name_en' => 'June',
                'code' => 'Jun',
                'created_at' => '2019-09-19 13:03:31',
            ),
            6 =>
            array (
                'id' => 7,
                'name' => 'Julai',
                'name_en' => 'July',
                'code' => 'Jul',
                'created_at' => '2019-09-19 13:03:31',
            ),
            7 =>
            array (
                'id' => 8,
                'name' => 'Ogos',
                'name_en' => 'August',
                'code' => 'Ogo',
                'created_at' => '2019-09-19 13:03:31',
            ),
            8 =>
            array (
                'id' => 9,
                'name' => 'September',
                'name_en' => 'September',
                'code' => 'Sep',
                'created_at' => '2019-09-19 13:03:31',
            ),
            9 =>
            array (
                'id' => 10,
                'name' => 'Oktober',
                'name_en' => 'October',
                'code' => 'Okt',
                'created_at' => '2019-09-19 13:03:31',
            ),
            10 =>
            array (
                'id' => 11,
                'name' => 'November',
                'name_en' => 'November',
                'code' => 'Nov',
                'created_at' => '2019-09-19 13:03:31',
            ),
            11 =>
            array (
                'id' => 12,
                'name' => 'Disember',
                'name_en' => 'December',
                'code' => 'Dis',
                'created_at' => '2019-09-19 13:03:31',
            ),
        ));


    }
}

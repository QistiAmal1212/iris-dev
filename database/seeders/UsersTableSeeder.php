<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('users')->delete();
        
        \DB::table('users')->insert(array (
            0 =>
            array(
                'avatar' => null,
                'avatar_original' => null,
                'created_at' => '2022-03-22 10:29:10',
                'email' => 'superadmin@yopmail.com',
                'email_verified_at' => null,
                'google_id' => null,
                'id' => 1,
                'is_active' => 1,
                'name' => 'Super Admin',
                'no_ic' => null,
                'password' => '$2y$10$9SSXgaeN2XUSzLwu05jl8ucpB0i/By3hWxzeKBq7xOfzHr/xkNDum',
                'remember_token' => 'EJLwn2Fw6ClfgxJv1TdwjEF5MJsZVS2KNO8yzPFMOsI0MjQbk7lVmy5nBfNU',
                'signature' => null,
                'updated_at' => '2022-07-22 18:41:20',
            ),
            1 =>
            array(
                'avatar' => null,
                'avatar_original' => null,
                'created_at' => '2022-03-22 10:29:10',
                'email' => 'admin@yopmail.com',
                'email_verified_at' => null,
                'google_id' => null,
                'id' => 2,
                'is_active' => 1,
                'name' => 'Admin',
                'no_ic' => null,
                'password' => '$2y$10$9SSXgaeN2XUSzLwu05jl8ucpB0i/By3hWxzeKBq7xOfzHr/xkNDum',
                'remember_token' => null,
                'signature' => null,
                'updated_at' => '2022-03-23 07:19:13',
            ),
            2 =>
            array(
                'avatar' => null,
                'avatar_original' => null,
                'created_at' => null,
                'email' => 'aisyah_rahman@yopmail.com',
                'email_verified_at' => null,
                'google_id' => null,
                'id' => 11,
                'is_active' => 1,
                'name' => 'Aishah Rahman',
                'no_ic' => null,
                'password' => '$2y$10$CxwKdgNVt6ANw7.48U/lW.JBhvIeavimywR8Xwpzc.FvhN6M6AZfu',
                'remember_token' => null,
                'signature' => null,
                'updated_at' => '2022-07-14 12:32:10',
            ),
            3 =>
            array(
                'avatar' => null,
                'avatar_original' => null,
                'created_at' => null,
                'email' => 'siti_ahmad@yopmail.com',
                'email_verified_at' => null,
                'google_id' => null,
                'id' => 12,
                'is_active' => 1,
                'name' => 'Siti Ahmad',
                'no_ic' => null,
                'password' => '$2y$10$W62MgLXNh0TOKAyc/nhtZee5x2i89p8HZG5U7q2XSjir8yfPlhZIC',
                'remember_token' => null,
                'signature' => null,
                'updated_at' => '2022-07-14 12:33:18',
            ),
            4 =>
            array(
                'avatar' => null,
                'avatar_original' => null,
                'created_at' => null,
                'email' => 'diana_danielle@yopmail.com',
                'email_verified_at' => null,
                'google_id' => null,
                'id' => 13,
                'is_active' => 1,
                'name' => 'Diana Danielle',
                'no_ic' => null,
                'password' => '$2y$10$UsC4CC/muiB3Bud421tOueKnJtCTe6ZyBoHMUG/Bh3YpZzJ.6PWfq',
                'remember_token' => null,
                'signature' => null,
                'updated_at' => '2022-07-14 12:35:52',
            ),
            5 =>
            array(
                'avatar' => null,
                'avatar_original' => null,
                'created_at' => null,
                'email' => 'nurul_alisah@yopmail.com',
                'email_verified_at' => null,
                'google_id' => null,
                'id' => 14,
                'is_active' => 1,
                'name' => 'Nurul Alisah',
                'no_ic' => null,
                'password' => '$2y$10$rznON67HtU9997e82xx5QuezRgtni1tVKJf3zwN/a/CNr.vqbvZr6',
                'remember_token' => '3zoEzuTxCXTuBO2uyElaJPj4G979Zf6EgIODaa59U29shtUZQna8kYReoGGX',
                'signature' => null,
                'updated_at' => '2022-07-14 12:35:40',
            ),
            6 =>
            array(
                'avatar' => null,
                'avatar_original' => null,
                'created_at' => null,
                'email' => 'puteri_liyana@yopmail.com',
                'email_verified_at' => null,
                'google_id' => null,
                'id' => 15,
                'is_active' => 1,
                'name' => 'Puteri Liyana',
                'no_ic' => null,
                'password' => '$2y$10$vUAYNBQ73H7N5jxGng4XJu.cjSBr4TB7.k6u2Ha1YIFqBWPggXFHi',
                'remember_token' => null,
                'signature' => null,
                'updated_at' => '2022-07-14 12:35:30',
            ),
            7 =>
            array(
                'avatar' => null,
                'avatar_original' => null,
                'created_at' => null,
                'email' => 'fatimah_azzahra@yopmail.com',
                'email_verified_at' => null,
                'google_id' => null,
                'id' => 16,
                'is_active' => 1,
                'name' => 'Fatimah Azzahra',
                'no_ic' => null,
                'password' => '$2y$10$BP2LbT5SQvjrrtn5qCVE6.IDuRy9XCHkp8nej8ePegOj9USqCQUc2',
                'remember_token' => null,
                'signature' => null,
                'updated_at' => '2022-07-14 12:46:10',
            ),
            8 =>
            array(
                'avatar' => null,
                'avatar_original' => null,
                'created_at' => null,
                'email' => 'khadija_ismail@yopmail.com',
                'email_verified_at' => null,
                'google_id' => null,
                'id' => 17,
                'is_active' => 1,
                'name' => 'Khadijah Ismail',
                'no_ic' => null,
                'password' => '$2y$10$Z2a/vS3jatwaWIS9Y2yNo.ZhkLNyeI0rHCOyvhFaJT/R.mVM/DpU.',
                'remember_token' => null,
                'signature' => null,
                'updated_at' => '2022-07-14 12:45:56',
            ),
            9 =>
            array(
                'avatar' => null,
                'avatar_original' => null,
                'created_at' => null,
                'email' => 'alya_sabrina@yopmail.com',
                'email_verified_at' => null,
                'google_id' => null,
                'id' => 18,
                'is_active' => 1,
                'name' => 'Alya Sabrina',
                'no_ic' => null,
                'password' => '$2y$10$ynR.4lpBfBH6jTYwAjZz2enLmEhXvXoLcF4lyCAS97kqZZQyzEXfO',
                'remember_token' => '3a9QLvBI83x6PgqHDYtS5cgg2qxbiVKcvbMPxGQUEVjzaX8DxAjYr054IiOi',
                'signature' => null,
                'updated_at' => '2022-07-14 12:47:47',
            ),
            10 =>
            array(
                'avatar' => null,
                'avatar_original' => null,
                'created_at' => null,
                'email' => 'aiman_hakim@yopmail.com',
                'email_verified_at' => null,
                'google_id' => null,
                'id' => 19,
                'is_active' => 1,
                'name' => 'Aiman Hakim',
                'no_ic' => null,
                'password' => '$2y$10$5R9qEzbp/GrQhiLpIrqDU.ONImBqxkMM0gsC4R9pPIUhtkU6t6GNO',
                'remember_token' => null,
                'signature' => null,
                'updated_at' => '2022-07-29 12:03:32',
            ),
            11 =>
            array(
                'avatar' => null,
                'avatar_original' => null,
                'created_at' => null,
                'email' => 'sharifah_aisyah@yopmail.com',
                'email_verified_at' => null,
                'google_id' => null,
                'id' => 20,
                'is_active' => 1,
                'name' => 'Sharifah Aisyah',
                'no_ic' => null,
                'password' => '$2y$10$hQRwmI57I8fHmkoDKa3KR.vXGy0cTLzwXYxcrbFLftG6cJclQUo9m',
                'remember_token' => null,
                'signature' => null,
                'updated_at' => '2022-07-14 12:48:14',
            ),
            12 =>
            array(
                'avatar' => null,
                'avatar_original' => null,
                'created_at' => null,
                'email' => 'syafiq_salleh@yopmail.com',
                'email_verified_at' => null,
                'google_id' => null,
                'id' => 21,
                'is_active' => 1,
                'name' => 'Syafiq Salleh',
                'no_ic' => null,
                'password' => '$2y$10$DfRL6JVs.WTqwzbnlFnil.A/8BNsAnNP4q1sqHWCfAJJOyyGAUNe2',
                'remember_token' => null,
                'signature' => null,
                'updated_at' => '2022-07-14 12:48:31',
            ),
            13 =>
            array(
                'avatar' => null,
                'avatar_original' => null,
                'created_at' => null,
                'email' => 'nur_hamizah@yopmail.com',
                'email_verified_at' => null,
                'google_id' => null,
                'id' => 22,
                'is_active' => 1,
                'name' => 'Nur Hamizah',
                'no_ic' => null,
                'password' => '$2y$10$ketD61sEOiCg9DeKlbfA7ujEAqWLTSrVCEbbcz91YF.kezmcRvfFK',
                'remember_token' => null,
                'signature' => null,
                'updated_at' => '2022-07-14 12:49:03',
            ),
            14 =>
            array(
                'avatar' => null,
                'avatar_original' => null,
                'created_at' => null,
                'email' => 'adi_yusoff@yopmail.com',
                'email_verified_at' => null,
                'google_id' => null,
                'id' => 23,
                'is_active' => 1,
                'name' => 'Adi Yusoff',
                'no_ic' => null,
                'password' => '$2y$10$cLTh3pJZLM1GUkPVHi52EevAMCtmc40BVOMwYRwqRBChL258JGP9O',
                'remember_token' => null,
                'signature' => null,
                'updated_at' => '2022-07-14 12:49:19',
            ),
            15 =>
            array(
                'avatar' => null,
                'avatar_original' => null,
                'created_at' => null,
                'email' => 'amir_hamzah@yopmail.com',
                'email_verified_at' => null,
                'google_id' => null,
                'id' => 24,
                'is_active' => 0,
                'name' => 'Amir Hamzah',
                'no_ic' => null,
                'password' => '$2y$10$9SSXgaeN2XUSzLwu05jl8ucpB0i/By3hWxzeKBq7xOfzHr/xkNDum',
                'remember_token' => null,
                'signature' => null,
                'updated_at' => '2022-07-13 19:27:41',
            ),
            16 =>
            array(
                'avatar' => null,
                'avatar_original' => null,
                'created_at' => null,
                'email' => 'safawi_rashid@yopmail.com',
                'email_verified_at' => null,
                'google_id' => null,
                'id' => 25,
                'is_active' => 1,
                'name' => 'Safawi Rashid',
                'no_ic' => null,
                'password' => '$2y$10$6e8X3QzX/xUcJqt4nrWSxurmrD8578ttvYQfLa36yyQS5BlHbV0BW',
                'remember_token' => null,
                'signature' => null,
                'updated_at' => '2022-07-14 12:49:32',
            ),
            17 =>
            array(
                'avatar' => null,
                'avatar_original' => null,
                'created_at' => null,
                'email' => 'ahmad_khairudin@yopmail.com',
                'email_verified_at' => null,
                'google_id' => null,
                'id' => 26,
                'is_active' => 1,
                'name' => 'Ahmad Khairudin',
                'no_ic' => null,
                'password' => '$2y$10$gTboiUHEeB.yhvvhU78pwuZxEh4HZjBMfE5SPuhgIzLpVvMPFucEa',
                'remember_token' => 'Mcaf9wlZvdV5oZjd0ZB4AA2RBycgUUAKBRB55TZ5Z1RlbOez517X7OdfvnMf',
                'signature' => null,
                'updated_at' => '2022-07-14 12:49:46',
            ),
            18 =>
            array(
                'avatar' => null,
                'avatar_original' => null,
                'created_at' => null,
                'email' => 'siti_syahirah@yopmail.com',
                'email_verified_at' => null,
                'google_id' => null,
                'id' => 27,
                'is_active' => 1,
                'name' => 'Siti Syahirah',
                'no_ic' => null,
                'password' => '$2y$10$ctuM6skMMFX/bhlcOPrY.O1nQWC/3DUeb0ThEZDghldqbYDj/otVC',
                'remember_token' => null,
                'signature' => null,
                'updated_at' => '2022-07-14 12:50:10',
            ),
            19 =>
            array(
                'avatar' => null,
                'avatar_original' => null,
                'created_at' => null,
                'email' => 'sofea_afrina@yopmail.com',
                'email_verified_at' => null,
                'google_id' => null,
                'id' => 28,
                'is_active' => 1,
                'name' => 'Sofea Afrina',
                'no_ic' => null,
                'password' => '$2y$10$O2ak0M5sbaRlZNHL6cQoJ.W2Iog3v4YgyQAT4NNNKug.XZSv9QthW',
                'remember_token' => null,
                'signature' => null,
                'updated_at' => '2022-07-14 14:14:27',
            ),
            20 =>
            array(
                'avatar' => null,
                'avatar_original' => null,
                'created_at' => null,
                'email' => 'dellina_nabilla@yopmail.com',
                'email_verified_at' => null,
                'google_id' => null,
                'id' => 29,
                'is_active' => 1,
                'name' => 'Dellina Nabila',
                'no_ic' => null,
                'password' => '$2y$10$ub0NFj6JY0Osqv/TQ5926.w7n7u.a6oSEPgx0VK7lbM7AyhznGigC',
                'remember_token' => null,
                'signature' => null,
                'updated_at' => '2022-07-14 14:14:46',
            ),
            21 =>
            array(
                'avatar' => null,
                'avatar_original' => null,
                'created_at' => null,
                'email' => 'syafiq_ahmad@yopmail.com',
                'email_verified_at' => null,
                'google_id' => null,
                'id' => 30,
                'is_active' => 1,
                'name' => 'Syafiq Ahmad',
                'no_ic' => null,
                'password' => '$2y$10$f8BQzPmVlKKw0Mx8VEB91eQhmVkllFr99JGKNvItAqZHyew60oNHq',
                'remember_token' => null,
                'signature' => null,
                'updated_at' => '2022-07-14 14:15:08',
            ),
            22 =>
            array(
                'avatar' => null,
                'avatar_original' => null,
                'created_at' => null,
                'email' => 'farid_kamil@yopmail.com',
                'email_verified_at' => null,
                'google_id' => null,
                'id' => 31,
                'is_active' => 1,
                'name' => 'Farid Kamil',
                'no_ic' => null,
                'password' => '$2y$10$aiQMs/usqkxV5g.F/Oltu.sfy/1n4fu.kQnfQy4OdxYvNILR8F3hK',
                'remember_token' => 'rphv948Ghad506oipUxmX4AW9lI8M78bdnPzEAdPW3nUdZFLKyYspxEj8goj',
                'signature' => null,
                'updated_at' => '2022-07-14 14:15:26',
            ),
            23 =>
            array(
                'avatar' => null,
                'avatar_original' => null,
                'created_at' => '2022-07-07 21:26:29',
                'email' => 'nelydia_senrose@yopmail.com',
                'email_verified_at' => null,
                'google_id' => null,
                'id' => 32,
                'is_active' => 1,
                'name' => 'Nelydia Senrose',
                'no_ic' => null,
                'password' => '$2y$10$FT0jiy9HWwJFtOX4xPW0ounPE5C.cdvREyYymPynuZbMgcWmtuEjy',
                'remember_token' => null,
                'signature' => null,
                'updated_at' => '2022-07-07 21:26:29',
            ),
            24 => 
            array (
                'avatar' => NULL,
                'avatar_original' => NULL,
                'created_at' => NULL,
                'email' => 'pl1@gmail.com',
                'email_verified_at' => NULL,
                'google_id' => NULL,
                'id' => 33,
                'is_active' => 1,
                'name' => 'Test Pengguna Luar 1',
                'no_ic' => '123123123123',
                'password' => '$2a$12$CXzdGmTGiGF.7NURatRG1OKd/4gRKxUSZT1NwEW8i3xx4crVSpdnC',
                'remember_token' => NULL,
                'signature' => NULL,
                'updated_at' => '2022-09-27 18:32:44',
            ),
            25 => 
            array (
                'avatar' => NULL,
                'avatar_original' => NULL,
                'created_at' => NULL,
                'email' => 'pl2@gmail.com',
                'email_verified_at' => NULL,
                'google_id' => NULL,
                'id' => 35,
                'is_active' => 1,
                'name' => 'Test Pengguna Luar 2',
                'no_ic' => '213213123123',
                'password' => '$2a$12$CXzdGmTGiGF.7NURatRG1OKd/4gRKxUSZT1NwEW8i3xx4crVSpdnC',
                'remember_token' => NULL,
                'signature' => NULL,
                'updated_at' => '2022-09-27 18:34:41',
            ),
            26 => 
            array (
                'avatar' => NULL,
                'avatar_original' => NULL,
                'created_at' => NULL,
                'email' => 'admintest@gmail.com',
                'email_verified_at' => NULL,
                'google_id' => NULL,
                'id' => 36,
                'is_active' => 1,
                'name' => 'Admin',
                'no_ic' => '453534534534',
                'password' => '$2a$12$CXzdGmTGiGF.7NURatRG1OKd/4gRKxUSZT1NwEW8i3xx4crVSpdnC',
                'remember_token' => NULL,
                'signature' => NULL,
                'updated_at' => '2022-09-27 18:35:08',
            ),
            27 => 
            array (
                'avatar' => NULL,
                'avatar_original' => NULL,
                'created_at' => '2023-05-23 14:58:35',
                'email' => 'hv@gmail.com',
                'email_verified_at' => NULL,
                'google_id' => NULL,
                'id' => 37,
                'is_active' => 1,
                'name' => 'Helpdesk Vendor',
                'no_ic' => '123456789012',
                'password' => '$2y$10$kFJISMkBXupwJYytZ7rR4OCwFvIHaKrnMS9OolTFuexrefJC3FRJS',
                'remember_token' => NULL,
                'signature' => NULL,
                'updated_at' => '2023-05-23 15:01:15',
            ),
            28 => 
            array (
                'avatar' => NULL,
                'avatar_original' => NULL,
                'created_at' => '2023-05-23 14:59:35',
                'email' => 'hp_btm@gmail.com',
                'email_verified_at' => NULL,
                'google_id' => NULL,
                'id' => 38,
                'is_active' => 1,
                'name' => 'Pegawai BTM',
                'no_ic' => '123456789012',
                'password' => '$2y$10$IWYoq7kpindG91bWFotNFO7HOhwcdlmXLyvGEJshUUYtwpcUmjPxy',
                'remember_token' => NULL,
                'signature' => NULL,
                'updated_at' => '2023-05-23 15:00:31',
            ),
        ));
        
        
    }
}
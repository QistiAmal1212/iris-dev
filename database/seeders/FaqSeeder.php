<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class FaqSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \DB::table('faq')->delete();

        DB::table('faq')->insert([
            'question' => 'Cara pendaftaran akaun',
            'answer' => 'Pendaftaran akaun boleh dibuat dengan klik pada butang Pengguna Baru, masukkan maklumat pengguna yang ingin berdaftar dan klik Hantar',
            'faq_type_id' => 1,
        ]);
        DB::table('faq')->insert([
            'question' => 'How to register an account',
            'answer' => 'Account registration can be applied by clicking on the New Registration button, enter all the required fields and click Register',
            'lang' => 'en',
            'faq_type_id' => 1,
        ]);

        DB::table('faq')->insert([
            'question' => 'Cara penukaran kata laluan',
            'answer' => 'Kata laluan boleh ditukar dengan pergi ke Profile di belah kanan atas screen dan klik pada Kemaskini Kata Laluan',
            'faq_type_id' => 1,
        ]);
        DB::table('faq')->insert([
            'question' => 'How to change password',
            'answer' => 'Password can be changed by navigating to Profile icon on the top right corner of the screen and click Change Password',
            'lang' => 'en',
            'faq_type_id' => 1,
        ]);

        DB::table('faq')->insert([
            'question' => 'Cara kemaskini tetapan akaun',
            'answer' => 'Pergi pada Profile untuk mengemaskini tetapan akaun',
            'faq_type_id' => 2,
        ]);
        DB::table('faq')->insert([
            'question' => 'How to update account settings',
            'answer' => 'Navigate to the profile page to update your settings',
            'lang' => 'en',
            'faq_type_id' => 2,
        ]);

        DB::table('faq')->insert([
            'question' => 'Terlupa kata laluan',
            'answer' => 'Sekiranya anda terlupa kata laluan dan tidak boleh log masuk ke dalam sistem, Sila klik pada Forgot Password di skrin log masuk sistem dan ikuti langkah yang tertera',
            'faq_type_id' => 2,
        ]);
        DB::table('faq')->insert([
            'question' => 'Forgot password',
            'answer' => 'In the case when you forgot your password thus cannot log in to the system, please click on the link Forgot Password on the system login screen and kindly follow the instruction given',
            'lang' => 'en',
            'faq_type_id' => 2,
        ]);

        DB::table('faq')->insert([
            'question' => 'Kehilangan data',
            'answer' => 'Sekiranya data anda tidak dapat dipaparkan sila contact system admin di webmaster@getnada.com ',
            'faq_type_id' => 3,
        ]);
        DB::table('faq')->insert([
            'question' => 'Data lost',
            'answer' => 'In the case when your details & information did not appear properly, please contact the system administrator at webmaster@getnada.com',
            'lang' => 'en',
            'faq_type_id' => 3,
        ]);

        DB::table('faq')->insert([
            'question' => 'Berapa lamakah tempoh permohonan untuk selesai diproses',
            'answer' => 'Tempoh selesai proses permohonan adalah diantara 30 sehingga ke 90 hari mengikut hari bekerja',
            'faq_type_id' => 4,
        ]);
        DB::table('faq')->insert([
            'question' => 'How long does it take to complete an application',
            'answer' => 'The period for an application to be processed completely is around 30 to 90 working days',
            'lang' => 'en',
            'faq_type_id' => 4,
        ]);
    }
}

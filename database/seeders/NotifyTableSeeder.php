<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class NotifyTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        DB::table('notify')->delete();

        DB::table('notify')->insert(array (
            0 =>
            array (
                'id' => 1,
                'name' => 'Pendaftaran Pengguna Berjaya',
                'code' => 'PendaftaranPengguna',
            'message' => 'Assalamualaikum dan Salam Sejahtera,<br><br>Pendaftaran pengguna telah berjaya di daftarkan dan gunakan ID Pengguna dibawah untuk log masuk ke akaun anda.<br><br>ID Pengguna : [username]<br><br>Jika anda menghadapi sebarang masalah, sila hubungi atau hadir ke Pejabat yang berhampiran (<a href="">Web Rasmi</a>).<br><br> Sekian, terima kasih.',
                'is_active_emel' => 1,
                // 'is_active_sms' => 1,
                'is_active_system' => 1,
                'created_by_user_id' => 1,
                'created_at' => '2020-08-03 16:47:57',
                'updated_at' => '2020-08-03 16:47:57',
            ),
            1 =>
            array (
                'id' => 2,
                'name' => 'Pendaftaran Berjaya',
                'code' => 'PendaftaranPenggunaLagi',
                'message' => 'Salam sejahtera,<br><br> Permohonan pendaftaran telah didaftarkan oleh <strong>[username]<strong> <br><br> Anda diminta membuat pengesahan bagi meneruskan Pendaftaran.<br><br>Sekiranya masih berminat untuk meneruskan, sila klik pautan di bawah.<br><br><a href=>Tekan Disini Untuk Pengesahan</a><br>
<br> Sekian, terima kasih.',
                'is_active_emel' => 1,
                // 'is_active_sms' => 1,
                'is_active_system' => 1,
                'created_by_user_id' => 1,
                'created_at' => '2020-08-03 16:47:57',
                'updated_at' => '2020-08-03 16:47:57',
            ),
        ));


    }
}

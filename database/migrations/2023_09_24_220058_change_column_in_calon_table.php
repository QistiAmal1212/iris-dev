<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('calon', function (Blueprint $table) {
            $table->renameColumn('no_ic', 'no_kp_baru');
            $table->renameColumn('no_ic_old', 'no_kp_lama');
            $table->renameColumn('no_passport', 'no_pasport');
            $table->renameColumn('ic_color', 'warna_kp');
            $table->renameColumn('full_name', 'nama_penuh');
            $table->renameColumn('email', 'emel');
            $table->renameColumn('phone_number', 'no_tel');
            $table->renameColumn('ref_gender_code', 'kod_ruj_jantina');
            $table->renameColumn('ref_marital_status_code', 'kod_ruj_status_kahwin');
            $table->renameColumn('ref_race_code', 'kod_ruj_keturunan');
            $table->renameColumn('ref_religion_code', 'kod_ruj_agama');
            $table->renameColumn('nationality', 'kewarganegaraan');
            $table->renameColumn('height', 'tinggi');
            $table->renameColumn('weight', 'berat');
            $table->renameColumn('address_1', 'alamat_1');
            $table->renameColumn('address_2', 'alamat_2');
            $table->renameColumn('address_3', 'alamat_3');
            $table->renameColumn('poscode', 'poskod');
            $table->renameColumn('city', 'bandar');
            $table->renameColumn('ref_state_code', 'tempat_tinggal');
            $table->renameColumn('permanent_address_1', 'alamat_1_tetap');
            $table->renameColumn('permanent_address_2', 'alamat_2_tetap');
            $table->renameColumn('permanent_address_3', 'alamat_3_tetap');
            $table->renameColumn('permanent_poscode', 'poskod_tetap');
            $table->renameColumn('permanent_city', 'bandar_tetap');
            $table->renameColumn('permanent_ref_state_code', 'tempat_tinggal_tetap');
            $table->renameColumn('date_of_birth', 'tarikh_lahir');
            $table->renameColumn('place_of_birth', 'tempat_lahir');
            $table->renameColumn('father_place_of_birth', 'tempat_lahir_bapa');
            $table->renameColumn('mother_place_of_birth', 'tempat_lahir_ibu');
            $table->string('bantuan')->nullable();
            $table->string('biasiswa_p')->nullable();
            $table->string('nom_daftar_bantuan')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('calon', function (Blueprint $table) {
            $table->dropColumn('bantuan');
            $table->dropColumn('biasiswa_p');
            $table->dropColumn('nom_daftar_bantuan');
            $table->renameColumn('no_kp_baru', 'no_ic');
            $table->renameColumn('no_kp_lama', 'no_ic_old');
            $table->renameColumn('no_pasport', 'no_passport');
            $table->renameColumn('warna_kp', 'ic_color');
            $table->renameColumn('nama_penuh', 'full_name');
            $table->renameColumn('emel', 'email');
            $table->renameColumn('no_tel', 'phone_number');
            $table->renameColumn('kod_ruj_jantina', 'ref_gender_code');
            $table->renameColumn('kod_ruj_status_kahwin', 'ref_marital_status_code');
            $table->renameColumn('kod_ruj_keturunan', 'ref_race_code');
            $table->renameColumn('kod_ruj_agama', 'ref_religion_code');
            $table->renameColumn('kewarganegaraan', 'nationality');
            $table->renameColumn('tinggi', 'height');
            $table->renameColumn('berat', 'weight');
            $table->renameColumn('alamat_1', 'address_1');
            $table->renameColumn('alamat_2', 'address_2');
            $table->renameColumn('alamat_3', 'address_3');
            $table->renameColumn('poskod', 'poscode');
            $table->renameColumn('bandar', 'city');
            $table->renameColumn('tempat_tinggal', 'ref_state_code');
            $table->renameColumn('alamat_1_tetap', 'permanent_address_1');
            $table->renameColumn('alamat_2_tetap', 'permanent_address_2');
            $table->renameColumn('alamat_3_tetap', 'permanent_address_3');
            $table->renameColumn('poskod_tetap', 'permanent_poscode');
            $table->renameColumn('bandar_tetap', 'permanent_city');
            $table->renameColumn('tempat_tinggal_tetap', 'permanent_ref_state_code');
            $table->renameColumn('tarikh_lahir', 'date_of_birth');
            $table->renameColumn('tempat_lahir', 'place_of_birth');
            $table->renameColumn('tempat_lahir_bapa', 'father_place_of_birth');
            $table->renameColumn('tempat_lahir_ibu', 'mother_place_of_birth');
        });
    }
};

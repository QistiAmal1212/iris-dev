<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // Schema::table('calon', function (Blueprint $table) {
        //     $table->string('no_pengenalan', 12)->change();
        //     $table->string('no_kp_baru', 12)->change();
        //     $table->string('no_kp_lama', 12)->change();
        //     $table->string('no_pasport', 12)->change();
        //     $table->string('warna_kp', 1)->change();
        //     $table->string('nama_penuh', 80)->change();
        //     $table->string('e_mel', 100)->change();
        //     $table->string('no_tel', 12)->change();
        //     $table->string('jan_kod', 1)->change();
        //     $table->string('taraf_perkahwinan', 1)->change();
        //     $table->string('ket_kod', 3)->change();
        //     $table->string('agama', 1)->change();
        //     $table->string('kewarganegaraan', 1)->change();
        //     $table->string('alamat_1', 150)->change();
        //     $table->string('alamat_2', 150)->change();
        //     $table->string('alamat_3', 150)->change();
        //     $table->string('poskod', 5)->change();
        //     $table->string('bandar', 30)->change();
        //     $table->string('tempat_tinggal', 2)->change();
        //     $table->string('alamat_1_tetap', 150)->change();
        //     $table->string('alamat_2_tetap', 150)->change();
        //     $table->string('alamat_3_tetap', 150)->change();
        //     $table->string('poskod_tetap', 5)->change();
        //     $table->string('bandar_tetap', 30)->change();
        //     $table->string('tempat_tinggal_tetap', 2)->change();
        //     $table->string('tempat_lahir', 2)->change();
        //     $table->string('tempat_lahir_bapa', 2)->change();
        //     $table->string('tempat_lahir_ibu', 2)->change();
        //     $table->string('id_pencipta', 12)->change();
        //     $table->string('pengguna', 12)->change();
        //     $table->string('bantuan', 1)->change();
        //     $table->string('biasiswa_p', 1)->change();
        //     $table->string('nom_daftar_bantuan', 15)->change();
        //     $table->string('pusat_temuduga', 2)->change();
        //     $table->string('rabun', 1)->change();
        // });
        
        //DB::statement('ALTER TABLE calon ALTER COLUMN ketinggian TYPE NUMERIC(5, 2) USING ketinggian::numeric(5, 2)');
        //DB::statement('ALTER TABLE calon ALTER COLUMN berat TYPE NUMERIC(5, 2) USING berat::numeric(5, 2)');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Schema::table('calon', function (Blueprint $table) {
        //     $table->string('no_pengenalan')->change();
        //     $table->string('no_kp_baru')->change();
        //     $table->string('no_kp_lama')->change();
        //     $table->string('no_pasport')->change();
        //     $table->string('warna_kp')->change();
        //     $table->string('nama_penuh')->change();
        //     $table->string('e_mel')->change();
        //     $table->string('no_tel')->change();
        //     $table->string('jan_kod')->change();
        //     $table->string('taraf_perkahwinan')->change();
        //     $table->string('ket_kod')->change();
        //     $table->string('agama')->change();
        //     $table->string('kewarganegaraan')->change();
        //     $table->string('alamat_1')->change();
        //     $table->string('alamat_2')->change();
        //     $table->string('alamat_3')->change();
        //     $table->string('poskod')->change();
        //     $table->string('bandar')->change();
        //     $table->string('tempat_tinggal')->change();
        //     $table->string('alamat_1_tetap')->change();
        //     $table->string('alamat_2_tetap')->change();
        //     $table->string('alamat_3_tetap')->change();
        //     $table->string('poskod_tetap')->change();
        //     $table->string('bandar_tetap')->change();
        //     $table->string('tempat_tinggal_tetap')->change();
        //     $table->string('tempat_lahir')->change();
        //     $table->string('tempat_lahir_bapa')->change();
        //     $table->string('tempat_lahir_ibu')->change();
        //     $table->string('id_pencipta')->change();
        //     $table->string('pengguna')->change();
        //     $table->string('bantuan')->change();
        //     $table->string('biasiswa_p')->change();
        //     $table->string('nom_daftar_bantuan')->change();
        //     $table->string('pusat_temuduga')->change();
        //     $table->string('rabun')->change();
        // });

        //DB::statement('ALTER TABLE calon ALTER COLUMN ketinggian TYPE VARCHAR(255');
        //DB::statement('ALTER TABLE calon ALTER COLUMN berat TYPE VARCHAR(255');
    }
};

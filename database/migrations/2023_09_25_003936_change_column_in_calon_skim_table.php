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
        Schema::table('calon_skim', function (Blueprint $table) {
            $table->string('register_date')->nullable()->change();
            $table->string('group_no')->nullable()->change();
            $table->string('serial_no')->nullable()->change();
            $table->string('ref_interview_centre_code')->nullable()->change();
            $table->string('status')->nullable()->change();
            $table->string('tmp_status')->nullable()->change();
            $table->string('sah_yt')->nullable()->change();
            $table->renameColumn('type', 'jenis_lantikan');
            $table->renameColumn('register_date', 'tarikh_daftar');
            $table->renameColumn('ref_skim_code', 'kod_ruj_skim');
            $table->renameColumn('group_no', 'no_kelompok');
            $table->renameColumn('serial_no', 'no_siri');
            $table->renameColumn('ref_interview_centre_code', 'pusat_td_pilihan');
            $table->renameColumn('expiry_date', 'tarikh_luput');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('calon_skim', function (Blueprint $table) {
            $table->string('tarikh_daftar')->nullable(false)->change();
            $table->string('no_kelompok')->nullable(false)->change();
            $table->string('no_siri')->nullable(false)->change();
            $table->string('pusat_td_pilihan')->nullable(false)->change();
            $table->string('status')->nullable(false)->change();
            $table->string('tmp_status')->nullable(false)->change();
            $table->string('sah_yt')->nullable(false)->change();
            $table->renameColumn('jenis_lantikan', 'type');
            $table->renameColumn('tarikh_daftar', 'register_date');
            $table->renameColumn('kod_ruj_skim', 'ref_skim_code');
            $table->renameColumn('no_kelompok', 'group_no');
            $table->renameColumn('no_siri', 'serial_no');
            $table->renameColumn('pusat_td_pilihan', 'ref_interview_centre_code');
            $table->renameColumn('tarikh_luput', 'expiry_date');
        });
    }
};

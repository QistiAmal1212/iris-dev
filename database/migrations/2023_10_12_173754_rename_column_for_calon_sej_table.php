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
        Schema::table('calon_sej', function (Blueprint $table) {
            $table->string('created_by')->change();
            $table->string('updated_by')->change();
            $table->renameColumn('emel', 'e_mel');
            $table->renameColumn('kod_ruj_jantina', 'jan_kod');
            $table->renameColumn('kod_ruj_status_kahwin', 'taraf_perkahwinan');
            $table->renameColumn('kod_ruj_keturunan', 'ket_kod');
            $table->renameColumn('kod_ruj_agama', 'agama');
            $table->renameColumn('tinggi', 'ketinggian');
            $table->renameColumn('created_by', 'id_pencipta');
            $table->renameColumn('created_at', 'tarikh_cipta');
            $table->renameColumn('updated_by', 'pengguna');
            $table->renameColumn('updated_at', 'tarikh_ubahsuai');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('calon_sej', function (Blueprint $table) {
            $table->string('id_pencipta')->nullable()->change();
            $table->string('pengguna')->nullable()->change();
            $table->renameColumn('e_mel', 'emel');
            $table->renameColumn('jan_kod', 'kod_ruj_jantina');
            $table->renameColumn('taraf_perkahwinan', 'kod_ruj_status_kahwin');
            $table->renameColumn('ket_kod', 'kod_ruj_keturunan');
            $table->renameColumn('agama', 'kod_ruj_agama');
            $table->renameColumn('ketinggian', 'tinggi');
            $table->renameColumn('id_pencipta', 'created_by');
            $table->renameColumn('tarikh_cipta', 'created_at');
            $table->renameColumn('pengguna', 'updated_by');
            $table->renameColumn('tarikh_ubahsuai', 'updated_at');
        });
    }
};

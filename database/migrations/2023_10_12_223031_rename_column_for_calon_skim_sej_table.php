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
        Schema::table('calon_skim_sej', function (Blueprint $table) {
            $table->string('created_by')->change();
            $table->string('updated_by')->change();
            $table->renameColumn('no_pengenalan', 'cal_no_pengenalan');
            $table->renameColumn('kod_ruj_skim', 'ski_kod');
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
        Schema::table('calon_skim_sej', function (Blueprint $table) {
            $table->string('id_pencipta')->nullable()->change();
            $table->string('pengguna')->nullable()->change();
            $table->renameColumn('cal_no_pengenalan', 'no_pengenalan');
            $table->renameColumn('ski_kod', 'kod_ruj_skim');
            $table->renameColumn('id_pencipta', 'created_by');
            $table->renameColumn('tarikh_cipta', 'created_at');
            $table->renameColumn('pengguna', 'updated_by');
            $table->renameColumn('tarikh_ubahsuai', 'updated_at');
        });
    }
};

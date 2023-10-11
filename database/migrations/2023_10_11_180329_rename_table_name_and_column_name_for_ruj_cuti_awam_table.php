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
        Schema::table('ruj_cuti_awam', function (Blueprint $table) {
            $table->dropColumn('sah_yt');
            $table->string('created_by')->change();
            $table->string('updated_by')->change();
            $table->renameColumn('kod', 'ca_id');
            $table->renameColumn('kod_ruj_negeri', 'neg_kod');
            $table->renameColumn('kod_ruj_senarai_cuti', 'scut_kod');
            $table->renameColumn('created_by', 'id_pencipta');
            $table->renameColumn('created_at', 'tarikh_cipta');
            $table->renameColumn('updated_by', 'pengguna');
            $table->renameColumn('updated_at', 'tarikh_ubahsuai');
        });

        Schema::table('ruj_cuti_awam', function (Blueprint $table) {
            $table->string('sah_yt')->default('Y');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('ruj_cuti_awam', function (Blueprint $table) {
            //
        });
        Schema::table('ruj_cuti_awam', function (Blueprint $table) {
            $table->dropColumn('sah_yt');
            $table->string('id_pencipta')->nullable()->change();
            $table->string('pengguna')->nullable()->change();
            $table->renameColumn('ca_id', 'kod');
            $table->renameColumn('neg_kod', 'kod_ruj_negeri');
            $table->renameColumn('scut_kod', 'kod_ruj_senarai_cuti');
            $table->renameColumn('id_pencipta', 'created_by');
            $table->renameColumn('tarikh_cipta', 'created_at');
            $table->renameColumn('pengguna', 'updated_by');
            $table->renameColumn('tarikh_ubahsuai', 'updated_at');
        });

        Schema::table('ruj_daerah', function (Blueprint $table) {
            $table->boolean('sah_yt')->default(true);
        });
    }
};

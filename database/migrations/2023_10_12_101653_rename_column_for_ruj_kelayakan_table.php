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
        Schema::table('ruj_kelayakan', function (Blueprint $table) {
            $table->dropColumn('is_active');
            $table->dropColumn('pemerolehan_code');
            $table->string('created_by')->change();
            $table->string('updated_by')->change();
            $table->renameColumn('code', 'kod');
            $table->renameColumn('name', 'diskripsi');
            $table->renameColumn('ref_skim_code', 'ski_kod');
            $table->renameColumn('category', 'kategori_kelayakan');
            $table->renameColumn('equivalent', 'kelayakan_setara');
            $table->renameColumn('rank', 'rank_layak');
            $table->renameColumn('created_by', 'id_pencipta');
            $table->renameColumn('created_at', 'tarikh_cipta');
            $table->renameColumn('updated_by', 'pengguna');
            $table->renameColumn('updated_at', 'tarikh_ubahsuai');
        });

        Schema::table('ruj_kelayakan', function (Blueprint $table) {
            $table->string('sah_yt')->default('Y');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('ruj_kelayakan', function (Blueprint $table) {
            $table->dropColumn('sah_yt');
            $table->string('pemerolehan_code')->nullable();
            $table->string('id_pencipta')->nullable()->change();
            $table->string('pengguna')->nullable()->change();
            $table->renameColumn('kod', 'code');
            $table->renameColumn('diskripsi', 'name');
            $table->renameColumn('ski_kod', 'ref_skim_code');
            $table->renameColumn('kategori_kelayakan', 'category');
            $table->renameColumn('kelayakan_setara', 'equivalent');
            $table->renameColumn('rank_layak', 'rank');
            $table->renameColumn('id_pencipta', 'created_by');
            $table->renameColumn('tarikh_cipta', 'created_at');
            $table->renameColumn('pengguna', 'updated_by');
            $table->renameColumn('tarikh_ubahsuai', 'updated_at');
        });

        Schema::table('ruj_kelayakan', function (Blueprint $table) {
            $table->boolean('is_active')->default(true);
        });
    }
};

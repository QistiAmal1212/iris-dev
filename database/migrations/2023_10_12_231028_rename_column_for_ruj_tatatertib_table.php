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
        Schema::table('ruj_tatatertib', function (Blueprint $table) {
            $table->dropColumn('is_active');
            $table->dropColumn('pemerolehan_code');
            $table->renameColumn('code', 'kod');
            $table->renameColumn('name', 'diskripsi');
            $table->renameColumn('category', 'kategori');
            $table->string('id_pencipta')->nullable();
            $table->string('pengguna')->nullable();
            $table->renameColumn('created_at', 'tarikh_cipta');
            $table->renameColumn('updated_at', 'tarikh_ubahsuai');
        });
        Schema::table('ruj_tatatertib', function (Blueprint $table) {
            $table->string('sah_yt')->default('Y');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('ruj_tatatertib', function (Blueprint $table) {
            $table->dropColumn('sah_yt');
            $table->dropColumn('id_pencipta');
            $table->dropColumn('pengguna');
            $table->renameColumn('kod', 'code');
            $table->renameColumn('diskripsi', 'name');
            $table->renameColumn('kategori', 'category');
            $table->renameColumn('tarikh_cipta', 'created_at');
            $table->renameColumn('tarikh_ubahsuai', 'updated_at');
        });
        Schema::table('ruj_tatatertib', function (Blueprint $table) {
            $table->boolean('is_active')->default(true);
            $table->string('pemerolehan_code')->nullable();
        });
    }
};

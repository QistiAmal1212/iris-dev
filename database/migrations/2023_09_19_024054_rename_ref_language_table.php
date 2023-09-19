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
        Schema::table('ref_language', function (Blueprint $table) {
            $table->renameColumn('code', 'kod');
            $table->renameColumn('name', 'nama');
            $table->renameColumn('pemerolehan_code', 'no_pemerolehan');
            $table->renameColumn('is_active', 'sah_yt');
        });
        Schema::rename('ref_language', 'ruj_bahasa');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('ruj_bahasa', function (Blueprint $table) {
            $table->renameColumn('kod', 'code');
            $table->renameColumn('nama', 'name');
            $table->renameColumn('no_pemerolehan', 'pemerolehan_code');
            $table->renameColumn('sah_yt', 'is_active');
        });
        Schema::rename('ruj_bahasa', 'ref_language');
    }
};

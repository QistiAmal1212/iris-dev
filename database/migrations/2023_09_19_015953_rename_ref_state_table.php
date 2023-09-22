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
        Schema::table('ref_state', function (Blueprint $table) {
            $table->renameColumn('code', 'kod');
            $table->renameColumn('name', 'nama');
            $table->renameColumn('is_active', 'sah_yt');
        });
        Schema::rename('ref_state', 'ruj_negeri');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('ref_state', function (Blueprint $table) {
            $table->renameColumn('kod', 'code');
            $table->renameColumn('nama', 'name');
            $table->renameColumn('sah_yt', 'is_active');
        });
        Schema::rename('ruj_negeri', 'ref_state');
    }
};

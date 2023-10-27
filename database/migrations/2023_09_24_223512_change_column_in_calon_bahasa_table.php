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
        Schema::table('calon_bahasa', function (Blueprint $table) {
            $table->renameColumn('ref_language_code', 'jenis_bahasa');
            $table->renameColumn('level', 'penguasaan');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('calon_bahasa', function (Blueprint $table) {
            $table->renameColumn('jenis_bahasa', 'ref_language_code');
            $table->renameColumn('penguasaan', 'level');
        });
    }
};

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
        Schema::table('calon_tatatertib', function (Blueprint $table) {
            $table->renameColumn('ref_penalty_code', 'kod_ruj_penalti');
            $table->renameColumn('duration', 'tempoh');
            $table->renameColumn('type', 'jenis');
            $table->renameColumn('date_start', 'tarikh_mula');
            $table->renameColumn('date_end', 'tarikh_tamat');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('calon_tatatertib', function (Blueprint $table) {
            $table->renameColumn('kod_ruj_penalti', 'ref_penalty_code');
            $table->renameColumn('tempoh', 'duration');
            $table->renameColumn('jenis', 'type');
            $table->renameColumn('tarikh_mula', 'date_start');
            $table->renameColumn('tarikh_tamat', 'date_end');
        });
    }
};

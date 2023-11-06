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
        Schema::table('calon_senarai_hitam_sej', function (Blueprint $table) {
            $table->string('kod_ruj_penalti')->nullable();
            $table->string('tempoh')->nullable();
            $table->string('jenis')->nullable();
            $table->date('trk_tamat')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('calon_senarai_hitam_sej', function (Blueprint $table) {
            $table->dropColumn('kod_ruj_penalti');
            $table->dropColumn('tempoh');
            $table->dropColumn('jenis');
            $table->dropColumn('trk_tamat');
        });
    }
};

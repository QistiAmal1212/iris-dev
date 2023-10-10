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
        Schema::table('ruj_ahli_suruhanjaya', function (Blueprint $table) {
            $table->renameColumn('tuntutan_perubatan', 'tuntutan_perbatuan');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('ruj_ahli_suruhanjaya', function (Blueprint $table) {
            $table->renameColumn('tuntutan_perbatuan', 'tuntutan_perubatan');
        });
    }
};

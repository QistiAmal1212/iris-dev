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
            $table->dropColumn('nama');
            $table->date('tarikh_cuti');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('ruj_cuti_awam', function (Blueprint $table) {
            $table->dropColumn('tarikh_cuti');
            $table->string('nama');
        });
    }
};

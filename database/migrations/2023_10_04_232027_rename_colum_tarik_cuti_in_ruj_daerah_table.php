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
        Schema::table('ruj_daerah', function (Blueprint $table) {
            $table->string('tarikh_cuti')->change();
            $table->renameColumn('tarikh_cuti', 'nama');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {

    }
};

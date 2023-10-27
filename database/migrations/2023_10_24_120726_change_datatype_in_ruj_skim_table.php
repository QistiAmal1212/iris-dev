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
        Schema::table('ruj_skim', function (Blueprint $table) {
            $table->string('jenis_skim')->change()->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('ruj_skim', function (Blueprint $table) {
            DB::statement('ALTER TABLE ruj_skim ALTER COLUMN jenis_skim TYPE bigint USING jenis_skim::bigint');
        });
    }
};

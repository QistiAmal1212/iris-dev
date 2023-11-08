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
        Schema::table('calon_senarai_hitam', function (Blueprint $table) {
            $table->string('kod_ruj_penalti')->comment('Kod ruj_tatatertib')->change();
            $table->renameColumn('kod_ruj_penalti', 'kod');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('calon_senarai_hitam', function (Blueprint $table) {
            $table->string('kod')->comment('')->change();
            $table->renameColumn('kod', 'kod_ruj_penalti')->comment('');
        });
    }
};

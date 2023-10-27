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
        Schema::table('calon_bakat', function (Blueprint $table) {
            $table->renameColumn('ref_talent_code', 'bakat');
            $table->renameColumn('detail', 'bakat_detail');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('calon_bakat', function (Blueprint $table) {
            $table->renameColumn('bakat', 'ref_talent_code');
            $table->renameColumn('bakat_detail', 'detail');
        });
    }
};

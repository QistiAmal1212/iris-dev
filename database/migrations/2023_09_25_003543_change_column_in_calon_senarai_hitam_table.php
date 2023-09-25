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
            $table->renameColumn('effective_date', 'tarikh_kuatkuasa');
            $table->renameColumn('no_ic', 'no_kp_baru');
            $table->renameColumn('no_ic_old', 'no_kp_lama');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('calon_senarai_hitam', function (Blueprint $table) {
            $table->renameColumn('tarikh_kuatkuasa', 'effective_date');
            $table->renameColumn('no_kp_baru', 'no_ic');
            $table->renameColumn('no_kp_lama', 'no_ic_old');
        });
    }
};

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
        Schema::table('calon_lesen', function (Blueprint $table) {
            $table->string('cal_no_pengenalan', 12)->change();
            $table->string('jenis_lesen', 20)->change();
            $table->string('tempoh_tamat', 25)->change();
            $table->string('status_senaraihitam', 1)->change();
            $table->string('msg_senaraihitam', 100)->change();
            $table->string('id_pencipta', 12)->change();
            $table->string('pengguna', 12)->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('calon_lesen', function (Blueprint $table) {
            $table->string('cal_no_pengenalan')->change();
            $table->string('jenis_lesen')->change();
            $table->string('tempoh_tamat')->change();
            $table->string('status_senaraihitam')->change();
            $table->string('msg_senaraihitam')->change();
            $table->string('id_pencipta')->change();
            $table->string('pengguna')->change();
        });
    }
};

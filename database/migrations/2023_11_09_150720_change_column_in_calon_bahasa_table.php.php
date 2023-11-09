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
        Schema::table('calon_bahasa', function (Blueprint $table) {
            $table->string('no_pengenalan', 12)->change();
            $table->string('jenis_bahasa', 2)->change();
            $table->string('penguasaan', 1)->change();
            $table->string('id_pencipta', 12)->change();
            $table->string('pengguna', 12)->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('calon_bahasa', function (Blueprint $table) {
            $table->string('no_pengenalan')->change();
            $table->string('jenis_bahasa')->change();
            $table->string('penguasaan')->change();
            $table->string('id_pencipta')->change();
            $table->string('pengguna')->change();
        });
    }
};

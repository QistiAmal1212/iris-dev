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
        Schema::table('calon_oku', function (Blueprint $table) {
            $table->dropUnique('candidate_oku_no_pengenalan_unique');
            $table->dropUnique('candidate_oku_no_registration_unique');
            $table->renameColumn('no_registration', 'no_daftar_jkm');
            $table->renameColumn('category', 'kategori_oku');
            $table->renameColumn('sub', 'sub_oku');
            $table->renameColumn('status', 'status_oku');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('calon_oku', function (Blueprint $table) {
            $table->renameColumn('no_daftar_jkm', 'no_registration');
            $table->renameColumn('kategori_oku', 'category');
            $table->renameColumn('sub_oku', 'sub');
            $table->renameColumn('status_oku', 'status');
        });
        Schema::table('calon_oku', function (Blueprint $table) {
            $table->string('no_pengenalan')->unique()->change();
            $table->string('no_registration')->unique()->change();
        });
    }
};

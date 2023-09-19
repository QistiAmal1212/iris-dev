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
        Schema::table('ref_department_ministry', function (Blueprint $table) {
            $table->renameColumn('code', 'kod');
            $table->renameColumn('name', 'nama');
            $table->renameColumn('address_1', 'alamat_1');
            $table->renameColumn('address_2', 'alamat_2');
            $table->renameColumn('address_3', 'alamat_3');
            $table->renameColumn('chief_title', 'gelaran_ketua');
            $table->renameColumn('pemerolehan_code', 'no_pemerolehan');
            $table->renameColumn('poscode', 'poskod');
            $table->renameColumn('city', 'bandar');
            $table->renameColumn('department_ministry_code', 'kem_kod');
            $table->renameColumn('name_2', 'nama_2');
            $table->renameColumn('name_3', 'nama_3');
            $table->renameColumn('email', 'emel');
            $table->renameColumn('phone_number', 'no_tel');
            $table->renameColumn('is_active', 'sah_yt');
        });
        Schema::rename('ref_department_ministry', 'ruj_kem_jabatan');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('ruj_kem_jabatan', function (Blueprint $table) {
            $table->renameColumn('kod', 'code');
            $table->renameColumn('nama', 'name');
            $table->renameColumn('alamat_1', 'address_1');
            $table->renameColumn('alamat_2', 'address_2');
            $table->renameColumn('alamat_3', 'address_3');
            $table->renameColumn('gelaran_ketua', 'chief_title');
            $table->renameColumn('no_pemerolehan', 'pemerolehan_code');
            $table->renameColumn('poskod', 'poscode');
            $table->renameColumn('bandar', 'city');
            $table->renameColumn('kem_kod', 'department_ministry_code');
            $table->renameColumn('nama_2', 'name_2');
            $table->renameColumn('nama_3', 'name_3');
            $table->renameColumn('emel', 'email');
            $table->renameColumn('no_tel', 'phone_number');
            $table->renameColumn('sah_yt', 'is_active');
        });
        Schema::rename('ruj_kem_jabatan', 'ref_department_ministry');
    }
};

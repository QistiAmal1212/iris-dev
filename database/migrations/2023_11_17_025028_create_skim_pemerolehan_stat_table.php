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
        Schema::create('skim_pemerolehan_stat', function (Blueprint $table) {
            $table->string('ski_kod', 14);
            $table->string('per_no_pemerolehan', 10);
            $table->decimal('bil_calon_kelonggaran', 10, 0)->nullable();
            $table->decimal('bil_simpanan', 5, 0)->nullable();
            $table->decimal('bil_layak_xtd_2pkt', 10, 0)->nullable();
            $table->decimal('bil_layak_td', 10, 0)->nullable();
            $table->decimal('bil_layak_xtd_xasas', 10, 0)->nullable();
            $table->decimal('bil_layak_xlayak', 10, 0)->nullable();
            $table->decimal('bil_calon_kpsl', 10, 0)->nullable();
            $table->decimal('bil_calon_lt', 10, 0)->nullable();
            $table->decimal('bil_calon_lt_sb', 10, 0)->nullable();
            $table->decimal('bil_calon_semtara_kon', 10, 0)->nullable();
            $table->decimal('bil_kekosongan', 5, 0)->nullable();
            $table->decimal('bil_layak_kelonggaran', 10, 0)->nullable();
            $table->string('rujukan_kami', 29)->nullable();
            $table->string('id_pencipta', 12)->nullable();
            $table->timestamp('tarikh_cipta')->nullable();
            $table->string('pengguna', 12)->nullable();
            $table->timestamp('tarikh_ubahsuai')->nullable();

            // Primary key
            $table->primary(['ski_kod', 'per_no_pemerolehan']);

            // Foreign Key Constraint
            $table->foreign('ski_kod')->references('kod')->on('ruj_skim')->onDelete('NO ACTION')->onUpdate('NO ACTION');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('skim_pemerolehan_stat');
    }
};

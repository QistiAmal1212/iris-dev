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
        Schema::create('skim_ruling', function (Blueprint $table) {
            $table->string('no_pemerolehan', 10);
            $table->string('ski_kod', 14);
            $table->string('rul_kod', 4);
            $table->string('rul_status', 1)->nullable();
            $table->string('kecuali_no_pemerolehan', 10)->nullable();
            $table->string('kecuali_status', 2)->nullable();
            $table->string('id_pencipta', 12)->nullable();
            $table->timestamp('tarikh_cipta')->nullable();
            $table->string('pengguna', 12)->nullable();
            $table->timestamp('tarikh_ubahsuai')->nullable();

            // Primary key
            $table->primary(['no_pemerolehan', 'ski_kod', 'rul_kod']);

            // Foreign Key Constraint
            $table->foreign('no_pemerolehan')->references('no_pemerolehan')->on('pemerolehan')->onDelete('NO ACTION')->onUpdate('NO ACTION');
            $table->foreign('ski_kod')->references('kod')->on('ruj_skim')->onDelete('NO ACTION')->onUpdate('NO ACTION');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('skim_ruling');
    }
};

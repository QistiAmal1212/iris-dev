<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (Schema::hasTable('uploaded_files')) {
            DB::statement('CREATE TABLE uploaded_files_old LIKE uploaded_files; ');
            Schema::dropIfExists('uploaded_files');
        }

        if (! Schema::hasTable('uploaded_files')) {
            Schema::create('uploaded_files', function (Blueprint $table) {
                $table->char('id', 36)->unique();
                $table->string('entity_type', 100);
                $table->string('entity_id');
                $table->string('doc_type', 191)->nullable();
                $table->string('path', 191);
                $table->string('original_filename')->nullable();
                $table->unsignedBigInteger('uploaded_by')->nullable()->index('uploaded_files_uploaded_by_foreign');
                $table->timestamps();
            });

            if (Schema::hasTable('users')) {
                Schema::table('uploaded_files', function (Blueprint $table) {
                    $table->foreign(['uploaded_by'])->references(['id'])->on('users')->onUpdate('CASCADE')->onDelete('CASCADE');
                });
            }
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('uploaded_files', function (Blueprint $table) {
            $table->dropForeign('uploaded_files_uploaded_by_foreign');
        });

        Schema::dropIfExists('uploaded_files');
    }
};

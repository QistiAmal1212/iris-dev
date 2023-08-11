<?php

use App\Http\Controllers\MaklumatPemohonController;

Route::controller(MaklumatPemohonController::class)->group(function () {
    Route::prefix('pemohon')->group(function () {
        Route::get('carian-pemohon','searchPemohon')->name('carian_pemohon');
        Route::get('maklumat-pemohon','viewMaklumatPemohon')->name('maklumat_pemohon');
    });
});


<?php

use App\Http\Controllers\MaklumatPemohonController;
use App\Http\Controllers\IntegrationController;

Route::controller(MaklumatPemohonController::class)->group(function () {
    Route::prefix('pemohon')->group(function () {
        Route::get('carian-pemohon','searchPemohon')->name('carian_pemohon');
        Route::get('maklumat-pemohon','viewMaklumatPemohon')->name('maklumat_pemohon');
    });
});

Route::controller(IntegrationController::class)->group(function () {
    Route::prefix('integrasi')->group(function () {
        Route::get('dashboard-integrasi','DashboardIntegration')->name('dashboard_integration');
    });
});

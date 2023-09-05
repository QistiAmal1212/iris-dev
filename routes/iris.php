<?php

use App\Http\Controllers\MaklumatPemohonController;
use App\Http\Controllers\IntegrationController;
use App\Http\Controllers\PGSPAController;

Route::controller(MaklumatPemohonController::class)->group(function () {
    Route::prefix('pemohon')->group(function () {
        Route::get('carian-pemohon','searchPemohon')->name('carian_pemohon');
        Route::get('maklumat-pemohon','viewMaklumatPemohon')->name('maklumat_pemohon');
        Route::post('get-candidate-details', 'getCandidateDetails')->name('get-candidate-details');
        Route::get('timeline/{noPengenalan}', 'listTimeline')->name('timeline.list');
        Route::post('personal/store', 'storePersonal')->name('personal.store');
        Route::get('personal/{noPengenalan}', 'personalDetails')->name('personal.details');
        Route::post('penalty/store', 'storePenalty')->name('penalty.store');
        Route::get('penalty/{noPengenalan}', 'listPenalty')->name('penalty.list');
    });
});

Route::controller(IntegrationController::class)->group(function () {
    Route::prefix('integrasi')->group(function () {
        Route::get('dashboard-integrasi','DashboardIntegration')->name('dashboard_integration');
        Route::get('informasi-integrasi','IntegrationInformation')->name('integration_information');
    });
});

Route::prefix('perolehan')->group(function () {
    Route::controller(PGSPAController::class)->group(function () {
        Route::prefix('pgspa')->group(function () {
            Route::get('senarai-skim','SenaraiSkim')->name('senarai_skim');
            Route::get('skim-baharu','SkimBaharu')->name('skim_baharu');
        });
    });
});

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

        Route::prefix('personal')->group(function () {
            Route::post('update', 'updatePersonal')->name('personal.update');
            Route::get('details/{noPengenalan}', 'personalDetails')->name('personal.details');
        });

        Route::prefix('alamat')->group(function () {
            Route::post('update', 'updateAlamat')->name('alamat.update');
            Route::get('details/{noPengenalan}', 'alamatDetails')->name('alamat.details');
        });

        Route::prefix('tempat_lahir')->group(function () {
            Route::post('update', 'updateTempatLahir')->name('tempat-lahir.update');
            Route::get('details/{noPengenalan}', 'tempatLahirDetails')->name('tempat-lahir.details');
        });

        Route::prefix('army_police')->group(function () {
            Route::post('store', 'storeArmyPolice')->name('army-police.store');
            Route::get('details/{noPengenalan}', 'armyPoliceDetails')->name('army-police.details');
        });

        Route::prefix('penalty')->group(function () {
            Route::post('store', 'storePenalty')->name('penalty.store');
            Route::get('list/{noPengenalan}', 'listPenalty')->name('penalty.list');
        });
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

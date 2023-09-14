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

        Route::prefix('lesen_memandu')->group(function () {
            Route::post('update', 'updateLesenMemandu')->name('lesen-memandu.update');
            Route::get('details/{noPengenalan}', 'lesenMemanduDetails')->name('lesen-memandu.details');
        });

        Route::prefix('oku')->group(function () {
            Route::post('update', 'updateOKU')->name('oku.update');
            Route::get('details/{noPengenalan}', 'OKUDetails')->name('oku.details');
        });

        Route::prefix('pmr')->group(function () {
            Route::post('store', 'storePmr')->name('pmr.store');
            Route::get('list/{noPengenalan}', 'listPmr')->name('pmr.list');
        });

        Route::prefix('pengajian_tinggi')->group(function () {
            Route::post('update', 'updatePengajianTinggi')->name('pengajian-tinggi.update');
            Route::get('details/{noPengenalan}', 'pengajianTinggiDetails')->name('pengajian-tinggi.details');
        });

        Route::prefix('experience')->group(function () {
            Route::post('update', 'updateExperience')->name('experience.update');
            Route::get('details/{noPengenalan}', 'experienceDetails')->name('experience.details');
        });

        Route::prefix('tentera_polis')->group(function () {
            Route::post('update', 'updateTenteraPolis')->name('tentera-polis.update');
            Route::get('details/{noPengenalan}', 'tenteraPolisDetails')->name('tentera-polis.details');
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

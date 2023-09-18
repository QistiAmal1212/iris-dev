<?php

use App\Http\Controllers\MaklumatPemohonController;
use App\Http\Controllers\IntegrationController;
use App\Http\Controllers\PGSPAController;
use App\Http\Controllers\AcronymController;

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
            Route::post('update', 'updatePmr')->name('pmr.update');
            Route::post('delete/{idPmr}', 'deletePmr')->name('pmr.delete');
        });

        Route::prefix('spm')->group(function () {
            Route::post('store', 'storeSpm')->name('spm.store');
            Route::get('list/{noPengenalan}', 'listSpm')->name('spm.list');
            Route::post('update', 'updateSpm')->name('spm.update');
            Route::post('delete/{idSpm}', 'deleteSpm')->name('spm.delete');
        });

        Route::prefix('spmv')->group(function () {
            Route::post('store', 'storeSpmv')->name('spmv.store');
            Route::get('list/{noPengenalan}', 'listSpmv')->name('spmv.list');
            Route::post('update', 'updateSpmv')->name('spmv.update');
            Route::post('delete/{idSpmv}', 'deleteSpmv')->name('spmv.delete');
        });

        Route::prefix('svm')->group(function () {
            Route::post('store', 'storeSvm')->name('svm.store');
            Route::get('list/{noPengenalan}', 'listSvm')->name('svm.list');
            Route::post('update', 'updateSvm')->name('svm.update');
            Route::post('delete/{idSvm}', 'deleteSvm')->name('svm.delete');
        });

        Route::prefix('stpm')->group(function () {
            Route::post('store', 'storeStpm')->name('stpm.store');
            Route::get('list/{noPengenalan}', 'listStpm')->name('stpm.list');
            Route::post('update', 'updateStpm')->name('stpm.update');
            Route::post('delete/{idStpm}', 'deleteStpm')->name('stpm.delete');
        });

        Route::prefix('stam')->group(function () {
            Route::post('store', 'storeStam')->name('stam.store');
            Route::get('list/{noPengenalan}', 'listStam')->name('stam.list');
            Route::post('update', 'updateStam')->name('stam.update');
            Route::post('delete/{idStam}', 'deleteStam')->name('stam.delete');
        });

        Route::prefix('matrikulasi')->group(function () {
            Route::post('store', 'storeMatrikulasi')->name('matrikulasi.store');
            Route::get('list/{noPengenalan}', 'listMatrikulasi')->name('matrikulasi.list');
            Route::post('update', 'updateMatrikulasi')->name('matrikulasi.update');
            Route::post('delete/{idMatrikulasi}', 'deleteMatrikulasi')->name('matrikulasi.delete');
        });

        Route::prefix('skm')->group(function () {
            Route::post('store', 'storeSkm')->name('skm.store');
            Route::get('list/{noPengenalan}', 'listSkm')->name('skm.list');
            Route::post('update', 'updateSkm')->name('skm.update');
            Route::post('delete/{idSkm}', 'deleteSkm')->name('skm.delete');
        });

        Route::prefix('bahasa')->group(function () {
            Route::post('store', 'storeBahasa')->name('bahasa.store');
            Route::get('list/{noPengenalan}', 'listBahasa')->name('bahasa.list');
            Route::post('update', 'updateBahasa')->name('bahasa.update');
            Route::post('delete/{idBahasa}', 'deleteBahasa')->name('bahasa.delete');
        });

        Route::prefix('bakat')->group(function () {
            Route::post('store', 'storeBakat')->name('bakat.store');
            Route::get('list/{noPengenalan}', 'listBakat')->name('bakat.list');
            Route::post('update', 'updateBakat')->name('bakat.update');
            Route::post('delete/{idBakat}', 'deleteBakat')->name('bakat.delete');
        });

        Route::prefix('pengajian_tinggi')->group(function () {
            Route::post('update', 'updatePengajianTinggi')->name('pengajian-tinggi.update');
            Route::get('details/{noPengenalan}', 'pengajianTinggiDetails')->name('pengajian-tinggi.details');
        });

        Route::prefix('experience')->group(function () {
            Route::post('update', 'updateExperience')->name('experience.update');
            Route::get('details/{noPengenalan}', 'experienceDetails')->name('experience.details');
        });

        Route::prefix('psl')->group(function () {
            Route::post('store', 'storePsl')->name('psl.store');
            Route::get('list/{noPengenalan}', 'listPsl')->name('psl.list');
            Route::post('update', 'updatePsl')->name('psl.update');
            Route::post('delete/{idPsl}', 'deletePsl')->name('psl.delete');
        });

        Route::prefix('tentera_polis')->group(function () {
            Route::post('update', 'updateTenteraPolis')->name('tentera-polis.update');
            Route::get('details/{noPengenalan}', 'tenteraPolisDetails')->name('tentera-polis.details');
        });

        Route::prefix('penalty')->group(function () {
            Route::post('store', 'storePenalty')->name('penalty.store');
            Route::get('list/{noPengenalan}', 'listPenalty')->name('penalty.list');
            Route::post('update', 'updatePenalty')->name('penalty.update');
            Route::post('delete/{idPenalty}', 'deletePenalty')->name('penalty.delete');
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

Route::controller(AcronymController::class)->group(function() {
    Route::prefix('acronym')->group(function (){
        Route::get('/', 'index')->name('acronym.index');
        Route::post('search', 'search')->name('acronym.search');
        Route::post('list', 'list')->name('acronym.list');
        Route::get('insertData', 'insertData')->name('acronym.insertData');
        Route::get('updateData', 'updateData')->name('acronym.updateData');
    });
});

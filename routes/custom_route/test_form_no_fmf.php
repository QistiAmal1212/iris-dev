<?php
use App\Http\Controllers\TestFormNoFMFController;

Route::controller(TestFormNoFMFController::class)->group(function () {
    Route::prefix('testFormNoFMF')->group(function () {
        Route::get('', 'listTestForm')->name('testFormNoFMF.listTestForm');

        Route::get('createForm', 'createForm')->name('testFormNoFMF.createForm');
        Route::get('viewForm/{testFormId}', 'viewForm')->name('testFormNoFMF.viewForm');
        Route::post('deleteForm/{testFormId}', 'deleteForm')->name('testFormNoFMF.deleteForm');

        Route::get('viewSectionASubB/{testFormId}', 'viewSectionASubB')->name('testFormNoFMF.viewSectionASubB');
        Route::get('viewSectionASubC/{testFormId}', 'viewSectionASubC')->name('testFormNoFMF.viewSectionASubC');
        Route::post('submitSectionASubA', 'submitSectionASubA')->name('testFormNoFMF.submitSectionASubA');
        Route::post('submitSectionASubB', 'submitSectionASubB')->name('testFormNoFMF.submitSectionASubB');
        Route::post('autosaveSectionASubC/{testForm}', 'autosaveSectionASubC')->name('testFormNoFMF.autosaveSectionASubC');
        Route::post('checkSectionASubC/{testForm}', 'checkSectionASubC')->name('testFormNoFMF.checkSectionASubC');

        Route::get('refreshFamilyTable/{testFormId}', 'refreshFamilyTable')->name('testFormNoFMF.refreshFamilyTable');
        Route::get('openFamilyFormModal/{testFormId}/{testFamilyId?}', 'openFamilyFormModal')->name('testFormNoFMF.openFamilyFormModal');
        Route::post('createFamily', 'createFamily')->name('testFormNoFMF.createFamily');
        Route::post('updateFamily', 'updateFamily')->name('testFormNoFMF.updateFamily');

    });
});

<?php
use App\Http\Controllers\TestFormController;

Route::controller(TestFormController::class)->group(function () {
    Route::prefix('testForm')->group(function () {
        Route::get('', 'index')->name('testForm.index');
        Route::get('list', 'list')->name('testForm.list');
        Route::post('submit', 'submit')->name('testForm.submit');
        Route::post('submitTabASubA', 'submitTabASubA')->name('testForm.submitTabASubA');
        Route::post('submitTabBSubB', 'submitTabBSubB')->name('testForm.submitTabBSubB');
        Route::get('refreshFamilyTable', 'refreshFamilyTable')->name('testForm.refreshFamilyTable');
        Route::get('editFamilyModal/{testTableId?}', 'editFamilyModal')->name('testForm.editFamilyModal');
        Route::post('createFamily', 'createFamily')->name('testForm.createFamily');
        Route::post('updateFamily', 'updateFamily')->name('testForm.updateFamily');

    });
});

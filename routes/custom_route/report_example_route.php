<?php
use App\Http\Controllers\ReportHelpdeskController;
use App\Http\Controllers\FlowManagementController;

Route::controller(ReportHelpdeskController::class)->group(function () {
    Route::prefix('report/helpdesk')->group(function () {
        Route::get('list/{project}', 'viewList')->name('report_helpdesk.list');
        Route::get('borang/{reportHelpdesk?}/{view?}', 'viewBorang')->name('report_helpdesk.viewborang');
        Route::post('updateTitle', 'updateTitle')->name('report_helpdesk.updateTitle');
        Route::post('updateDeclaration', 'updateDeclaration')->name('report_helpdesk.updateDeclaration');
        Route::post('addIssue', 'addIssue')->name('report_helpdesk.addIssue');
        Route::post('autofillFromAPI/{reportHelpdesk}', 'autofillFromAPI')->name('report_helpdesk.autofillFromAPI');
        Route::get('viewIssue/{issue}', 'viewIssue')->name('report_helpdesk.viewIssue');
        Route::delete('deleteIssue/{issue}', 'deleteIssue')->name('report_helpdesk.deleteIssue');
        Route::get('getDataAPI_Issues/{api_issue_id}', 'getDataFromAPIHelpdeskIssues')->name('report_helpdesk.getDataAPI_Issues');
        Route::get('refreshListViewIssueContainer/{reportHelpdesk}', 'refreshListViewIssueContainer')->name('report_helpdesk.refreshListViewIssueContainer');
        Route::get('loadHelpdeskPDF/{id}', 'loadHelpdeskPDF')->name('report_helpdesk.loadPDF');
        Route::get('viewHelpdeskPDF/{id}/{type}', 'viewHelpdeskPDF')->name('report_helpdesk.viewPDF');
        Route::get('send-email/{reportHelpdesk}', 'sendEmail')->name('report_helpdesk.sendEmail');
        Route::get('reloadEmailTab/{reportHelpdesk}', 'reloadEmailTab')->name('report_helpdesk.reloadEmailTab');

    });
});

Route::controller(FlowManagementController::class)->group(function(){
    Route::prefix('flow-management')->group(function () {
        Route::any('show', 'index')->name('flow-management.index');
    });
});


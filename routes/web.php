<?php

use App\Http\Controllers\ActivityLogController;
use App\Http\Controllers\AnnouncementController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\EmailController;
use App\Http\Controllers\FaqController;
use App\Http\Controllers\HolidayController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\InboxController;
use App\Http\Controllers\LanguageController;
use App\Http\Controllers\LogController;
use App\Http\Controllers\NotifyController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\SettingsController;
use App\Http\Controllers\SecurityController;
use App\Http\Controllers\StatisticsController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CaptchaController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
 */

// Route::get('test-ts', [App\Http\Controllers\TestController::class, 'updateTimesheet']);
// Route::get('test-chart', [FinanceController::class, 'manpowerChart']);

Route::get('/', function () {
    return redirect()->route('login');
});

Route::get('emptyresponse', function () {
    return response()->json(['title' => ' ']);
})->name('emptyResponse');

Auth::routes();
Route::controller(LoginController::class)->group(function () {
    // Syntax
    // Route::get('name of link', 'name of function')

    Route::get('logout', 'logout')->name('logout.get');

    Route::prefix('auth/google')->group(function () {
        Route::get('/', 'redirectToProvider')->name('google.redirect');
        Route::get('auth/google/callback', 'handleProviderCallback')->name('google.callback');
    });

});

Route::get('reload-captcha', [CaptchaController::class, 'reloadCaptcha'])->name('reload.captcha');

Route::get('home', [HomeController::class, 'index'])->name('home');

// locale Route
Route::get('lang/{locale}', [LanguageController::class, 'swap']);

Route::get('inbox', [InboxController::class, 'index'])->name('inbox');

Route::controller(StatisticsController::class)->group(function () {
    Route::get('statistics', 'index')->name('statistics');
    Route::post('statistics', 'generateChart')->name('statistics.generate');
});

Route::prefix('profile')->group(function () {
    Route::get('view', [ProfileController::class, 'view'])->name('profile-view');
    Route::post('update', [ProfileController::class, 'update'])->name('profile-update');
});

Route::prefix('admin')->group(function () {
    Route::resource('user', UserController::class);
    Route::resource('role', RoleController::class);

    Route::get('internalUser',[UserController::class,'index'])->name('admin.internalUser');
    Route::get('externalUser',[UserController::class,'index'])->name('admin.externalUser');
    Route::get('getUser/{userId}', [UserController::class,'getUser'])->name('user.getUser');
    Route::post('update-password', [UserController::class,'updatePassword'])->name('updatePassword');
    
    Route::get('edit/{roleId}', [RoleController::class,'getRole'])->name('role.kemaskini');
    Route::get('edittingRole/{roleId}', [RoleController::class, 'getRole'])->name('role.editting');
    Route::post('getMenu', [RoleController::class, 'getMenu'])->name('role.getMenu');
    Route::post('getNextMenu', [RoleController::class, 'getNextMenu'])->name('role.getNextMenu');
    Route::get('editRole/{roleId}', [RoleController::class, 'editRole'])->name('role.editRole');
    Route::post('updateRole/{roleId}', [RoleController::class, 'updateRole'])->name('role.updateRole');

    Route::prefix('settings')->group(function () {
        Route::get('/', [SettingsController::class, 'index'])->name('settings.index');
        Route::post('/', [SettingsController::class, 'update'])->name('admin.settings');
        Route::prefix('save')->group(function () {
            Route::post('/', [SettingsController::class, 'settings_save'])->name('admin.settings.save');
        });
        Route::prefix('checkemail')->group(function () {
            Route::post('/', [SettingsController::class, 'checkEmail'])->name('admin.settings.checkemail');
        });
        Route::get('picture/{filename}', [SettingsController::class, 'picture'])->name('settings.picture');

        Route::prefix('log')->group(function () {
            Route::get('index', [ActivityLogController::class, 'index'])->name('admin-log-index');
            Route::get('view/{logID}', [ActivityLogController::class, 'view'])->name('admin-log-view');
        });

    });

    Route::prefix('security')->group(function () {
        Route::prefix('menu')->group(function () {
            Route::get('/', [SecurityController::class, 'menuIndex'])->name('admin.security.menu');
            Route::get('create', [SecurityController::class, 'menuCreate'])->name('admin.security.menu.create');
            Route::post('store', [SecurityController::class, 'menuStore'])->name('admin.security.menu.store');
            Route::post('link', [SecurityController::class, 'menuLink'])->name('admin.security.menu.link');
        });

        Route::get('access', [SecurityController::class, 'accessIndex'])->name('admin.security.access');

        Route::get('sequence', [SecurityController::class, 'sequenceIndex'])->name('admin.security.sequence');
    });

    Route::prefix('log')->group(function () {
        Route::get('/', [LogController::class, 'index'])->name('admin.log');
        Route::get('{id}', [LogController::class, 'view'])->name('admin.log.view');
    });

    Route::prefix('general')->group(function () {
        Route::resource('announcement', AnnouncementController::class);
        Route::resource('faq', FaqController::class);
        Route::resource('faq', FaqController::class);

        Route::get('refreshFaqTable', [FaqController::class, 'refreshFaqTable'])->name('faq.refreshFaqTable');

        Route::get('refreshAnnouncementTable', [AnnouncementController::class, 'refreshAnnouncementTable'])->name('announcement.refreshAnnouncementTable');

        Route::resource('notify', NotifyController::class);
        Route::get('notify/send/{id}', [NotifyController::class, 'showSendNotification'])->name('notify.send-view');
        Route::post('notify/send/{id}', [NotifyController::class, 'sendNotification'])->name('notify.send');

        Route::resource('holiday', HolidayController::class);
        Route::post('holiday/update_weekend', [HolidayController::class, 'updateWeekend'])->name('holiday.update_weekend');
    });
});

Route::controller(EmailController::class)->group(function () {

    Route::post('addEmail', 'addEmail')->name('email.addEmail');
    Route::delete('deleteEmail', 'deleteEmail')->name('email.deleteEmail');

});

include 'documentation.php';
include 'custom_route/report_example_route.php';
include 'custom_route/test_form.php';
include 'custom_route/test_form_no_fmf.php';

// ROUTE: IRIS
include 'iris.php';
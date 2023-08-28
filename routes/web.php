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
use App\Http\Controllers\GroupRoleController;
use App\Http\Controllers\SettingsController;
use App\Http\Controllers\SecurityController;
use App\Http\Controllers\StatisticsController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CaptchaController;
use App\Http\Controllers\Reference\StateController;
use App\Http\Controllers\Reference\ReligionController;
use App\Http\Controllers\Reference\MaritalStatusController;
use App\Http\Controllers\Reference\DepartmentMinistryController;
use App\Http\Controllers\Reference\SkimController;
use App\Http\Controllers\Reference\InstitutionController;
use App\Http\Controllers\Reference\SpecializationController;
use App\Http\Controllers\Reference\QualificationController;
use App\Http\Controllers\Reference\RaceController;
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
    Route::post('delete-role/{roleId}', [RoleController::class,'deleteRole'])->name('roles.delete');
    Route::get('view-role/{roleId}', [RoleController::class,'viewForm'])->name('roles.view');

    Route::post('getMenu', [RoleController::class, 'getMenu'])->name('role.getMenu');
    Route::post('getNextMenu', [RoleController::class, 'getNextMenu'])->name('role.getNextMenu');
    Route::get('editRole/{roleId}', [RoleController::class, 'editRole'])->name('role.editRole');
    Route::post('updateRole/{roleId}', [RoleController::class, 'updateRole'])->name('role.updateRole');

    Route::prefix('group_role')->group(function () {
        Route::get('/', [GroupRoleController::class, 'index'])->name('admin.group-role');

        Route::get('edit/{roleId}', [GroupRoleController::class, 'edit'])->name('admin.group-role.edit');
        Route::get('getRole/{roleId}', [GroupRoleController::class, 'getRole'])->name('admin.group-role.getRole');
    });

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

    Route::prefix('reference')->group(function () {
        Route::prefix('state')->group(function () {
            Route::get('/', [StateController::class, 'index'])->name('admin.reference.state');
            Route::post('create', [StateController::class, 'store'])->name('admin.reference.state.store');
            Route::get('edit/{stateId}', [StateController::class, 'edit'])->name('admin.reference.state.edit');
            Route::post('update/{stateId}', [StateController::class, 'update'])->name('admin.reference.state.update');
        });

        Route::prefix('religion')->group(function () {
            Route::get('/', [ReligionController::class, 'index'])->name('admin.reference.religion');
            Route::post('create', [ReligionController::class, 'store'])->name('admin.reference.religion.store');
            Route::get('edit/{religionId}', [ReligionController::class, 'edit'])->name('admin.reference.religion.edit');
            Route::post('update/{religionId}', [ReligionController::class, 'update'])->name('admin.reference.religion.update');
        });

        Route::prefix('marital_status')->group(function () {
            Route::get('/', [MaritalStatusController::class, 'index'])->name('admin.reference.marital-status');
            Route::post('create', [MaritalStatusController::class, 'store'])->name('admin.reference.marital-status.store');
            Route::get('edit/{maritalStatusId}', [MaritalStatusController::class, 'edit'])->name('admin.reference.marital-status.edit');
            Route::post('update/{maritalStatusId}', [MaritalStatusController::class, 'update'])->name('admin.reference.marital-status.update');
        });

        Route::prefix('department_ministry')->group(function () {
            Route::get('/', [DepartmentMinistryController::class, 'index'])->name('admin.reference.department-ministry');
            Route::post('create', [DepartmentMinistryController::class, 'store'])->name('admin.reference.department-ministry.store');
            Route::get('edit/{departmentMinistryId}', [DepartmentMinistryController::class, 'edit'])->name('admin.reference.department-ministry.edit');
            Route::post('update/{departmentMinistryId}', [DepartmentMinistryController::class, 'update'])->name('admin.reference.department-ministry.update');
        });

        Route::prefix('skim')->group(function () {
            Route::get('/', [SkimController::class, 'index'])->name('admin.reference.skim');
            Route::post('create', [SkimController::class, 'store'])->name('admin.reference.skim.store');
            Route::get('edit/{skimId}', [SkimController::class, 'edit'])->name('admin.reference.skim.edit');
            Route::post('update/{skimId}', [SkimController::class, 'update'])->name('admin.reference.skim.update');
        });

        Route::prefix('institution')->group(function () {
            Route::get('/', [InstitutionController::class, 'index'])->name('admin.reference.institution');
            Route::post('create', [InstitutionController::class, 'store'])->name('admin.reference.institution.store');
            Route::get('edit/{institutionId}', [InstitutionController::class, 'edit'])->name('admin.reference.institution.edit');
            Route::post('update/{institutionId}', [InstitutionController::class, 'update'])->name('admin.reference.institution.update');
        });

        Route::prefix('specialization')->group(function () {
            Route::get('/', [SpecializationController::class, 'index'])->name('admin.reference.specialization');
            Route::post('create', [SpecializationController::class, 'store'])->name('admin.reference.specialization.store');
            Route::get('edit/{specializationId}', [SpecializationController::class, 'edit'])->name('admin.reference.specialization.edit');
            Route::post('update/{specializationId}', [SpecializationController::class, 'update'])->name('admin.reference.specialization.update');
        });

        Route::prefix('qualification')->group(function () {
            Route::get('/', [QualificationController::class, 'index'])->name('admin.reference.qualification');
            Route::post('create', [QualificationController::class, 'store'])->name('admin.reference.qualification.store');
            Route::get('edit/{qualificationId}', [QualificationController::class, 'edit'])->name('admin.reference.qualification.edit');
            Route::post('update/{qualificationId}', [QualificationController::class, 'update'])->name('admin.reference.qualification.update');
        });

        Route::prefix('race')->group(function () {
            Route::get('/', [RaceController::class, 'index'])->name('admin.reference.race');
            Route::post('create', [RaceController::class, 'store'])->name('admin.reference.race.store');
            Route::get('edit/{raceId}', [RaceController::class, 'edit'])->name('admin.reference.race.edit');
            Route::post('update/{raceId}', [RaceController::class, 'update'])->name('admin.reference.race.update');
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

<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Backend\Auth\LoginController;
use App\Http\Controllers\Backend\Auth\ResetPasswordController;
use App\Http\Controllers\Backend\Auth\ForgotPasswordController;
use App\Http\Controllers\Backend\DashboardsController;
use App\Http\Controllers\Backend\AdminsController;
use App\Http\Controllers\Backend\RolesController;
use App\Http\Controllers\Backend\BlogsController;
use App\Http\Controllers\Backend\ContactsController;
use App\Http\Controllers\Backend\CacheController;
use App\Http\Controllers\Backend\ExamController;
use App\Http\Controllers\Backend\ProductvtController;
use App\Http\Controllers\Backend\CheckTensionController;
use App\Http\Controllers\Backend\LanguagesController;
use App\Http\Controllers\Backend\SettingsController;

/*
|--------------------------------------------------------------------------
| Backend Routes
|--------------------------------------------------------------------------
|
| Admin Panel Route List
|
*/

Route::get('/', [DashboardsController::class, 'index'])->name('index');

// Login Routes
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login/submit', [LoginController::class, 'login'])->name('login.submit');
Route::post('/logout/submit', [LoginController::class, 'logout'])->name('logout');

// Reset Password Routes
Route::get('/password/reset', [ForgotPasswordController::class, 'showLinkRequestForm'])->name('password.request');
Route::post('/password/reset', [ResetPasswordController::class, 'reset'])->name('password.update');

/**
 * Admin Management Routes
 */
Route::group(['prefix' => ''], function () {
    Route::resource('admins', AdminsController::class);
    Route::get('admins/trashed/view', [AdminsController::class, 'trashed'])->name('admins.trashed');
    Route::get('profile/edit', [AdminsController::class, 'editProfile'])->name('admins.profile.edit');
    Route::put('profile/update', [AdminsController::class, 'updateProfile'])->name('admins.profile.update');
    Route::delete('admins/trashed/destroy/{id}', [AdminsController::class, 'destroyTrash'])->name('admins.trashed.destroy');
    Route::put('admins/trashed/revert/{id}', [AdminsController::class, 'revertFromTrash'])->name('admins.trashed.revert');
});

/**
 * Role & Permission Management Routes
 */
Route::group(['prefix' => ''], function () {
    Route::resource('roles', RolesController::class);
});

/**
 * Blog Management Routes
 */
Route::group(['prefix' => ''], function () {
    Route::resource('blogs', BlogsController::class);
    Route::get('blogs/trashed/view', [BlogsController::class, 'trashed'])->name('blogs.trashed');
    Route::delete('blogs/trashed/destroy/{id}', [BlogsController::class, 'destroyTrash'])->name('blogs.trashed.destroy');
    Route::put('blogs/trashed/revert/{id}', [BlogsController::class, 'revertFromTrash'])->name('blogs.trashed.revert');
});


Route::namespace('App\Http\Controllers\Backend')->group(function () {
    /**
     * Exam Management Routes
     */
    Route::prefix('exams')->name('exams.')->group(function () {
        Route::get('', 'ExamController@index')->name('index');
        Route::get('/audit', 'ExamController@index1')->name('audit');
        Route::get('create', 'ExamController@create')->name('create');
        Route::get('show/{id}', 'ExamController@show')->name('show');
        Route::get('exportExcel', 'ExamController@exportExcel')->name('exportExcel');
        Route::get('AuditExport', 'ExamController@exportExcelAudit')->name('exportExcelAudit');
        Route::post('action', 'ExamController@action')->name('action');
        Route::delete('trashed/destroy/{id}', 'ExamController@destroyTrash')->name('trashed.destroy');
        Route::get('trashed/view', 'ExamController@trashed')->name('trashed');
        Route::put('trashed/revert/{id}', 'ExamController@revertFromTrash')->name('trashed.revert');
    });
    /**
     * Department Management Routes
     */
    Route::prefix('departments')->name('departments.')->group(function () {
        Route::get('', 'DepartmentController@index')->name('index');
        Route::get('create', 'DepartmentController@create')->name('create');
        Route::get('edit/{id}', 'DepartmentController@edit')->name('edit');
        Route::get('exportExcel', 'DepartmentController@exportExcel')->name('exportExcel');
        Route::post('save', 'DepartmentController@save')->name('save');
        Route::post('update', 'DepartmentController@update')->name('update');
        Route::post('action', 'DepartmentController@action')->name('action');
        Route::put('trashed/revert/{id}', 'DepartmentController@revertFromTrash')->name('trashed.revert');
        Route::delete('trashed/destroy/{id}', 'DepartmentController@destroyTrash')->name('trashed.destroy');
    });


    /**
     * Acivity Management Routes
     */
    Route::prefix('activitys')->name('activitys.')->group(function () {
        Route::get('', 'ActivityController@index')->name('index');
        Route::get('create', 'ActivityController@create')->name('create');
        Route::get('edit/{id}', 'ActivityController@edit')->name('edit');
        Route::get('exportExcel', 'ActivityController@exportExcel')->name('exportExcel');
        Route::post('save', 'ActivityController@save')->name('save');
        Route::post('update', 'ActivityController@update')->name('update');
        Route::post('action', 'ActivityController@action')->name('action');
        Route::put('trashed/revert/{id}', 'ActivityController@revertFromTrash')->name('trashed.revert');
        Route::delete('trashed/destroy/{id}', 'ActivityController@destroyTrash')->name('trashed.destroy');
    });

    /**
     * Campaign Management Routes
     */
    Route::prefix('campaigns')->name('campaigns.')->group(function () {
        Route::get('', 'CampaignController@index')->name('index');
        Route::get('create', 'CampaignController@create')->name('create');
        Route::get('edit/{id}', 'CampaignController@edit')->name('edit');
        Route::get('exportExcel', 'CampaignController@exportExcel')->name('exportExcel');
        Route::post('save', 'CampaignController@save')->name('save');
        Route::post('update', 'CampaignController@update')->name('update');
        Route::post('action', 'CampaignController@action')->name('action');
        Route::put('trashed/revert/{id}', 'CampaignController@revertFromTrash')->name('trashed.revert');
        Route::delete('trashed/destroy/{id}', 'CampaignController@destroyTrash')->name('trashed.destroy');
    });

    /**
     * CampaignDetails Management Routes
     */
    Route::prefix('campaignDetails')->name('campaignDetails.')->group(function () {
        Route::get('', 'CampaignDetailController@index')->name('index');
        Route::get('create', 'CampaignDetailController@create')->name('create');
        Route::get('edit/{id}', 'CampaignDetailController@edit')->name('edit');
        Route::get('exportExcel', 'CampaignDetailController@exportExcel')->name('exportExcel');
        Route::post('save', 'CampaignDetailController@save')->name('save');
        Route::post('update', 'CampaignDetailController@update')->name('update');
        Route::post('action', 'CampaignDetailController@action')->name('action');
        Route::put('trashed/revert/{id}', 'CampaignDetailController@revertFromTrash')->name('trashed.revert');
        Route::delete('trashed/destroy/{id}', 'CampaignDetailController@destroyTrash')->name('trashed.destroy');
    });

    /**
     * Comment Management Routes
     */
    Route::prefix('comments')->name('comments.')->group(function () {
        Route::get('', 'CommentController@index')->name('index');
        Route::get('create', 'CommentController@create')->name('create');
        Route::get('edit/{id}', 'CommentController@edit')->name('edit');
        Route::get('exportExcel', 'CommentController@exportExcel')->name('exportExcel');
        Route::post('save', 'CommentController@save')->name('save');
        Route::post('update', 'CommentController@update')->name('update');
        Route::post('action', 'CommentController@action')->name('action');
        Route::put('trashed/revert/{id}', 'CommentController@revertFromTrash')->name('trashed.revert');
        Route::delete('trashed/destroy/{id}', 'CommentController@destroyTrash')->name('trashed.destroy');
    });

    /**
     * Cronjob Management Routes
     */
    Route::prefix('cronjobs')->name('cronjobs.')->group(function () {
        Route::get('', 'CronjobController@index')->name('index');
        Route::get('create', 'CronjobController@create')->name('create');
        Route::get('edit/{id}', 'CronjobController@edit')->name('edit');
        Route::get('exportExcel', 'CronjobController@exportExcel')->name('exportExcel');
        Route::post('save', 'CronjobController@save')->name('save');
        Route::post('update', 'CronjobController@update')->name('update');
        Route::post('action', 'CronjobController@action')->name('action');
        Route::put('trashed/revert/{id}', 'CronjobController@revertFromTrash')->name('trashed.revert');
        Route::delete('trashed/destroy/{id}', 'CronjobController@destroyTrash')->name('trashed.destroy');
    });

    /**
     * Employee Management Routes
     */
    Route::prefix('employees')->name('employees.')->group(function () {
        Route::get('', 'EmployeeController@index')->name('index');
        Route::get('create', 'EmployeeController@create')->name('create');
        Route::get('edit/{id}', 'EmployeeController@edit')->name('edit');
        Route::get('exportExcel', 'EmployeeController@exportExcel')->name('exportExcel');
        Route::post('save', 'EmployeeController@save')->name('save');
        Route::post('update', 'EmployeeController@update')->name('update');
        Route::post('action', 'EmployeeController@action')->name('action');
        Route::put('trashed/revert/{id}', 'EmployeeController@revertFromTrash')->name('trashed.revert');
        Route::delete('trashed/destroy/{id}', 'EmployeeController@destroyTrash')->name('trashed.destroy');
    });

    /**
     * Employee Department Management Routes
     */
    Route::prefix('employeeDepartments')->name('employeeDepartments.')->group(function () {
        Route::get('', 'EmployeeDepartmentController@index')->name('index');
        Route::get('create', 'EmployeeDepartmentController@create')->name('create');
        Route::get('edit/{id}', 'EmployeeDepartmentController@edit')->name('edit');
        Route::get('exportExcel', 'EmployeeDepartmentController@exportExcel')->name('exportExcel');
        Route::post('save', 'EmployeeDepartmentController@save')->name('save');
        Route::post('update', 'EmployeeDepartmentController@update')->name('update');
        Route::post('action', 'EmployeeDepartmentController@action')->name('action');
        Route::put('trashed/revert/{id}', 'EmployeeDepartmentController@revertFromTrash')->name('trashed.revert');
        Route::delete('trashed/destroy/{id}', 'EmployeeDepartmentController@destroyTrash')->name('trashed.destroy');
    });

    /**
     * Log Import Management Routes
     */
    Route::prefix('logImports')->name('logImports.')->group(function () {
        Route::get('', 'LogImportController@index')->name('index');
        Route::get('create', 'LogImportController@create')->name('create');
        Route::get('edit/{id}', 'LogImportController@edit')->name('edit');
        Route::get('exportExcel', 'LogImportController@exportExcel')->name('exportExcel');
        Route::post('save', 'LogImportController@save')->name('save');
        Route::post('update', 'LogImportController@update')->name('update');
        Route::post('action', 'LogImportController@action')->name('action');
        Route::put('trashed/revert/{id}', 'LogImportController@revertFromTrash')->name('trashed.revert');
        Route::delete('trashed/destroy/{id}', 'LogImportController@destroyTrash')->name('trashed.destroy');
    });

    /**
     * Required Management Routes
     */
    Route::prefix('requireds')->name('requireds.')->group(function () {
        Route::get('', 'RequiredController@index')->name('index');
        Route::get('create', 'RequiredController@create')->name('create');
        Route::get('edit/{id}', 'RequiredController@edit')->name('edit');
        Route::get('exportExcel', 'RequiredController@exportExcel')->name('exportExcel');
        Route::post('save', 'RequiredController@save')->name('save');
        Route::post('update', 'RequiredController@update')->name('update');
        Route::post('action', 'RequiredController@action')->name('action');
        Route::put('trashed/revert/{id}', 'RequiredController@revertFromTrash')->name('trashed.revert');
        Route::delete('trashed/destroy/{id}', 'RequiredController@destroyTrash')->name('trashed.destroy');
    });

    /**
     * Signature Submission Management Routes
     */
    Route::prefix('signatureSubmissions')->name('signatureSubmissions.')->group(function () {
        Route::get('', 'SignatureSubmissionController@index')->name('index');
        Route::get('create', 'SignatureSubmissionController@create')->name('create');
        Route::get('edit/{id}', 'SignatureSubmissionController@edit')->name('edit');
        Route::get('exportExcel', 'SignatureSubmissionController@exportExcel')->name('exportExcel');
        Route::post('save', 'SignatureSubmissionController@save')->name('save');
        Route::post('update', 'SignatureSubmissionController@update')->name('update');
        Route::post('action', 'SignatureSubmissionController@action')->name('action');
        Route::put('trashed/revert/{id}', 'SignatureSubmissionController@revertFromTrash')->name('trashed.revert');
        Route::delete('trashed/destroy/{id}', 'SignatureSubmissionController@destroyTrash')->name('trashed.destroy');
    });
});


/**
 * Contact Routes
 */
Route::group(['prefix' => ''], function () {
    Route::resource('contacts', ContactsController::class);
});

/**
 * Settings Management Routes
 */
Route::group(['prefix' => 'settings'], function () {
    Route::get('/', [SettingsController::class, 'index'])->name('settings.index');
    Route::put('/update', [SettingsController::class, 'update'])->name('settings.update');
    Route::resource('languages', LanguagesController::class);
});

/**
 * Productivity Management Routes
 */
Route::group(['prefix' => 'productvt'], function () {
    Route::get('', [ProductvtController::class, 'index'])->name('productvt.index');
    Route::get('/user-input', [ProductvtController::class, 'UserInput'])->name('productvt.user-input');
    Route::get('/edit', [ProductvtController::class, 'ProductvtEdit'])->name('productvt.edit');
    Route::post('', [ProductvtController::class, 'ProductvtData'])->name('productvt.view');
});

/**
 * 張力を確認してください / Kiểm tra sức căng / Check Tension
 */

Route::group(['prefix' => 'checkTension'], function () {
    Route::get('/', [CheckTensionController::class, 'index'])->name('checkTension.index');
    Route::post('/complete', [CheckTensionController::class, 'saveData'])->name('checkTension.complete');
    Route::get('/view', [CheckTensionController::class, 'viewData'])->name('checkTension.view');
    Route::get('/exportExcel', [CheckTensionController::class, 'exportExcel'])->name('checkTension.exportExcel');
});

Route::get('reset-cache', [CacheController::class, 'reset_cache']);

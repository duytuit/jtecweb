<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Frontend\FrontPagesController;
use App\Http\Controllers\Frontend\PrintMakuController;
use Illuminate\Support\Facades\Auth;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
/*
|--------------------------------------------------------------------------
| Web Routes - Frontend routes.
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Auth::routes();
Route::get('qrcode', [App\Http\Controllers\QrcodeController::class, 'index']);
Route::get('qrcode/export', [App\Http\Controllers\QrcodeController::class], 'QrExportExcel')->name('QrExportExcel');
Route::post('qrcode/printfile', [App\Http\Controllers\QrcodeController::class, 'QrCodePrint'])->name('QrCodePrint');
Route::get('qrcode/printfile', [App\Http\Controllers\QrcodeController::class, 'GetDataPrint']);
Route::post('qrcode', [App\Http\Controllers\QrcodeController::class, 'importQrcodeData']);
Route::post('qrcode/generate', [App\Http\Controllers\QrcodeController::class, 'QrcodeGenerate']);

Route::post('qrcode/printfile2', [App\Http\Controllers\QrcodeController::class, 'QrCodePrint2'])->name('QrCodePrint2');
Route::get('qrcode/printfile2', [App\Http\Controllers\QrcodeController::class, 'GetDataPrint2']);

Route::get('question/import', [App\Http\Controllers\QuestionController::class, 'index']);
Route::post('question/import', [App\Http\Controllers\QuestionController::class, 'importExcelData']);

//print maku
Route::get('printMaku', [PrintMakuController::class, 'index'])->name('printMaku');

Route::get('/', [FrontPagesController::class, 'index'])->name('index');
Route::get('/exam', [FrontPagesController::class, 'exam'])->name('exam');

// New exam
Route::get('/examNew', [FrontPagesController::class, 'examNew'])->name('examNew');

Route::post('/exam/detailReport', [FrontPagesController::class, 'detailReport'])->name('exam.detailReport');
Route::post('/exam/detailReport1', [FrontPagesController::class, 'detailReport1'])->name('exam.detailReport1');
Route::get('/test', [FrontPagesController::class, 'test'])->name('test');
Route::get('/test1', [FrontPagesController::class, 'test1'])->name('test1');
Route::post('/exam/store', [FrontPagesController::class, 'store'])->name('exam.store');
Route::post('/exam/storeNew', [FrontPagesController::class, 'storeNew'])->name('exam.storeNew');
Route::get('/ImportEmp', function () {
    return view('frontend.pages.import_emp');
});
Route::post('/ImportEmpPost', [FrontPagesController::class, 'ImportEmpPost'])->name('exam.ImportEmpPost');

<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Frontend\FrontPagesController;
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
Route::post('qrcode',[App\Http\Controllers\QrcodeController::class, 'importQrcodeData']);
Route::get('question/import', [App\Http\Controllers\QuestionController::class, 'index']);
Route::post('question/import',[App\Http\Controllers\QuestionController::class, 'importExcelData']);


Route::get( '/', [ FrontPagesController::class, 'index' ] )->name( 'index' );
Route::get( '/exam', [ FrontPagesController::class, 'exam' ] )->name( 'exam' );
Route::get( '/test', [ FrontPagesController::class, 'test' ] )->name( 'test' );
Route::get( '/test1', [ FrontPagesController::class, 'test1' ] )->name( 'test1' );
Route::post('/exam/store', [FrontPagesController::class, 'store'])->name('exam.store');




// Route::get('/', function () {
//     return view('form');
// });

Route::post('upload', function (Request $request) {
    if (!$request->hasFile('image')) {
        return "Mời chọn file cần upload";
    }
    $image = $request->file('image');
    $storedPath = $image->move('images', $image->getClientOriginalName());
    return "Lưu trữ thành công";
})->name('upload.handle');
<<<<<<< HEAD
=======



// Route::get('qr-code', function () {
//     return QrCode::size(500)->generate('Welcome to kerneldev.com!');
// });
>>>>>>> b34e37073ee5d41bbc1b6e47d15bd1689fd851ae

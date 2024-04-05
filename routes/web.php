<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Frontend\FrontPagesController;
use Illuminate\Support\Facades\Auth;

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
Route::get( '/', [ FrontPagesController::class, 'index' ] )->name( 'index' );
Route::get( '/exam', [ FrontPagesController::class, 'exam' ] )->name( 'exam' );
Route::get( '/test', [ FrontPagesController::class, 'test' ] )->name( 'test' );
Route::get( '/test1', [ FrontPagesController::class, 'test1' ] )->name( 'test1' );
Route::post('/exam/store', [FrontPagesController::class, 'store'])->name('exam.store');

<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DocController;

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


Route::get('/document/printall', [DocController::class, 'printall'])->name('document.printall');
Route::get('/document/{id}', [DocController::class, 'show'])->name('document');
Route::get('/view/document/create',[DocController::class, 'create'])->name('document.create');
Route::post('/document', [DocController::class, 'store'])->name('document.store');
Route::get('/view/document', [DocController::class, 'index'])->name('document.index');

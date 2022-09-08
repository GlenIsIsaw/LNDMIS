<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DocController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ListOfTrainingController;

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
Route::get('/', function(){
    return view('welcome');
});

Route::get('/document/printall', [DocController::class, 'printall'])->name('document.printall');
Route::get('/document/{id}', [DocController::class, 'show'])->name('document');
Route::get('/view/document/create',[DocController::class, 'create'])->name('document.create');
Route::post('/document', [DocController::class, 'store'])->name('document.store');
Route::get('/view/document', [DocController::class, 'index'])->name('document.index');

Route::get('/trainings', [ListOfTrainingController::class, 'index'])->name('training.index');
Route::get('/trainings/create', [ListOfTrainingController::class, 'create'])->name('training.create');
Route::post('/trainings', [ListOfTrainingController::class, 'store'])->name('training.store');

Route::get('/register', [UserController::class, 'create'])->name('user.register');

Route::post('/user', [UserController::class, 'store'])->name('user.store');
Route::post('/logout', [UserCOntroller::class, 'logout']);
Route::get('/login', [UserController::class, 'login']);
Route::post('/users/authenticate', [UserController::class, 'authenticate']);

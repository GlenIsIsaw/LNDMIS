<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DocController;
use App\Http\Controllers\IDPController;
use App\Http\Controllers\HomeController;
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
    return view('coorddashboard');
});

Route::get('/document/printall', [DocController::class, 'printall'])->name('document.printall');
Route::get('/document/{id}', [DocController::class, 'show'])->name('document');
Route::get('/view/document/create',[DocController::class, 'create'])->name('document.create');
Route::post('/document', [DocController::class, 'store'])->name('document.store');
Route::get('/view/document', [DocController::class, 'index'])->name('document.index');

Route::middleware(['auth','isCoordinator'])->group(function () {
    
    Route::post('/trainings/printall', [ListOfTrainingController::class, 'printall'])->name('training.printall');
    Route::get('/trainings', [ListOfTrainingController::class, 'index'])->name('training.index');
    Route::get('/coordinator/dashboard', [HomeController::class, 'coordindex']);





    
});

Route::middleware(['auth'])->group(function () {

Route::get('/training', [ListOfTrainingController::class, 'empindex']);
Route::get('/trainings/create', [ListOfTrainingController::class, 'create'])->name('trainings.create');
Route::post('/trainings', [ListOfTrainingController::class, 'store'])->name('training.store');
Route::get('/trainings/{id}', [ListOfTrainingController::class, 'show'])->name('training.show');
Route::get('/trainings/{id}/edit',[ListOfTrainingController::class, 'edit']);
Route::put('/trainings/{id}',[ListOfTrainingController::class, 'update']);
Route::delete('/trainings/{id}',[ListOfTrainingController::class, 'destroy']);

Route::get('/home', [HomeController::class, 'index']);

Route::post('/logout', [UserCOntroller::class, 'logout']);

});

Route::get('/idp/print/{id}', [IDPController::class, 'print']);



Auth::routes();




Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Auth::routes();

Route::get('/home', 'App\Http\Controllers\HomeController@index')->name('home');

Route::group(['middleware' => 'auth'], function () {
	Route::resource('user', 'App\Http\Controllers\UserController', ['except' => ['show']]);
	Route::get('profile', ['as' => 'profile.edit', 'uses' => 'App\Http\Controllers\ProfileController@edit']);
	Route::put('profile', ['as' => 'profile.update', 'uses' => 'App\Http\Controllers\ProfileController@update']);
	Route::put('profile/password', ['as' => 'profile.password', 'uses' => 'App\Http\Controllers\ProfileController@password']);
	Route::get('{page}', ['as' => 'page.index', 'uses' => 'App\Http\Controllers\PageController@index']);
});


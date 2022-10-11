<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\IDPController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AttendanceFormController;
use App\Http\Controllers\CompetencyController;
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


Route::middleware(['auth','isCoordinator'])->group(function () {
    Route::get('/users', [UserController::class, 'index']);
});

Route::middleware(['auth'])->group(function () {

    Route::get('/', function(){
        return view('main-page');
    })->name('main');


});






Auth::routes();


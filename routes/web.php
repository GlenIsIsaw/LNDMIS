<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\IDPController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AttendanceFormController;
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

Route::middleware(['auth','isCoordinator'])->group(function () {
    
    Route::post('/trainings/printall', [ListOfTrainingController::class, 'printall'])->name('training.printall');
    Route::get('/trainings', [ListOfTrainingController::class, 'index'])->name('training.index');
});

Route::middleware(['auth'])->group(function () {

Route::get('/training', [ListOfTrainingController::class, 'empindex'])->name('training.empindex');;
Route::get('/trainings/create', [ListOfTrainingController::class, 'create'])->name('trainings.create');
Route::post('/trainings', [ListOfTrainingController::class, 'store'])->name('training.store');
Route::get('/trainings/{id}', [ListOfTrainingController::class, 'show'])->name('training.show');
Route::get('/trainings/{id}/edit',[ListOfTrainingController::class, 'edit'])->name('training.edit');
Route::put('/trainings/{id}',[ListOfTrainingController::class, 'update'])->name('training.update');
Route::delete('/trainings/{id}',[ListOfTrainingController::class, 'destroy'])->name('training.destroy');

Route::get('/attendance/create', [AttendanceFormController::class, 'create'])->name('attendance.create');
Route::post('/attendance', [AttendanceFormController::class, 'store'])->name('attendance.store');
Route::get('/attendance/{id}', [AttendanceFormController::class, 'show'])->name('attendance.show');
Route::get('/attendance/{id}/edit',[AttendanceFormController::class, 'edit'])->name('attendance.edit');
Route::put('/attendance/{id}',[AttendanceFormController::class, 'update'])->name('attendance.update');
Route::delete('/attendance/{id}',[AttendanceFormController::class, 'destroy'])->name('attendance.destroy');
Route::post('/attendance/{id}/print', [AttendanceFormController::class, 'print'])->name('attendance.print');

Route::get('/idp/create', [IDPController::class, 'create'])->name('idp.create');
Route::post('/idp', [IDPController::class, 'store'])->name('idp.store');
Route::get('/idp', [IDPController::class, 'empindex'])->name('idp.empindex');
Route::get('/idp/{id}', [IDPController::class, 'show'])->name('idp.show');
Route::get('/idp/{id}/edit', [IDPController::class, 'edit'])->name('idp.edit');
Route::put('/idp/{id}', [IDPController::class, 'update'])->name('idp.update');
Route::put('/idp/submit/{id}', [IDPController::class, 'submit'])->name('idp.submit');
Route::post('/idp/print/{id}', [IDPController::class, 'print'])->name('idp.print');

Route::get('/home', [HomeController::class, 'index']);

Route::post('/logout', [UserCOntroller::class, 'logout']);
Route::get('/user/{id}/edit', [UserCOntroller::class, 'edit']);
Route::put('/user/{id}', [UserCOntroller::class, 'update']);

});





Auth::routes();

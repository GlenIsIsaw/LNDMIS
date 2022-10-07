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
    
    Route::post('/trainings/printall', [ListOfTrainingController::class, 'printall'])->name('training.printall');
    Route::get('/trainings', [ListOfTrainingController::class, 'index'])->name('training.index');
    Route::get('/trainings/queue', [ListOfTrainingController::class, 'queue'])->name('training.queue');
    Route::put('/trainings/{id}/approve', [ListOfTrainingController::class, 'approve'])->name('training.approve');
    Route::put('/trainings/{id}/reject', [ListOfTrainingController::class, 'reject'])->name('training.reject');
    Route::get('/competencies',[CompetencyController::class, 'index'])->name('competency.index');
    Route::get('/coordinator/training/menu', function () { return view('coordinator.training_menu'); })->name('training.menu');

    Route::get('/idps', [IDPController::class, 'index'])->name('idp.index');
    Route::get('/idps/queue', [IDPController::class, 'queue'])->name('idp.queue');
    Route::put('/idps/{id}/approve', [IDPController::class, 'approve'])->name('idp.approve');
    Route::put('/idps/{id}/reject', [IDPController::class, 'reject'])->name('idp.reject');
    Route::delete('/idps/{id}',[AttendanceFormController::class, 'idp'])->name('idp.destroy');
    Route::get('/coordinator/idp/menu', function () { return view('coordinator.idp_menu'); })->name('idp.menu');

    Route::get('/users', [UserController::class, 'index']);


});

Route::middleware(['auth'])->group(function () {

    Route::get('/empTraining', function(){
        return view('trainings.emptraining');
    })->name('training.empTraining');
    Route::get('/empIDP', function(){
        return view('idp.empIDP');
    })->name('idp.empIDP');
    

    Route::get('/training', [ListOfTrainingController::class, 'empindex'])->name('training.empindex');;
    Route::get('/trainings/create', [ListOfTrainingController::class, 'create'])->name('trainings.create');
    Route::post('/trainings', [ListOfTrainingController::class, 'store'])->name('training.store');
    Route::get('/trainings/{id}', [ListOfTrainingController::class, 'show'])->name('training.show');
    Route::get('/trainings/{id}/edit',[ListOfTrainingController::class, 'edit'])->name('training.edit');
    Route::put('/trainings/{id}/update',[ListOfTrainingController::class, 'update'])->name('training.update');
    Route::delete('/trainings/{id}',[ListOfTrainingController::class, 'destroy'])->name('training.destroy');
    Route::put('/trainings/{id}/submit', [ListOfTrainingController::class, 'submit'])->name('training.submit');

    Route::get('/attendance/{id}/create', [AttendanceFormController::class, 'create'])->name('attendance.create');
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
    Route::put('/idp/{id}/submit', [IDPController::class, 'submit'])->name('idp.submit');
    Route::post('/idp/print/{id}', [IDPController::class, 'print'])->name('idp.print');

    Route::get('/competency',[CompetencyController::class, 'empindex'])->name('competency.empindex');


    Route::get('/', [HomeController::class, 'index']);

    Route::post('/logout', [UserCOntroller::class, 'logout']);

});






Auth::routes();


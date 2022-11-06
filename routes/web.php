<?php

use App\Http\Livewire\Main;
use App\Http\Livewire\IdpShow;
use App\Http\Livewire\Profile;
use App\Http\Livewire\UserShow;
use App\Http\Livewire\Dashboard;
use App\Http\Livewire\IdpReports;
use App\Http\Livewire\TrainingShow;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Livewire\TrainingReports;
use App\Http\Livewire\AttendanceReports;
use App\Http\Livewire\CertificateReports;

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
    Route::get('/idp/Reports', IdpReports::class);
    Route::get('/training/Reports', TrainingReports::class);
    Route::get('/attendance/Reports', AttendanceReports::class);
    Route::get('/certificate/Reports', CertificateReports::class);
    Route::get('/user', UserShow::class);

});

Route::middleware(['auth'])->group(function () {

    Route::get('/', Dashboard::class);
    Route::get('/training', TrainingShow::class);
    Route::get('/idp', IdpShow::class);
    Route::get('/profile', Profile::class);

    /*Route::get('/trainings', function(){
        return view('trainings.index');
    }); */


});






Auth::routes();


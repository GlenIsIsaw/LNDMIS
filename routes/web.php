<?php

use App\Http\Livewire\Main;
use App\Http\Livewire\Dashboard;
use App\Http\Livewire\idp\IdpShow;

use App\Http\Livewire\user\Profile;
use App\Http\Livewire\User\UserShow;

use Illuminate\Support\Facades\Auth;
use App\Http\Livewire\idp\IdpReports;
use Illuminate\Support\Facades\Route;
use App\Http\Livewire\Training\TrainingShow;
use App\Http\Livewire\Training\TrainingReports;
use App\Http\Livewire\Training\CertificateReports;
use App\Http\Livewire\attendance\AttendanceReports;

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


<?php


use App\Http\Livewire\Dashboard;
use App\Http\Livewire\college\CollegeShow;

use App\Http\Livewire\Idp\IdpShow;
use App\Http\Livewire\Qem\QemShow;
use App\Http\Livewire\User\Profile;
use App\Http\Livewire\User\UserShow;
use Illuminate\Support\Facades\Auth;
use App\Http\Livewire\Idp\IdpReports;

use Illuminate\Support\Facades\Route;
use App\Http\Livewire\Training\TrainingShow;
use App\Http\Livewire\Training\TrainingReports;
use App\Http\Livewire\Training\CertificateReports;
use App\Http\Livewire\Attendance\AttendanceReports;
use App\Http\Livewire\Idp\IdpCompletion;
use App\Http\Livewire\IncomingTrainingsShow;

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
    Route::get('/lnd-monitoring', AttendanceReports::class);
    Route::get('/certificate/Reports', CertificateReports::class);
    Route::get('/local-lnd-plan', IdpCompletion::class);
    

});

Route::middleware(['auth','isSupervisor'])->group(function () {
    Route::get('/qem/trainings', QemShow::class);

});

Route::middleware(['auth','isClerk'])->group(function () {
    Route::get('/invitation', IncomingTrainingsShow::class);

});

Route::middleware(['auth','isLndEmployee'])->group(function () {
    Route::get('/user', UserShow::class);
});

Route::middleware(['auth','isOfficer'])->group(function () {
    Route::get('/college', CollegeShow::class);
});

Route::middleware(['auth', 'isUser'])->group(function () {

    Route::get('/', Dashboard::class);
    Route::get('/training', TrainingShow::class);
    Route::get('/idp', IdpShow::class);
   
    /*Route::get('/trainings', function(){
        return view('trainings.index');
    }); */


});

Route::middleware(['auth'])->group(function () {

    Route::get('/profile', Profile::class);
   
    /*Route::get('/trainings', function(){
        return view('trainings.index');
    }); */


});






Auth::routes();


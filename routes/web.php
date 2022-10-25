<?php

use App\Http\Livewire\Main;
use App\Http\Livewire\IdpReports;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

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
    //Route::get('/IdpReports', IdpReports::class);
});

Route::middleware(['auth'])->group(function () {

    Route::get('/', Main::class);


});






Auth::routes();


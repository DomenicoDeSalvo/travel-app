<?php

use App\Http\Controllers\Admin\DayController;
use App\Http\Controllers\Admin\StageController;
use App\Http\Controllers\Admin\TripController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {return view('welcome');});


Route::middleware(['auth', 'verified'])
->name('admin.')
->prefix('admin')
->group(function(){
    Route::resource('trips', TripController::class);
    Route::resource('days', DayController::class);
    Route::resource('stages', StageController::class);
});

require __DIR__.'/auth.php';

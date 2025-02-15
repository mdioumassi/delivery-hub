<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CompanyController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\ContainerController;
use App\Http\Controllers\PackageController;
use App\Http\Controllers\DestinationController;
use App\Http\Controllers\PackageTrackingController;


Route::get('/', function () {
    return view('welcome');
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});


Route::resource('users', UserController::class);
Route::resource('companies', CompanyController::class);
Route::resource('services', ServiceController::class);
Route::resource('containers', ContainerController::class);
Route::resource('packages', PackageController::class);
Route::resource('destinations', DestinationController::class);
Route::resource('package-trackings', PackageTrackingController::class);
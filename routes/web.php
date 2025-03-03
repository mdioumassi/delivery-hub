<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\PackageController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\CompanyController;
use App\Http\Controllers\ContainerController;
use App\Http\Controllers\DestinationController;
use App\Http\Controllers\AllGpCompaniesController;
use App\Http\Controllers\CompanyServiceController;
use App\Http\Controllers\PackageTrackingController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PersonController;

// Route::get('/', function () {
//     return view('welcome');
// });

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
});

Route::resource('users', UserController::class);
Route::resource('persons', PersonController::class);
Route::resource('companies', CompanyController::class);
Route::resource('services', ServiceController::class);
Route::resource('containers', ContainerController::class);
Route::resource('packages', PackageController::class);
Route::resource('destinations', DestinationController::class);
// Routes pour les services d'entreprise
Route::post('/companies/{company}/services', [CompanyServiceController::class, 'store'])->name('company.services.store');
Route::get('/trackings/{type}', [PackageTrackingController::class, 'index'])->name('trackings.index');

Route::get('/', [AllGpCompaniesController::class, 'gpCompanies'])->name('gp-companies.index');
Route::get('gp-companies/{id}', [AllGpCompaniesController::class, 'gpCompany'])->name('gp-companies.show');
Route::post('/gp-companies/step2/company/{id}/package', [AllGpCompaniesController::class, 'store'])->name('gp.step2.package');    
Route::post('/gp-companies/step3/company/{id}/expéditeur', [AllGpCompaniesController::class, 'storeInfoPerson'])->name('gp.step3.expediteur');

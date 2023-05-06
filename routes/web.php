<?php

use App\Http\Controllers\UserController;
use App\Http\Controllers\UserCompanyController;
use App\Http\Controllers\CompanyController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\RoleController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('front.welcome');
})->name('start');

Route::group(['middleware' => 'auth'], function() {
    Route::get('/home', [HomeController::class, 'index_master'])->name('home');

    Route::get('/users', [UserController::class, 'index'])->name('users.index');
    Route::get('/users/create', [UserController::class, 'create'])->name('users.create');
    Route::post('/users', [UserController::class, 'store'])->name('users.store');
    Route::get('/users/{user}', [UserController::class, 'show'])->name('users.show');
    Route::get('/users/{user}/edit', [UserController::class, 'edit'])->name('users.edit');
    Route::put('/users/{user}', [UserController::class, 'update'])->name('users.update');
    Route::delete('/users/{user}', [UserController::class, 'destroy'])->name('users.destroy');

    Route::get('/users-company', [UserCompanyController::class, 'index'])->name('users_company.index');
    Route::get('/users-company/create', [UserCompanyController::class, 'create'])->name('users_company.create');
    Route::post('/users-company', [UserCompanyController::class, 'store'])->name('users_company.store');
    Route::get('/users-company/{user}', [UserCompanyController::class, 'show'])->name('users_company.show');
    Route::get('/users-company/{user}/edit', [UserCompanyController::class, 'edit'])->name('users_company.edit');
    Route::put('/users-company/{user}', [UserCompanyController::class, 'update'])->name('users_company.update');
    Route::delete('/users-company/{user}', [UserCompanyController::class, 'destroy'])->name('users_company.destroy');

    Route::get('/companies', [CompanyController::class, 'index'])->name('companies.index');
    Route::get('/companies/create', [CompanyController::class, 'create'])->name('companies.create');
    Route::post('/companies', [CompanyController::class, 'store'])->name('companies.store');
    Route::get('/companies/{company}', [CompanyController::class, 'show'])->name('companies.show');
    Route::get('/companies/{company}/edit', [CompanyController::class, 'edit'])->name('companies.edit');
    Route::put('/companies/{company}', [CompanyController::class, 'update'])->name('companies.update');
    Route::delete('/companies/{company}', [CompanyController::class, 'destroy'])->name('companies.destroy');

    Route::resource('permissions', PermissionController::class);
    Route::resource('roles', RoleController::class);
});


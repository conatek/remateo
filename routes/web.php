<?php

use App\Http\Controllers\UserController;
use App\Http\Controllers\UserCompanyController;
use App\Http\Controllers\CollaboratorController;
use App\Http\Controllers\CompanyController;
use App\Http\Controllers\AreaController;
use App\Http\Controllers\PositionController;
use App\Http\Controllers\CampusController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\ProvinceController;
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

    Route::get('/areas', [AreaController::class, 'index'])->name('areas.index');
    Route::get('/areas/create', [AreaController::class, 'create'])->name('areas.create');
    Route::post('/areas', [AreaController::class, 'store'])->name('areas.store');
    Route::get('/areas/{area}', [AreaController::class, 'show'])->name('areas.show');
    Route::get('/areas/{area}/edit', [AreaController::class, 'edit'])->name('areas.edit');
    Route::put('/areas/{area}', [AreaController::class, 'update'])->name('areas.update');
    Route::delete('/areas/{area}', [AreaController::class, 'destroy'])->name('areas.destroy');

    Route::get('/positions', [PositionController::class, 'index'])->name('positions.index');
    Route::get('/positions/create', [PositionController::class, 'create'])->name('positions.create');
    Route::post('/positions', [PositionController::class, 'store'])->name('positions.store');
    Route::get('/positions/{position}', [PositionController::class, 'show'])->name('positions.show');
    Route::get('/positions/{position}/edit', [PositionController::class, 'edit'])->name('positions.edit');
    Route::put('/positions/{position}', [PositionController::class, 'update'])->name('positions.update');
    Route::delete('/positions/{position}', [PositionController::class, 'destroy'])->name('positions.destroy');

    Route::get('/campuses', [CampusController::class, 'index'])->name('campuses.index');
    Route::get('/campuses/create', [CampusController::class, 'create'])->name('campuses.create');
    Route::post('/campuses', [CampusController::class, 'store'])->name('campuses.store');
    Route::get('/campuses/{campus}', [CampusController::class, 'show'])->name('campuses.show');
    Route::get('/campuses/{campus}/edit', [CampusController::class, 'edit'])->name('campuses.edit');
    Route::put('/campuses/{campus}', [CampusController::class, 'update'])->name('campuses.update');
    Route::delete('/campuses/{campus}', [CampusController::class, 'destroy'])->name('campuses.destroy');

    // Route::get('/collaborators', [CollaboratorController::class, 'getCollaborators'])->name('collaborators');
    Route::get('/collaborators', [CollaboratorController::class, 'index'])->name('collaborators.index');
    Route::get('/collaborators/create', [CollaboratorController::class, 'create'])->name('collaborators.create');
    Route::post('/collaborators', [CollaboratorController::class, 'store'])->name('collaborators.store');
    // Route::get('/collaborators/{collaborator}-{message?}', [CollaboratorController::class, 'show'])->name('collaborators.show');
    Route::get('/collaborators/{collaborator}', [CollaboratorController::class, 'show'])->name('collaborators.show');
    Route::get('/collaborators/{collaborator}/edit', [CollaboratorController::class, 'edit'])->name('collaborators.edit');
    Route::put('/collaborators/{collaborator}', [CollaboratorController::class, 'update'])->name('collaborators.update');
    Route::delete('/collaborators/{collaborator}/destroy', [CollaboratorController::class, 'destroy'])->name('collaborators.destroy');

    Route::resource('permissions', PermissionController::class);
    Route::resource('roles', RoleController::class);

    // Provinces - Cities
    Route::post('/get-cities', [ProvinceController::class, 'getCities'])->name('get_cities');
});


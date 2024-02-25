<?php

use App\Http\Controllers\UserController;
use App\Http\Controllers\UserCompanyController;
use App\Http\Controllers\CollaboratorController;
use App\Http\Controllers\CompanyController;
use App\Http\Controllers\AreaController;
use App\Http\Controllers\PositionController;
use App\Http\Controllers\CampusController;
use App\Http\Controllers\CollaboratorAcademicAchievementController;
use App\Http\Controllers\CollaboratorFamilyController;
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





    Route::get('/company/{company}', [CompanyController::class, 'companyShow'])->name('company.show');




    // AREAS DATA
    Route::get('/areas-data/{company_id}', [AreaController::class, 'getAreas']);
    Route::get('/areas', [AreaController::class, 'index'])->name('areas.index');
    Route::get('/areas/create', [AreaController::class, 'create'])->name('areas.create');
    Route::post('/areas', [AreaController::class, 'store'])->name('areas.store');
    Route::get('/areas/{area}', [AreaController::class, 'show'])->name('areas.show');
    Route::get('/areas/{area}/edit', [AreaController::class, 'edit'])->name('areas.edit');
    Route::put('/areas/{area}', [AreaController::class, 'update'])->name('areas.update');
    Route::delete('/area-data-delete/{area}', [AreaController::class, 'destroy']);

    // POSITIONS DATA
    Route::get('/positions-data/{company_id}', [PositionController::class, 'getPositions']);
    Route::get('/positions', [PositionController::class, 'index'])->name('positions.index');
    Route::get('/positions/create', [PositionController::class, 'create'])->name('positions.create');
    Route::post('/positions', [PositionController::class, 'store'])->name('positions.store');
    Route::get('/positions/{position}', [PositionController::class, 'show'])->name('positions.show');
    Route::get('/positions/{position}/edit', [PositionController::class, 'edit'])->name('positions.edit');
    Route::put('/positions/{position}', [PositionController::class, 'update'])->name('positions.update');
    Route::delete('/position-data-delete/{position}', [PositionController::class, 'destroy']);

    // CAMPUSES DATA
    Route::get('/campus-data/{company_id}', [CampusController::class, 'getCampuses']);
    Route::get('/campuses', [CampusController::class, 'index'])->name('campuses.index');
    Route::get('/campuses/create', [CampusController::class, 'create']);
    Route::post('/campuses', [CampusController::class, 'store']);
    Route::get('/campuses/{campus}', [CampusController::class, 'show']);
    Route::get('/campuses/{campus}/edit', [CampusController::class, 'edit']);
    Route::put('/campuses/{campus}', [CampusController::class, 'update']);
    Route::delete('/campus-data-delete/{campus}', [CampusController::class, 'destroy']);

    // COLLABORATORS DATA
    Route::get('/collaborators-data/{company_id}', [CollaboratorController::class, 'getCollaborators']);
    Route::get('/collaborators', [CollaboratorController::class, 'index'])->name('collaborators.index');
    Route::get('/collaborators/create', [CollaboratorController::class, 'create'])->name('collaborators.create');
    Route::post('/collaborators', [CollaboratorController::class, 'store'])->name('collaborators.store');
    // Route::get('/collaborators/{collaborator}-{message?}', [CollaboratorController::class, 'show'])->name('collaborators.show');
    Route::get('/collaborators/{collaborator}', [CollaboratorController::class, 'show'])->name('collaborators.show');
    Route::get('/collaborators/{collaborator}/edit', [CollaboratorController::class, 'edit'])->name('collaborators.edit');
    Route::put('/collaborators/{collaborator}', [CollaboratorController::class, 'update'])->name('collaborators.update');
    Route::delete('/collaborators/{collaborator}/destroy', [CollaboratorController::class, 'destroy'])->name('collaborators.destroy');

    // CONTRACTUAL INFORMATION
    Route::get('/contractual-information/{collaborator_id}', [CollaboratorController::class, 'getContractualInformation']);
    Route::post('/collaborators/{collaborator}/contractual-information', [CollaboratorController::class, 'storeContractualInformation']);
    Route::put('/collaborators/{collaborator}/contractual-information', [CollaboratorController::class, 'updateContractualInformation']);

    // ROLES AND PERMISSIONS
    Route::resource('permissions', PermissionController::class);
    Route::resource('roles', RoleController::class);

    // PROVINCES AND CITIES
    Route::post('/get-cities', [ProvinceController::class, 'getCities'])->name('get_cities');

    // RELATIVE DATA
    Route::get('/relative-data/{collaborator_id}', [CollaboratorFamilyController::class, 'show']);
    Route::post('/relative-data', [CollaboratorFamilyController::class, 'store']);
    Route::put('/relative-data-update/{relative_data}', [CollaboratorFamilyController::class, 'update']);
    Route::delete('/relative-data-delete/{relative_data}', [CollaboratorFamilyController::class, 'destroy']);

    // ACADEMIC DATA
    Route::get('/academic-data/{collaborator_id}', [CollaboratorAcademicAchievementController::class, 'show']);
    Route::post('/academic-data', [CollaboratorAcademicAchievementController::class, 'store']);
    Route::put('/academic-data-update/{academic_data}', [CollaboratorAcademicAchievementController::class, 'update']);
    Route::get('/download-academic-certificate/{academic_data_id}', [CollaboratorAcademicAchievementController::class, 'downloadCertificate']);
    // Route::delete('/academic-data-delete/{academic_data}', [CollaboratorAcademicAchievementController::class, 'destroy']);
});

<?php

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

Route::get('/', [\App\Http\Controllers\HomeController::class , 'index'])->name('localhost');

Route::get('/redirectToLogin', [\App\Http\Controllers\HomeController::class , 'redirectToLogin'])->name('redirectToLogin');
Route::get('/redirectFromTeamleader', [\App\Http\Controllers\HomeController::class , 'redirectFromTeamleader']);

Route::get('/getContactsController', [\App\Http\Controllers\HomeController::class , 'getContactsController'])->name('getContacts');
Route::get('/getCompanyController', [\App\Http\Controllers\HomeController::class , 'getCompanyController'])->name('getCompany');
Route::get('/getTasksController', [\App\Http\Controllers\HomeController::class , 'getTasksController'])->name('getTasks');
Route::get('/getProjectsController', [\App\Http\Controllers\HomeController::class , 'getProjectsController'])->name('getProjects');
Route::get('/getMilestonesController', [\App\Http\Controllers\HomeController::class , 'getMilestonesController'])->name('getMilestones');
Route::get('/getTimeTrackingController', [\App\Http\Controllers\HomeController::class , 'getTimeTrackingController'])->name('getTimeTracking');

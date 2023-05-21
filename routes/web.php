<?php

use App\Http\Controllers\ProfileController;
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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('content.dashboard.dashboards-analytics');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');



    $controller_path = 'App\Http\Controllers';
// Main Page Route
    Route::get('/', $controller_path . '\dashboard\Analytics@index')->name('dashboard-analytics');
// layout
    Route::get('/layouts/without-menu', $controller_path . '\layouts\WithoutMenu@index')->name('layouts-without-menu');
    Route::get('/layouts/without-navbar', $controller_path . '\layouts\WithoutNavbar@index')->name('layouts-without-navbar');
    Route::get('/layouts/fluid', $controller_path . '\layouts\Fluid@index')->name('layouts-fluid');
    Route::get('/layouts/container', $controller_path . '\layouts\Container@index')->name('layouts-container');
    Route::get('/layouts/blank', $controller_path . '\layouts\Blank@index')->name('layouts-blank');

// authentication
    Route::get('/auth/login-basic', $controller_path . '\authentications\LoginBasic@index')->name('auth-login-basic');
    Route::get('/auth/register-basic', $controller_path . '\authentications\RegisterBasic@index')->name('auth-register-basic');
    Route::get('/auth/forgot-password-basic', $controller_path . '\authentications\ForgotPasswordBasic@index')->name('auth-reset-password-basic');

//competence
    Route::get('competence', 'App\Http\Controllers\CompetenceController@index')->name('competence');
    Route::get('competences','App\Http\Controllers\CompetenceController@formCompetence');
    Route::post('competence','App\Http\Controllers\CompetenceController@Create');


});

require __DIR__.'/auth.php';

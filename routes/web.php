<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\Auth\LoginController;
use Illuminate\Support\Facades\Auth;
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

// Route::get('/', function () {
//     return view('welcome');
// });

Auth::routes();
Route::any('/logout', [LoginController::class, 'logoutUser'])->name('user.logout');

Route::group(['middleware' => ['guest']], function () {
    Route::any('/login', [LoginController::class, 'signin'])->name('user.login');
    Route::any('/', [LoginController::class, 'signin']);
});

Route::group(['middleware' => ['auth']], function () {

    Route::get('/home', [HomeController::class, 'index'])->name('home');
    Route::get('/', [HomeController::class, 'index']);


    Route::get('/login_page', [HomeController::class, 'login_page']);
    Route::get('/add_applicant/{id?}', [AdminController::class, 'add_applicant']);

    Route::get('/show_applicant', [AdminController::class, 'show_applicant']);

    Route::get('/show_reg', [AdminController::class, 'show_reg']);
    // Route::get('/add_user',[AdminController::class,'add_user']);
    Route::get('/show_charts', [AdminController::class, 'show_charts']);
    Route::get('/show_stats', [AdminController::class, 'show_stats']);
    Route::get('/updateApplicant/{id}', [AdminController::class, 'updateApplicant']);

    Route::get('/deleteApplicant/{id}', [AdminController::class, 'deleteApplicant']);

    Route::post('/upload_applicant', [AdminController::class, 'upload_applicant']);

    Route::get('/home', [AdminController::class, 'home']);
    Route::any('/users', [UserController::class, 'index'])->name('users');
    Route::any('/add_user/{id?}', [UserController::class, 'addUserForm'])->name('users-add');
    Route::any('/users/email-check', [UserController::class, 'emailExistOrNot'])->name('users-check');
    Route::any('/delete_user', [UserController::class, 'deleteUser'])->name('users-delete');
    Route::post('/editApplicant/{id}', [AdminController::class, 'editApplicant']);
});

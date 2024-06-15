<?php

use App\Http\Controllers\admin\AdminController;
use App\Http\Controllers\auth\AuthController;
use App\Http\Controllers\user\UsersController;
use Illuminate\Support\Facades\Route;



Route::get('/', [AuthController::class, 'userLogin'])->name('user.login');
Route::get('/test-admin', [AdminController::class, 'testAdmin'])->name('test.admin');
Route::get('/logout', [AuthController::class, 'logout'])->name('logout');
Route::post('/userLogined', [AuthController::class, 'userLogined'])->name('user.logined');
Route::post('/adminLogined', [AuthController::class, 'adminLogined'])->name('admin.logined');
Route::get('/admin', [AuthController::class, 'adminLogin'])->name('admin.login');
Route::get('/register', [UsersController::class, 'userRegister'])->name('user.register');
Route::post('/registered', [UsersController::class, 'userRegistered'])->name('registered.user');
Route::group(['middleware' => ['userMiddleware']], function () {

  Route::get('/user-dashboard', [UsersController::class, 'userDashboard'])->name('userDashboard');
  Route::post('/submitGuest', [UsersController::class, 'submitGuest'])->name('submitGuest');
  Route::post('/submitSlip', [UsersController::class, 'submitSlip'])->name('submitSlip');
  Route::get('/downloadSlip', [UsersController::class, 'downloadSlip'])->name('downloadSlip');
  Route::get('/VerifySlip/{id}', [UsersController::class, 'VerifySlip'])->name('verifySlip');
});

Route::group(['middleware' => ['adminMiddleware']], function () {

  Route::get('/admin-dashboard', [AdminController::class, 'adminDashboard'])->name('adminDashboard');
  Route::get('/dashboard/export-stocks', [AdminController::class, 'exportStocks'])->name('export.stocks');
});

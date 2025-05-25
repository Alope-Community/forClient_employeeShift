<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\LeaveApplicationController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::middleware('guest:employee')->prefix('auth')->group(function () {
    Route::get('/employee/login', [AuthController::class, 'viewEmployeeLogin'])->name('employee.login.view');
    Route::post('/employee/login', [AuthController::class, 'employeeLogin'])->name('employee.login');
});

Route::middleware('guest:shift_leader')->prefix('auth')->group(function () {
    Route::get('/leader/login', [AuthController::class, 'viewShiftLeaderLogin'])->name('shift-leader.login.view');
    Route::post('/leader/login', [AuthController::class, 'shiftLeaderLogin'])->name('shift-leader.login');
});

Route::middleware('auth:employee')->prefix('employee')->group(function() {
    Route::get('/dashboard', [DashboardController::class, 'employeeDashboard'])->name('employee.dashboard');
    Route::post('/logout', [AuthController::class, 'employeeLogout'])->name('employee.logout');
    Route::resource('/leave-application', LeaveApplicationController::class)->names('leave-application');
});

Route::middleware('auth:shift_leader')->prefix('leader')->group(function() {
    Route::get('/dashboard', [DashboardController::class, 'shiftLeaderDashboard'])->name('leader.dashboard');
    Route::post('/logout', [AuthController::class, 'shiftLeaderLogout'])->name('shift-leader.logout');
});

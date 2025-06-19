<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\LeaveApplicationController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ScheduleController;
use App\Http\Controllers\ShiftChangeController;
use App\Http\Controllers\ShiftController;
use App\Http\Controllers\ShiftHistoryController;
use App\Http\Controllers\ShiftReportProblemController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;
use App\Http\Middleware\SetLocale;
use Illuminate\Support\Facades\Session;


Route::middleware([SetLocale::class])->group(function () {

    Route::get('/', function () {
        return view('welcome');
    });

    Route::middleware(['guest:employee', 'redirect.if.logged.in'])->prefix('auth')->group(function () {
        Route::get('/employee/login', [AuthController::class, 'viewEmployeeLogin'])->name('employee.login.view');
        Route::post('/employee/login', [AuthController::class, 'employeeLogin'])->name('employee.login');
    });

    Route::middleware(['guest:shift_leader', 'redirect.if.logged.in'])->prefix('auth')->group(function () {
        Route::get('/leader/login', [AuthController::class, 'viewShiftLeaderLogin'])->name('shift-leader.login.view');
        Route::post('/leader/login', [AuthController::class, 'shiftLeaderLogin'])->name('shift-leader.login');
    });

    Route::middleware(['guest:admin', 'redirect.if.logged.in'])->prefix('auth')->group(function () {
        Route::get('/admin/login', [AuthController::class, 'viewAdminLogin'])->name('admin.login.view');
        Route::post('/admin/login', [AuthController::class, 'adminLogin'])->name('admin.login');
    });

    Route::middleware('auth:employee')->prefix('employee')->group(function () {
        Route::get('/dashboard', [DashboardController::class, 'employeeDashboard'])->name('employee.dashboard');

        Route::resource('/leave-application', LeaveApplicationController::class)->names('employee.leave-application');
        
        Route::resource('/shift-problem', ShiftReportProblemController::class)->names('employee.report-problem');
        Route::get('/shift-problem-history', [ShiftReportProblemController::class, 'historyIndex'])->name('employee.report-problem-history');
        Route::get('/shift-problem-history/{id}', [ShiftReportProblemController::class, 'show'])->name('employee.report-problem-history.show');
        
        Route::get('/profile', [ProfileController::class, 'index'])->name('employee.profile.index');
        Route::get('/profile/edit', [ProfileController::class, 'edit'])->name('employee.profile.edit');
        Route::put('/profile', [ProfileController::class, 'update'])->name('employee.profile.update');
        
        Route::resource('/shift-history', ShiftHistoryController::class)->names('employee.shift-history')->only(['index', 'show']);
        Route::get('/shift-history/{id}/download', [LeaveApplicationController::class, 'download'])
            ->name('employee.shift-history.download');

        Route::post('/logout', [AuthController::class, 'employeeLogout'])->name('employee.logout');
    });

    Route::middleware('auth:shift_leader')->prefix('leader')->group(function () {
        Route::get('/dashboard', [DashboardController::class, 'shiftLeaderDashboard'])->name('leader.dashboard');

        Route::get('/user', [UserController::class, 'index'])->name('shift-leader.user.index');
        Route::get('/user/create', [UserController::class, 'create'])->name('shift-leader.user.create');
        Route::post('/user', [UserController::class, 'store'])->name('shift-leader.user.store');
        Route::get('/user/{id}/{role}', [UserController::class, 'show'])->name('shift-leader.user.show');
        Route::get('/user/{id}/{role}/edit', [UserController::class, 'edit'])->name('shift-leader.user.edit');
        Route::put('/user/{id}/{role}', [UserController::class, 'update'])->name('shift-leader.user.update');
        Route::delete('/user/{id}/{role}', [UserController::class, 'destroy'])->name('shift-leader.user.destroy');

        Route::resource('/shift', ShiftController::class)->names('shift-leader.shift')->only(['index', 'show']);

        // Route::resource('/schedule', ScheduleController::class)->names('shift-leader.schedule')->only(['index', 'show']);

        Route::resource('/shift-change', ShiftChangeController::class)->names('shift-leader.shift-change')->only(['index', 'edit', 'update']);

        Route::resource('/shift-problem', ShiftReportProblemController::class)->names('shift-leader.report-problem')->only(['index', 'edit']);
        Route::put('/shift-problem/{id}', [ShiftReportProblemController::class, 'updateOnLeader'])->name('shift-leader.report-problem.update-leader');

        Route::get('/profile', [ProfileController::class, 'index'])->name('shift-leader.profile.index');
        Route::get('/profile/edit', [ProfileController::class, 'edit'])->name('shift-leader.profile.edit');
        Route::put('/profile', [ProfileController::class, 'update'])->name('shift-leader.profile.update');

        Route::post('/logout', [AuthController::class, 'shiftLeaderLogout'])->name('shift-leader.logout');
    });

    Route::middleware('auth:admin')->prefix('admin')->group(function () {
        Route::get('/dashboard', [DashboardController::class, 'adminDashboard'])->name('admin.dashboard');

        // User Management
        Route::get('/user', [UserController::class, 'index'])->name('admin.user.index');
        Route::get('/user/create', [UserController::class, 'create'])->name('admin.user.create');
        Route::post('/user', [UserController::class, 'store'])->name('admin.user.store');
        Route::get('/user/{id}/{role}', [UserController::class, 'show'])->name('admin.user.show');
        Route::get('/user/{id}/{role}/edit', [UserController::class, 'edit'])->name('admin.user.edit');
        Route::put('/user/{id}/{role}', [UserController::class, 'update'])->name('admin.user.update');
        Route::delete('/user/{id}/{role}', [UserController::class, 'destroy'])->name('admin.user.destroy');

        Route::resource('/shift', ShiftController::class)->names('admin.shift');
        // Route::resource('/schedule', ScheduleController::class)->names('admin.schedule')->only(['index', 'show']);
        Route::resource('/leave-application', LeaveApplicationController::class)->names('admin.leave-application')->only(['index', 'show', 'update', 'edit', 'destroy']);
        Route::get('/leave-application/{id}/download', [LeaveApplicationController::class, 'download'])
            ->name('admin.leave-application.download');
        Route::resource('/shift-change', ShiftChangeController::class)->names('admin.shift-change')->only(['index', 'show', 'edit', 'update']);

        Route::get('/profile', [ProfileController::class, 'index'])->name('admin.profile.index');
        Route::get('/profile/edit', [ProfileController::class, 'edit'])->name('admin.profile.edit');
        Route::put('/profile', [ProfileController::class, 'update'])->name('admin.profile.update');

        Route::resource('/shift-history', ShiftHistoryController::class)->names('admin.shift-history')->only(['index', 'show', 'download']);

        Route::post('/logout', [AuthController::class, 'adminLogout'])->name('admin.logout');
    });

    Route::get('/language/{locale}', function ($locale) {
        if (in_array($locale, ['en', 'id', 'zh'])) {
            Session::put('locale', $locale);
        }
        return back();
    })->name('language.switch');
});

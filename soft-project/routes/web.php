<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\Controller;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\AttendanceController;
use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;
Route::get('/', function () {
    return view('welcome');
});

// Landing Page Links
Route::get('/about',[EmployeeController::class,'viewAbout']);
Route::get("/home",[EmployeeController::class,'viewHome'])->name('home');

// Authentication
Route::get('/login',[AuthController::class,'viewLogin'])->name('login');
Route::post('/verifyLogin',[AuthController::class,'verifyLogin']);
Route::post('/logout',[AuthController::class,'logout'])->name('logout');

// Admin
Route::prefix('admin')->middleware('auth:admin')->group(function () {
    // Dashboard
    Route::get('/dashboard',[AdminController::class,'viewAdminDashboard'])->name('admin/dashboard')->middleware('auth:admin');
    Route::get('/quickApproveRequest/{requestID}',[AdminController::class,'quickApproveRequest'])->name('quickApproveRequest');
    Route::get('/quickDeniedRequest/{requestID}',[AdminController::class,'quickDenyRequest'])->name('quickDenyRequest');

    // Leave Requests
    Route::get('/approveRequest/{requestID}',[AdminController::class,'approveRequest'])->name('approveRequest');
    Route::get('/deniedRequest/{requestID}',[AdminController::class,'denyRequest'])->name('denyRequest');
    Route::get('/leaverequests',[AdminController::class,'viewLeaveRequests'])->name('leave');
    Route::match(['get', 'post'], '/searchLeave', [AdminController::class, 'searchLeave'])->name('searchLeave');

    // Create Employee
    Route::get('/createEmployee',[AdminController::class,'viewCreateEmployee']);
    Route::post('/employeeCreated',[AdminController::class,'createEmployee']);

    // Payroll History
    Route::get('/payroll',[AdminController::class,'viewPayroll'])->name('payroll');
    Route::get('/payrolls/{employeeID}',[AdminController::class,'viewEmployeePayroll'])->name('employeePayroll');
});

// ***
// ***
// ***

Route::prefix('employee')->middleware('auth:employee')->group(function () {
    //Employee Links
    Route::get('/profile',[EmployeeController::class,'viewEmployeeProfile'])->name('/profile');
    Route::post('/updateProfile',[EmployeeController::class,'updateEmployeeName']);

    // Employee Dashboard
    Route::get('/attendance', [AttendanceController::class,'dashboard'])->name('attendance');
    Route::post('/clock-in', [AttendanceController::class,'clockIn'])->name('clock.in');
    Route::post('/clock-out', [AttendanceController::class,'clockOut'])->name('clock.out');
});
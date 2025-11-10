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

Route::get('/template',[EmployeeController::class,'viewTemplate']);

Route::get('/login',[AuthController::class,'viewLogin'])->name('login');
Route::post('/verifyLogin',[AuthController::class,'verifyLogin']);

// Admin Dashboard
Route::get('/admin/dashboard',[AdminController::class,'viewAdminDashboard'])->name('admin/dashboard');
Route::get('/admin/quickApproveRequest/{requestID}',[AdminController::class,'quickApproveRequest'])->name('quickApproveRequest');
Route::get('/admin/quickDeniedRequest/{requestID}',[AdminController::class,'quickDenyRequest'])->name('quickDenyRequest');
Route::get('/admin/approveRequest/{requestID}',[AdminController::class,'approveRequest'])->name('approveRequest');
Route::get('/admin/deniedRequest/{requestID}',[AdminController::class,'denyRequest'])->name('denyRequest');
Route::post('/searchLeave',[AdminController::class,'searchLeave'])->name('searchLeave');


// Admin Links
Route::get('/admin/createEmployee',[AdminController::class,'viewCreateEmployee']);
Route::post('/admin/employeeCreated',[AdminController::class,'createEmployee']);

Route::get('/admin/leaverequests',[AdminController::class,'viewLeaveRequests'])->name('leave');
Route::match(['get', 'post'], '/searchLeave', [AdminController::class, 'searchLeave']);
// Landing Page Links
Route::get('/about',[EmployeeController::class,'viewAbout']);
Route::get("/home",[EmployeeController::class,'viewHome']);

//Employee Links
Route::get('/employee_profile',[EmployeeController::class,'viewEmployeeProfile'])->name('/employee_profile');
// ***
// ***
// ***

// Employee Dashboard
Route::get('/attendance', [AttendanceController::class,'dashboard'])->name('attendance');
Route::post('/clock-in', [AttendanceController::class,'clockIn'])->name('clock.in');
Route::post('/clock-out', [AttendanceController::class,'clockOut'])->name('clock.out');

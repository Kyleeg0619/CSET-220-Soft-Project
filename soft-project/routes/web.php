<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\AttendanceController;
use App\Http\Controllers\PayrollController;
use App\Http\Controllers\LeaveController;
use App\Http\Controllers\AuthController;

// Landing Page Links
Route::get('/about',[EmployeeController::class,'viewAbout']);
Route::get("/",[EmployeeController::class,'viewHome'])->name('home');

// Authentication
Route::get('/login',[AuthController::class,'viewLogin'])->name('login');
Route::post('/verifyLogin',[AuthController::class,'verifyLogin']);
Route::post('/logout',[AuthController::class,'logout'])->name('logout');

// Admin
Route::prefix('admin')->middleware('auth:admin')->group(function () {
    // Dashboard
    Route::get('/dashboard',[AdminController::class,'viewAdminDashboard'])->name('admin/dashboard');
    Route::get('/quickApproveRequest/{requestID}',[AdminController::class,'quickApproveRequest'])->name('quickApproveRequest');
    Route::get('/quickDeniedRequest/{requestID}',[AdminController::class,'quickDenyRequest'])->name('quickDenyRequest');
  
    // Attendance Records
    Route::get('/attendance', [AdminController::class, 'viewAttendanceRecords'])->name('admin.attendance');
    Route::post('/attendance/filter', [AdminController::class, 'filterAttendance'])->name('admin.attendance.filter');

    // Employee Management
    Route::get('/employeeoverview', [AdminController::class, 'viewEmployeeOverview']);
        // Create
        Route::get('/createEmployee',[AdminController::class,'viewCreateEmployee']);
        Route::post('/employeeCreated',[AdminController::class,'createEmployee']);
        // Edit
        Route::get('/editemployee/{id}', [AdminController::class, 'viewEditEmployee'])->name('editEmployee');
        Route::post('/updateemployee/{id}', [AdminController::class, 'updateEmployee'])->name('updateEmployee');
        // Delete
        Route::get('/deleteemployee/{id}', [AdminController::class, 'deleteEmployee'])->name('deleteEmployee');
        // View/Update
        Route::get('/viewemployee/{id}', [AdminController::class, 'viewEmployeeProfile']);
        Route::get('/employee/{id}', [AdminController::class, 'viewEmployeeProfile'])
             ->name('employee.profile');
        Route::post('/employee/{id}/update', [AdminController::class, 'updateEmployeeProfile'])
             ->name('employee.profile.update');

    // Leave Requests
    Route::get('/approveRequest/{requestID}',[AdminController::class,'approveRequest'])->name('approveRequest');
    Route::get('/deniedRequest/{requestID}',[AdminController::class,'denyRequest'])->name('denyRequest');
    Route::get('/leaverequests',[AdminController::class,'viewLeaveRequests'])->name('leave');
    Route::match(['get', 'post'], '/searchLeave', [AdminController::class, 'searchLeave'])->name('searchLeave');

    // Payroll
    Route::get('/payroll', [PayrollController::class, 'index'])->name('payroll.index');
    Route::post('/payroll/generate', [PayrollController::class, 'generate'])->name('payroll.generate'); 
    Route::get('/payroll/markAllPayroll', [PayrollController::class, 'markAllProcessed'])->name('payroll.markAll');
    Route::get('/payroll/mark/{payrollID}', [PayrollController::class, 'markProcessed'])->name('payroll.mark');
});

// ***
// ***
// ***

Route::prefix('employee')->middleware('auth:employee')->group(function () {
    //Employee Links
    Route::get('/profile',[EmployeeController::class,'viewEmployeeProfile'])->name('/profile');
    Route::post('/updateProfile',[EmployeeController::class,'updateEmployeeName']);

    //Employee Payroll History
    Route::get('/payroll',[EmployeeController::class,'viewEmployeePayHistory']);
  
    // Employee Dashboard
    Route::get('/attendance', [AttendanceController::class,'dashboard'])->name('attendance');
    Route::post('/clock-in', [AttendanceController::class,'clockIn'])->name('clock.in');
    Route::post('/clock-out', [AttendanceController::class,'clockOut'])->name('clock.out');

    // Employee Leave Management
    Route::get('leave/request', [LeaveController::class, 'requestForm'])->name('leave.request');
    Route::post('leave/submit', [LeaveController::class, 'submitRequest'])->name('leave.submit');
    Route::get('leave/history', [LeaveController::class, 'history'])->name('leave.history');
});

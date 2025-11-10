<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\Controller;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\AuthController;

Route::get('/', function () { 
    return view('welcome');
});

Route::get('/template',[EmployeeController::class,'viewTemplate']);

Route::get('/login',[AuthController::class,'viewLogin'])->name('login');
Route::post('/verifyLogin',[AuthController::class,'verifyLogin']);

// Admin Dashboard
Route::get('/admin/dashboard',[AdminController::class,'viewAdminDashboard'])->name('admin/dashboard');
Route::get('/admin/employeeoverview', [App\Http\Controllers\AdminController::class, 'viewEmployeeOverview']);
Route::get('/admin/approveRequest/{requestID}',[AdminController::class,'approveRequest'])->name('approveRequest');
Route::get('/admin/deniedRequest/{requestID}',[AdminController::class,'denyRequest'])->name('denyRequest');


// Admin Links
Route::get('/admin/createEmployee',[AdminController::class,'viewCreateEmployee']);
Route::post('/admin/employeeCreated',[AdminController::class,'createEmployee']);

Route::get('/about',[EmployeeController::class,'viewAbout']);
Route::get("/home",[EmployeeController::class,'viewHome']);


Route::get('/links', function() {
    return view('links');
});

Route::get('/test', function () {
    return 'Hello world';
});

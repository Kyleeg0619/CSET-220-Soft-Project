<?php
use App\Http\Controllers\AdminController;
use App\Http\Controllers\Controller;
use App\Http\Controllers\EmployeeControllerAPI;
Route::post('/employee_profile',[EmployeeControllerAPI::class,'storeNames'])
?>
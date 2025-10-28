<?php

use App\Http\Controllers\Controller;
use App\Http\Controllers\EmployeeController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/template',[EmployeeController::class,'viewTemplate']);

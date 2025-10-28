<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class EmployeeController extends Controller
{
    // DEBUG ROUTES
    public function viewTemplate() {
        return view('template');
    }
    
}

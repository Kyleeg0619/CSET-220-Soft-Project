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

    // sample until merged
    public function viewDashboard() {
        return view('template');
    }

    public function viewAbout() {
        return view('about');
    }
}

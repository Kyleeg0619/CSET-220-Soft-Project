<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use App\Models\Employee;
use App\Models\User;
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

    public function viewHome() {
        return view('home');
    }
    public function viewEmployeeProfile(){
        $employee=array("designation","department","company");
        $employee["designation"]=Designation::where('designationID',session('user')->designationID)->first();
        $employee["department"]=Department::where('departmentID',session('user')->departmentID);
        $employee["company"]=Company::where('companyID',session('user')->companyID);
        return view('employee_profile',["employee_user"=>$employee]);
    }
}

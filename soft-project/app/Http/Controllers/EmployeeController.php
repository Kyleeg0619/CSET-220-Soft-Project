<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use App\Models\Company;
use App\Models\Department;
use App\Models\Designation;
use App\Models\Employee;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Payroll;

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
        $employee = Auth::guard('employee')->user();
        $designation=Designation::where('designationID',$employee->designationID)->first();
        $department=Department::where('departmentID',$employee->departmentID)->first();
        $company=Company::where('companyID',$employee->companyID)->first();
        return view('employee_profile',['employee'=>$employee,'designation'=>$designation,'department'=>$department,'company'=>$company]);
    }

    public function updateEmployeeName(Request $request){
        $employee = Auth::guard('employee')->user();
        $employee->firstName = $request->input('first_name');
        $employee->lastName = $request->input('last_name');
        // $employee->save();
        return redirect()->route('/employee/profile')->with('msg', 'Name updated successfully!');
    }
    public function viewEmployeePayHistory(){
          $employee = Auth::guard('employee')->user();
          $history=Payroll::where('employeeID',$employee->employeeID)->paginate(30);
        return view('employee_payroll',['employee'=>$employee,'history'=>$history]);
    }
}

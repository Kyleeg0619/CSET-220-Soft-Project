<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Attendance;
use App\Models\CompanyUsers;
use App\Models\Department;
use App\Models\Designation;
use App\Models\Employee;
use App\Models\Leaverequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;

class AdminController extends Controller
{
    public function viewAdminDashboard() {
        $employees = Leaverequest::where('leaverequests.companyID', session('user')->companyID)->where('leaverequests.approvalStatus','Pending')
        ->leftJoin('employees', 'leaverequests.employeeID', '=', 'employees.employeeID')
        ->select('leaverequests.*', 'employees.firstName', 'employees.lastName','employees.employeeID')
        ->get();

        $totalEmployees = Employee::where('companyID',session('user')->companyID)->count();

        $today = date('y-m-d');
        $presentEmployees = Attendance::where('employees.companyID',session('user')->companyID)->where('attendance.scheduleDate',$today)->leftJoin('employees','attendance.employeeID','=','employees.employeeID')->count();

        $absentEmployees = $totalEmployees-$presentEmployees;

        return view('admin_dashboard',['employees'=>$employees,'totalEmployees'=>$totalEmployees,'presentEmployees'=>$presentEmployees,'absentEmployees'=>$absentEmployees]);
    }

    public function approveRequest($id) {
        Leaverequest::where('requestID',$id)->update(['approvalStatus'=>'Approved']);

        return $this->viewAdminDashboard();
    }
    
    public function denyRequest($id) {
        Leaverequest::where('requestID',$id)->update(['approvalStatus'=>'Denied']);

        return $this->viewAdminDashboard();
    }

    public function viewCreateEmployee() {
        $departments = Department::where('companyID',session('user')->companyID)->get();

        $designations = Designation::select('*')->get();

        return view('create_employee',['departments'=>$departments,'designations'=>$designations]);
    }

    public function createEmployee(Request $request) {
        $employee = [
            'firstName'=>$request->firstName,
            'lastName'=>$request->lastName,
            'email'=>$request->email,
            'password'=>Hash::make($request->password),
            'departmentID'=>$request->departmentID,
            'designationID'=>$request->designationID,
            'companyID'=>session('user')->companyID,
            'salary'=>$request->salary
        ];
        Employee::insert($employee);
        
        $departments = Department::where('companyID',session('user')->companyID)->get();
        $designations = Designation::select('*')->get();
        return view('create_employee',['departments'=>$departments,'designations'=>$designations,'success'=>'Employee Profile Created Successfully!']);
    }
     
    function viewEmployeeOverview(Request $request)
{
    $sort = $request->get('sort', 'lastName');
    $order = $request->get('order', 'asc');

    $employees = \App\Models\Employee::leftJoin('departments', 'employees.departmentID', '=', 'departments.departmentID')
        ->leftJoin('designations', 'employees.designationID', '=', 'designations.designationID')
        ->select('employees.*', 'departments.departmentName', 'designations.designationName')
        ->where('employees.companyID', 1)
        ->orderBy($sort, $order)
        ->get();

    return view('admin_employeeoverview', compact('employees'));
}

public function editEmployee($id)
{
    $employee = \App\Models\Employee::findOrFail($id);
    return view('edit_employee', compact('employee'));
}

public function deleteEmployee($id)
{
    \App\Models\Employee::where('employeeID', $id)->delete();
    return redirect('/admin/employeeoverview')->with('success', 'Employee deleted successfully!');
}



}
 // TEMP FIX: skip login
    if (!session()->has('user')) {
        session(['user' => (object)[
            'companyID' => 1, // put your test companyID here
            'firstName' => 'Test',
            'lastName'  => 'Admin'
        ]]);
    }





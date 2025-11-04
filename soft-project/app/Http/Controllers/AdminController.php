<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\CompanyUsers;
use App\Models\Leaverequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;

class AdminController extends Controller
{
    public function viewAdminDashboard() {
        $employees = DB::select("SELECT cu.userID, cu.firstName, cu.lastName, l.reason, l.requestDate, l.leaveStart, l.leaveEnd, l.approvalStatus, l.requestID  FROM leaverequests l LEFT JOIN company_users cu ON l.userID=cu.userID LEFT JOIN departments d ON cu.departmentID=d.departmentID WHERE d.companyID = ? AND l.approvalStatus = ?",[session('user')->department->company->companyID,'Pending']);

        $totalEmployees = DB::select("SELECT COUNT(cu.userID) FROM company_users cu LEFT JOIN departments d ON cu.departmentID=d.departmentID LEFT JOIN companies c ON d.companyID=c.companyID WHERE d.companyID = ?",[session('user')->department->company->companyID]);

        return view('admin_dashboard',['employees'=>$employees]);
    }

    public function approveRequest($id) {
        Leaverequest::where('requestID',$id)->update(['approvalStatus'=>'Approved']);

        $employees = DB::select("SELECT cu.userID, cu.firstName, cu.lastName, l.reason, l.requestDate, l.leaveStart, l.leaveEnd, l.approvalStatus, l.requestID  FROM leaverequests l LEFT JOIN company_users cu ON l.userID=cu.userID LEFT JOIN departments d ON cu.departmentID=d.departmentID WHERE d.companyID = ? AND l.approvalStatus = ?",[session('user')->department->company->companyID,'Pending']);

        return view('admin_dashboard',['employees'=>$employees]);
    }
    
    public function denyRequest($id) {
        Leaverequest::where('requestID',$id)->update(['approvalStatus'=>'Denied']);

        $employees = DB::select("SELECT cu.userID, cu.firstName, cu.lastName, l.reason, l.requestDate, l.leaveStart, l.leaveEnd, l.approvalStatus, l.requestID  FROM leaverequests l LEFT JOIN company_users cu ON l.userID=cu.userID LEFT JOIN departments d ON cu.departmentID=d.departmentID WHERE d.companyID = ? AND l.approvalStatus = ?",[session('user')->department->company->companyID,'Pending']);

        return view('admin_dashboard',['employees'=>$employees]);
    }

    public function viewCreateEmployee() {
        return view('create_employee');
    }

    public function createEmployee(Request $request) {
        $employee = [
            'firstName'=>$request->firstName,
            'lastName'=>$request->lastName,
            'email'=>$request->email,
            'password'=>Hash::make($request->password),
            'departmentID'=>$request->departmentID,
            'designation'=>$request->designation,
            'salary'=>$request->salary
        ];
        CompanyUsers::insert($employee);
        return view('create_employee',['success'=>'Employee Profile Created Successfully!']);
    }
}

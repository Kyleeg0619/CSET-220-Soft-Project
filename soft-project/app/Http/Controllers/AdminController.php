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

    public function quickApproveRequest($id) {
        Leaverequest::where('requestID',$id)->update(['approvalStatus'=>'Approved']);

        return $this->viewAdminDashboard();
    }
    
    public function quickDenyRequest($id) {
        Leaverequest::where('requestID',$id)->update(['approvalStatus'=>'Denied']);

        return $this->viewAdminDashboard();
    }

    public function approveRequest($id) {
        Leaverequest::where('requestID',$id)->update(['approvalStatus'=>'Approved']);

        return $this->viewLeaveRequests();
    }
    
    public function denyRequest($id) {
        Leaverequest::where('requestID',$id)->update(['approvalStatus'=>'Denied']);

        return $this->viewLeaveRequests();
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

    public function viewLeaveRequests(?Request $request = null) {
        if ($request === null) {
            $request = request();
        }
        // allow only these sortable keys (map to real columns)
        $allowedSorts = [
            'employeeID' => 'employees.employeeID',
            'name' => 'employees.lastName',
            'reason' => 'leaverequests.reason',
            'submissionDate' => 'leaverequests.submissionDate',
            'leaveStart' => 'leaverequests.leaveStart',
            'leaveEnd' => 'leaverequests.leaveEnd',
            'status' => 'leaverequests.approvalStatus',
        ];

        $sortKey = $request->query('sort');
        $direction = strtolower($request->query('direction', 'desc')) === 'asc' ? 'asc' : 'desc';

        $query = Leaverequest::where('leaverequests.companyID', session('user')->companyID)
            ->leftJoin('employees', 'leaverequests.employeeID', '=', 'employees.employeeID')
            ->select('leaverequests.*', 'employees.firstName', 'employees.lastName','employees.employeeID');

        if ($sortKey && array_key_exists($sortKey, $allowedSorts)) {
            // special-case name to sort by lastName then firstName
            if ($sortKey === 'name') {
                $query = $query->orderBy('employees.lastName', $direction)->orderBy('employees.firstName', $direction);
            } else {
                $query = $query->orderBy($allowedSorts[$sortKey], $direction);
            }
        } else {
            // default
            $query = $query->orderBy('leaverequests.submissionDate','desc');
        }

        $employees = $query->get();

        return view('leave',['employees'=>$employees]);
    }
}

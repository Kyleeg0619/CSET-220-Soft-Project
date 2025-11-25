<?php

namespace App\Http\Controllers;

use App\Models\Attendance;
use App\Models\Department;
use App\Models\Designation;
use App\Models\Employee;
use App\Models\Leaverequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    
    public function viewAdminDashboard() {
        $admin = Auth::guard('admin')->user();

        $employees = Leaverequest::where('leaverequests.companyID', $admin->companyID)->where('leaverequests.approvalStatus','Pending')
        ->leftJoin('employees', 'leaverequests.employeeID', '=', 'employees.employeeID')
        ->select('leaverequests.*', 'employees.firstName', 'employees.lastName','employees.employeeID')->limit(10)
        ->get();

        $totalEmployees = Employee::where('companyID',$admin->companyID)->count();

        $today = date('y-m-d');
        $presentEmployees = Attendance::where('employees.companyID',$admin->companyID)->where('attendance.scheduleDate',$today)->leftJoin('employees','attendance.employeeID','=','employees.employeeID')->count();

        $today = date('Y-m-d');
        $presentEmployees = Attendance::where('attendance.scheduleDate', $today)
            ->leftJoin('employees', 'attendance.employeeID', '=', 'employees.employeeID')
            ->where('employees.companyID', session('user')->companyID)
            ->count();

        $absentEmployees = $totalEmployees - $presentEmployees;

        return view('admin_dashboard', compact('employees', 'totalEmployees', 'presentEmployees', 'absentEmployees'));
    }
  
    public function quickApproveRequest($id) {
        Leaverequest::where('requestID',$id)->update(['approvalStatus'=>'Approved']);
      
      return $this->viewAdminDashboard();
    }
    
    public function quickDenyRequest($id) {
        Leaverequest::where('requestID',$id)->update(['approvalStatus'=>'Denied']);
      
      return $this->viewAdminDashboard();
    }

    public function viewCreateEmployee()
    {
        $departments = Department::where('companyID', session('user')->companyID)->get();
        $designations = Designation::all();

        return view('create_employee', compact('departments', 'designations'));
    }

    public function createEmployee(Request $request)
    {
        Employee::create([
            'firstName'     => $request->firstName,
            'lastName'      => $request->lastName,
            'email'         => $request->email,
            'password'      => Hash::make($request->password),
            'departmentID'  => $request->departmentID,
            'designationID' => $request->designationID,
            'companyID'     => session('user')->companyID,
            'salary'        => $request->salary
        ]);

        return redirect('/admin/employeeoverview')->with('success', 'Employee Created Successfully!');
    }

    public function viewEmployeeOverview(Request $request)
    {
        $sort = $request->get('sort', 'lastName');
        $order = $request->get('order', 'asc');
    public function approveRequest($id) {
        Leaverequest::where('requestID',$id)->update(['approvalStatus'=>'Approved']);

        return $this->viewLeaveRequests();
    }
    
    public function denyRequest($id) {
        Leaverequest::where('requestID',$id)->update(['approvalStatus'=>'Denied']);

        return $this->viewLeaveRequests();
    }

    public function viewEditEmployee($id)
    {
        $employee = Employee::leftJoin('departments', 'employees.departmentID', '=', 'departments.departmentID')
            ->leftJoin('designations', 'employees.designationID', '=', 'designations.designationID')
            ->select('employees.*', 'departments.departmentName', 'designations.designationName')
            ->where('employeeID', $id)
            ->first();

        $departments = Department::where('companyID', session('user')->companyID)->get();
        $designations = Designation::all();

        return view('admin_editemployee', compact('employee', 'departments', 'designations'));
    }

    public function updateEmployee(Request $request, $id)
    {
        Employee::where('employeeID', $id)->update([
            'firstName'     => $request->firstName,
            'lastName'      => $request->lastName,
            'email'         => $request->email,
            'departmentID'  => $request->departmentID,
            'designationID' => $request->designationID,
            'salary'        => $request->salary
        ]);

        return redirect('/admin/employeeoverview')->with('success', 'Employee updated successfully!');
    }

    public function deleteEmployee($id)
    {
        Employee::where('employeeID', $id)->delete();
        return redirect('/admin/employeeoverview')->with('success', 'Employee deleted!');
    }

    public function viewEmployeeProfile($id)
    {
        $employee = Employee::leftJoin('departments', 'employees.departmentID', '=', 'departments.departmentID')
            ->leftJoin('designations', 'employees.designationID', '=', 'designations.designationID')
            ->select(
                'employees.*',
                'departments.departmentName',
                'designations.designationName'
            )
            ->where('employees.employeeID', $id)
            ->where('employees.companyID', session('user')->companyID)
            ->first();

        if (!$employee) {
            return redirect('/admin/employeeoverview')->with('error', 'Employee not found');
        }

        $departments = Department::where('companyID', session('user')->companyID)->get();
        $designations = Designation::all();

        return view('admin_employeeprofile', compact('employee', 'departments', 'designations'));
    }

    public function updateEmployeeProfile(Request $request, $id)
{
    $employee = Employee::findOrFail($id);

    $data = [
        'firstName'     => $request->firstName,
        'lastName'      => $request->lastName,
        'email'         => $request->email,
        'departmentID'  => $request->departmentID,
        'designationID' => $request->designationID,
        'salary'        => $request->salary
    ];

    // Handle photo upload
    if ($request->hasFile('profilePhoto')) {
        $file = $request->file('profilePhoto');

        $filename = time() . '_' . $file->getClientOriginalName();
        $file->move(public_path('employee_photos'), $filename);

        $data['profilePhoto'] = $filename;
    }

    $employee->update($data);

    return redirect()->route('employee.profile', $id)
        ->with('success', 'Employee updated successfully!');
}

    public function viewLeaveRequests(?Request $request = null) {
        $admin = Auth::guard('admin')->user();
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

        $query = Leaverequest::where('leaverequests.companyID', $admin->companyID)
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

        $employees = $query->paginate(10);

        return view('leave',['employees'=>$employees]);
    }

    public function searchLeave(Request $request) {
        $admin = Auth::guard('admin')->user();
        $searchTerm = $request->input('search');
        if ($searchTerm == null) {
            return $this->viewLeaveRequests();
        }
        $employees = Leaverequest::where('leaverequests.companyID', $admin->companyID)
            ->leftJoin('employees', 'leaverequests.employeeID', '=', 'employees.employeeID')
            ->select('leaverequests.*', 'employees.firstName', 'employees.lastName', 'employees.employeeID')
            ->where(function($query) use ($searchTerm) {
                $query->where('employees.firstName', 'LIKE', "%{$searchTerm}%")
                      ->orWhere('employees.lastName', 'LIKE', "%{$searchTerm}%");
            })

            ->simplePaginate(10);
        return view('leave',['employees'=>$employees]);
    }

    public function viewPayroll() {
        $admin = Auth::guard('admin')->user();

        $employees = Employee::where('companyID',$admin->companyID)->get();

        return view('payroll',['employees'=>$employees]);
    }
}

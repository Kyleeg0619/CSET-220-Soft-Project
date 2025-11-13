<?php

namespace App\Http\Controllers;

use App\Models\Attendance;
use App\Models\Department;
use App\Models\Designation;
use App\Models\Employee;
use App\Models\Leaverequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    public function __construct()
    {
        // TEMP FIX: bypass login for testing
        if (!session()->has('user')) {
            session(['user' => (object)[
                'companyID' => 1,
                'firstName' => 'Test',
                'lastName'  => 'Admin'
            ]]);
        }
    }

    public function viewAdminDashboard()
    {
        $employees = Leaverequest::where('leaverequests.companyID', session('user')->companyID)
            ->where('leaverequests.approvalStatus', 'Pending')
            ->leftJoin('employees', 'leaverequests.employeeID', '=', 'employees.employeeID')
            ->select('leaverequests.*', 'employees.firstName', 'employees.lastName', 'employees.employeeID')
            ->get();

        $totalEmployees = Employee::where('companyID', session('user')->companyID)->count();

        $today = date('Y-m-d');
        $presentEmployees = Attendance::where('attendance.scheduleDate', $today)
            ->leftJoin('employees', 'attendance.employeeID', '=', 'employees.employeeID')
            ->where('employees.companyID', session('user')->companyID)
            ->count();

        $absentEmployees = $totalEmployees - $presentEmployees;

        return view('admin_dashboard', compact('employees', 'totalEmployees', 'presentEmployees', 'absentEmployees'));
    }

    public function approveRequest($id)
    {
        Leaverequest::where('requestID', $id)->update(['approvalStatus' => 'Approved']);
        return $this->viewAdminDashboard();
    }

    public function denyRequest($id)
    {
        Leaverequest::where('requestID', $id)->update(['approvalStatus' => 'Denied']);
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

        $employees = Employee::leftJoin('departments', 'employees.departmentID', '=', 'departments.departmentID')
            ->leftJoin('designations', 'employees.designationID', '=', 'designations.designationID')
            ->select('employees.*', 'departments.departmentName', 'designations.designationName')
            ->where('employees.companyID', session('user')->companyID)
            ->orderBy($sort, $order)
            ->get();

        return view('admin_employeeoverview', compact('employees'));
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

}

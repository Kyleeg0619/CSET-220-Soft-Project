<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use App\Models\Attendance;
use App\Models\Department;
use App\Models\Designation;
use App\Models\Employee;
use App\Models\Leaverequest;
use App\Models\Payroll;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rules\Can;

class AdminController extends Controller
{
    
    public function viewAdminDashboard() {
        $admin = Auth::guard('admin')->user();

        $employees = Leaverequest::where('leaverequests.companyID', $admin->companyID)->where('leaverequests.approvalStatus','Pending')
        ->leftJoin('employees', 'leaverequests.employeeID', '=', 'employees.employeeID')
        ->select('leaverequests.*', 'employees.firstName', 'employees.lastName','employees.employeeID')->limit(10)
        ->get();

        // Total Employees
        $totalEmployees = Employee::where('companyID',$admin->companyID)->count();

        // Present Employees
        $today = Carbon::now()->toDateString();
        $presentEmployees = Attendance::where('employees.companyID',$admin->companyID)->where('attendance.scheduleDate',$today)->leftJoin('employees','attendance.employeeID','=','employees.employeeID')->count();

        // Absent Employees
        $absentEmployees = $totalEmployees - $presentEmployees;

        // Payroll this month
        $month = Carbon::now()->month;
        $year = Carbon::now()->year;
        $totalPay = DB::table('payroll')
    ->where('companyID', $admin->companyID)
    ->whereMonth('payStart', $month)
    ->whereYear('payStart', $year)
    ->sum('payment');


        return view('admin_dashboard', compact('admin','employees', 'totalEmployees', 'presentEmployees', 'absentEmployees', 'totalPay'));
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
        $admin = Auth::guard('admin')->user();
        $departments = Department::where('companyID', $admin->companyID)->get();
        $designations = Designation::all();

        return view('create_employee', compact('departments', 'designations'));
    }

    public function createEmployee(Request $request)
    {
        $admin = Auth::guard('admin')->user();
        Employee::create([
            'firstName'     => $request->firstName,
            'lastName'      => $request->lastName,
            'email'         => $request->email,
            'password'      => Hash::make($request->password),
            'departmentID'  => $request->departmentID,
            'designationID' => $request->designationID,
            'companyID'     => $admin->companyID,
            'salary'        => 0.00,
            'employee_type' => $request->employee_type,
            'salary_type'   => $request->salary_type,
            'rate'        => $request->rate
        ]);

        return redirect('/admin/employeeoverview')->with('success', 'Employee Created Successfully!');
    }

    public function viewEmployeeOverview(Request $request)
    {
        $admin = Auth::guard('admin')->user();
        $sort = $request->get('sort', 'lastName');
        $order = $request->get('order', 'asc');
        return view('admin_employeeoverview', [
            'employees' => Employee::where('employees.companyID', $admin->companyID)
                ->leftJoin('departments', 'employees.departmentID', '=', 'departments.departmentID')
                ->leftJoin('designations', 'employees.designationID', '=', 'designations.designationID')
                ->select('employees.*', 'departments.departmentName', 'designationName')
                ->orderBy($sort, $order)
                ->paginate(10),
        ]);
    }

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
        $admin = Auth::guard('admin')->user();
        $employee = Employee::leftJoin('departments', 'employees.departmentID', '=', 'departments.departmentID')
            ->leftJoin('designations', 'employees.designationID', '=', 'designations.designationID')
            ->select('employees.*', 'departments.departmentName', 'designations.designationName')
            ->where('employeeID', $id)
            ->first();

        $departments = Department::where('companyID', $admin->companyID)->get();
        $designations = Designation::all();
        $employmentTypes = ['full-time', 'part-time', 'contractor'];
        $salaryTypes = ['hourly', 'monthly'];

        return view('admin_editemployee', compact('employee', 'departments', 'designations','employmentTypes','salaryTypes'));
    }

    public function updateEmployee(Request $request, $id)
    {
        Employee::where('employeeID', $id)->update([
            'firstName'     => $request->firstName,
            'lastName'      => $request->lastName,
            'email'         => $request->email,
            'departmentID'  => $request->departmentID,
            'designationID' => $request->designationID,
            'employee_type' => $request->employee_type,
            'salary_type'   => $request->salary_type,
            'rate'          => $request->rate
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
        $admin = Auth::guard('admin')->user();
        $employee = Employee::leftJoin('departments', 'employees.departmentID', '=', 'departments.departmentID')
            ->leftJoin('designations', 'employees.designationID', '=', 'designations.designationID')
            ->select(
                'employees.*',
                'departments.departmentName',
                'designations.designationName'
            )
            ->where('employees.employeeID', $id)
            ->where('employees.companyID', $admin->companyID)
            ->first();

        if (!$employee) {
            return redirect('/admin/employeeoverview')->with('error', 'Employee not found');
        }

        $departments = Department::where('companyID', $admin->companyID)->get();
        $designations = Designation::all();

        $attendanceRecords = Attendance::where('employeeID', $id)
            ->orderBy('scheduleDate', 'desc')
            ->paginate(25);

        $payrolls = Payroll::where('employeeID', $id)
            ->orderBy('payStart', 'desc')
            ->paginate(25);

        return view('admin_employeeprofile', compact('employee', 'departments', 'designations','attendanceRecords', 'payrolls'));
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
        'rate'        => $request->rate,
        'employee_type' => $request->employee_type,
        'salary_type'   => $request->salary_type,
    ];

    // Handle photo upload
    if ($request->hasFile('profile_pic')) {
        $imageName = time().'.'.$request->profile_pic->extension();
        $request->profile_pic->move(public_path('profile_images'), $imageName);
        $data['profile_pic'] = $imageName;
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

    public function viewAttendanceRecords() {
        $admin = Auth::guard('admin')->user();

        $attendanceRecords = Attendance::where('employees.companyID', $admin->companyID)
            ->leftJoin('employees', 'attendance.employeeID', '=', 'employees.employeeID')
            ->select('attendance.*', 'employees.firstName', 'employees.lastName','employees.employeeID')
            ->orderBy('attendance.scheduleDate', 'desc')
            ->paginate(25);

        return view('admin_attendance', compact('attendanceRecords'));
    }

    public function filterAttendance(Request $request) {
        $admin = Auth::guard('admin')->user();

        if ($request->endDate < $request->startDate) {
            return redirect()->back()->with('error', 'End date must be after start date.');
        }

        $query = Attendance::where('employees.companyID', $admin->companyID)
            ->leftJoin('employees', 'attendance.employeeID', '=', 'employees.employeeID')
            ->select('attendance.*', 'employees.firstName', 'employees.lastName','employees.employeeID');

        

        $attendanceRecords = $query->whereBetween('scheduleDate',[$request->startDate,$request->endDate])->orderBy('attendance.scheduleDate', 'desc')->paginate(25);

        return view('admin_attendance', compact('attendanceRecords'));
    }

    // Admin Profile
    public function viewAdminProfile() {
        $adminInfo = Auth::guard('admin')->user();
        $admin = Admin::leftJoin('departments','admins.departmentID','=','departments.departmentID')->leftJoin('designations','admins.designationID','=','designations.designationID')->leftJoin('companies','admins.companyID','=','companies.companyID')->select('admins.*','designations.designationName','departments.departmentName','companies.companyName')->where('admins.adminID', $adminInfo->adminID)->first();
        return view('admin_profile', compact('admin'));
    }

    public function updateAdminProfile(Request $request) {
        $adminInfo = Auth::guard('admin')->user();
        $admin = Admin::findOrFail($adminInfo->adminID);

        // Basic validation
        $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'password' => 'nullable|string|min:6'
        ]);

        $data = [
            'firstName' => $request->input('first_name'),
            'lastName' => $request->input('last_name'),
            'email' => $request->input('email'),
        ];

        if ($request->filled('password')) {
            $data['password'] = Hash::make($request->input('password'));
        }

        // Handle photo upload
        if ($request->hasFile('profile_pic')) {
            $imageName = time().'.'.$request->profile_pic->extension();
            $request->profile_pic->move(public_path('profile_images'), $imageName);
            $data['profile_pic'] = $imageName;
        }

        $admin->update($data);

        return redirect('/admin/profile')->with('msg', 'Info updated successfully!');
    }
}

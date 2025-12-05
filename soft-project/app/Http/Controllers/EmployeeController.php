<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Company;
use App\Models\Department;
use App\Models\Designation;
use App\Models\Employee;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Payroll;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use TCPDF;

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
        $employeeInfo = Auth::guard('employee')->user();
        $employee = Employee::findOrFail($employeeInfo->employeeID);

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

        $employee->update($data);

        return redirect('/employee/profile')->with('msg', 'Info updated successfully!');
    }
    
    public function viewEmployeePayHistory(){
          $employee = Auth::guard('employee')->user();
          $history=Payroll::where('employeeID',$employee->employeeID)->paginate(30);
        return view('employee_payroll',['employee'=>$employee,'history'=>$history]);
    }

    public function exportPayslipPDF($payrollID){
          $employee = Auth::guard('employee')->user();

          $employeeInfo = Employee::leftJoin('departments','employees.departmentID','=','departments.departmentID')->leftJoin('designations','employees.designationID','=','designations.designationID')->leftJoin('companies','employees.companyID','=','companies.companyID')->select('employees.*','designations.designationName','departments.departmentName','companies.companyName')->where('employees.employeeID', $employee->employeeID)->first();
          $payroll=Payroll::where('payrollID',$payrollID)->first();
          if($payroll->employeeID != $employee->employeeID){
              return redirect()->route('employee/profile')->with('error', 'Unauthorized access to payslip.');
          }

          $daysWorked = DB::table('attendance')
    ->select(DB::raw('COUNT(DISTINCT DATE(clockIN)) as daysWorked'))
    ->where('employeeID', $employee->employeeID)
    ->groupBy('employeeID')
    ->first();


        $pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
        $pdf->AddPage();
        $html = view('payslip_pdf', ['employeeInfo' => $employeeInfo, 'payroll' => $payroll,'daysWorked'=>$daysWorked->daysWorked])->render();
        $pdf->writeHTML($html, true, false, true, false, '');
        $pdf->Output('payslip_'.$payrollID.'.pdf', 'I');

        return "Generating PDF for Payroll ID: " . $payrollID;
    }
}

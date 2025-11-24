<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Employee;
use App\Models\Payroll;
use App\Models\Attendance;
use Carbon\Carbon;

class PayrollController extends Controller
{
    public function index()
    {
        $payrolls = Payroll::with('employee')->get();
        return view('admin.payroll.index', compact('payrolls'));
    }

    public function generate(Request $request)
    {
        $payStart = $request->input('payStart', Carbon::now()->startOfMonth()->toDateString());
        $payEnd = $request->input('payEnd', Carbon::now()->endOfMonth()->toDateString());

        $deductions = $request->input('deductions', []);
        $employees = Employee::all();

        foreach ($employees as $emp) {

            $attendance = Attendance::where('employeeID', $emp->employeeID)
                ->whereBetween('scheduleDate', [$payStart, $payEnd])
                ->get();

            $weeks = [];
            foreach ($attendance as $att) {
                $weekKey = Carbon::parse($att->scheduleDate)->startOfWeek()->toDateString();
                if (!isset($weeks[$weekKey])) $weeks[$weekKey] = 0;
                $weeks[$weekKey] += floatval($att->totalHours);
            }

            $deduction = $deductions[$emp->employeeID] ?? 0;
            $salaryData = $emp->calculateSalary($weeks, $deduction);
            Payroll::updateOrCreate(
                [
                    'employeeID' => $emp->employeeID,
                    'companyID' => $emp->companyID,
                    'payStart' => $payStart,
                    'payEnd' => $payEnd
                ],
                [
                    'grossPay'      => $salaryData['gross'],
                    'overtimeHours' => $salaryData['overtimeHours'],
                    'deductions'    => $deduction,
                    'payment'       => $salaryData['payment'],
                    'status'        => 'Unprocessed',
                    'notes'         => ''
                ]
            );
        }

        return redirect()->back()->with('success', 'Payroll generated successfully.');
    }
}

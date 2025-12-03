<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Employee;
use App\Models\Payroll;
use App\Models\Attendance;
use Carbon\Carbon;

class PayrollController extends Controller
{
    public function index()
    {
        $payrolls = Payroll::with('employee')->orderBy('payEnd', 'desc')->paginate(30);
        return view('admin.payroll.index', compact('payrolls'));
    }

    public function generate(Request $request)
    {
        $admin = Auth::guard('admin')->user();
        $today = Carbon::today();
        $recentFriday = $today->isFriday()
            ? $today
            : $today->previous(Carbon::FRIDAY);

        $payEnd = $recentFriday->toDateString();
        $payStart = $recentFriday->copy()->subDays(13)->toDateString();


        $deductions = $request->input('deductions', []);
        $employees = Employee::where('companyID', $admin->companyID)->get();

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

            // Calculate gross first, then apply 4% deduction of gross, adjust payment accordingly
            $salaryDataGross = $emp->calculateSalary($weeks, 0);
            $gross = $salaryDataGross['gross'] ?? 0;
            $overtime = $salaryDataGross['overtimeHours'] ?? 0;
            $deduction = round($gross * 0.04, 2);
            $payment = max($gross - $deduction, 0);

            Payroll::updateOrCreate(
                [
                    'employeeID' => $emp->employeeID,
                    'payEnd'     => $payEnd,
                ],
                [
                    'companyID'     => $emp->companyID,
                    'payStart'      => $payStart,
                    'grossPay'      => $gross,
                    'overtimeHours' => $overtime,
                    'deductions'    => $deduction,
                    'payment'       => $payment,
                    'status'        => 'Unprocessed',
                    'notes'         => ''
                ]
            );
        }
    }

    public function markAllProcessed()
    {
        Payroll::where('status', 'Unprocessed')->update(['status' => 'Processed']);
        return redirect()->back()->with('success', 'All unprocessed payrolls have been marked as processed.');
    }

    public function markProcessed($id)
    {
        Payroll::where('payrollID', $id)->update(['status' => 'Processed']);
        return redirect()->back()->with('success', "Payroll $id has been marked as processed.");
    }
}

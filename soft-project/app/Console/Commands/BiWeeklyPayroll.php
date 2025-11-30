<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Carbon\Carbon;
use App\Models\Employee;
use App\Models\Payroll;
use App\Models\Attendance;

class BiWeeklyPayroll extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:bi-weekly-payroll';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Run biweekly payroll starting November 1, 2025';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        // Determine the most recent Friday (if today is Friday, use today)
        $today = Carbon::today();
        $recentFriday = $today->isFriday() ? $today : $today->previous(Carbon::FRIDAY);

        $payEnd = $recentFriday->toDateString();
        $payStart = $recentFriday->copy()->subDays(13)->toDateString();

        $this->info("Starting bi-weekly payroll for pay period: {$payStart} → {$payEnd}");

        // Process payroll for each employee (grouped by company)
        $employees = Employee::all();
        $created = 0;
        foreach ($employees as $emp) {
            // Skip if payroll for this payEnd already exists
            $exists = Payroll::where('employeeID', $emp->employeeID)
                ->where('payEnd', $payEnd)
                ->exists();
            if ($exists) {
                continue;
            }

            // Enforce bi-weekly schedule: only generate if it's been at least 14 days since the last generated payroll
            $lastPayroll = Payroll::where('employeeID', $emp->employeeID)
                ->orderBy('payEnd', 'desc')
                ->first();
            if ($lastPayroll) {
                $daysSinceLast = Carbon::parse($lastPayroll->payEnd)->diffInDays(Carbon::parse($payEnd));
                if ($daysSinceLast < 14) {
                    // last payroll was less than 14 days ago - skip this employee
                    continue;
                }
            }

            $attendance = Attendance::where('employeeID', $emp->employeeID)
                ->whereBetween('scheduleDate', [$payStart, $payEnd])
                ->get();

            $weeks = [];
            foreach ($attendance as $att) {
                $weekKey = Carbon::parse($att->scheduleDate)->startOfWeek()->toDateString();
                if (!isset($weeks[$weekKey])) $weeks[$weekKey] = 0;
                $weeks[$weekKey] += floatval($att->totalHours);
            }

            $deduction = 0; // Default scheduled generation has no manual deductions

            $salaryData = $emp->calculateSalary($weeks, $deduction);

            Payroll::updateOrCreate(
                [
                    'employeeID' => $emp->employeeID,
                    'payEnd'     => $payEnd,
                ],
                [
                    'companyID'     => $emp->companyID,
                    'payStart'      => $payStart,
                    'grossPay'      => $salaryData['gross'],
                    'overtimeHours' => $salaryData['overtimeHours'],
                    'deductions'    => $deduction,
                    'payment'       => $salaryData['payment'],
                    'status'        => 'Unprocessed',
                    'notes'         => ''
                ]
            );
            $created++;
        }

        $this->info("Payroll generation complete — created/updated: {$created} payroll records.");
    }
}

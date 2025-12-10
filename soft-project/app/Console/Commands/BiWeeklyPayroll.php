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
        $skipped = 0;

        foreach ($employees as $emp) {
            // Validate employee has required fields
            if (!$emp->employeeID || !$emp->companyID) {
                $this->warn("Skipping employee with missing ID or company.");
                $skipped++;
                continue;
            }

            // Skip if no rate or salary_type set
            if (empty($emp->rate) || empty($emp->salary_type)) {
                $this->warn("Employee {$emp->employeeID} ({$emp->firstName} {$emp->lastName}): missing rate or salary_type. Skipping.");
                $skipped++;
                continue;
            }

            // Skip if payroll for this payEnd already exists
            $exists = Payroll::where('employeeID', $emp->employeeID)
                ->where('payEnd', $payEnd)
                ->exists();
            if ($exists) {
                $this->line("Payroll already exists for employee {$emp->employeeID}. Skipping.");
                $skipped++;
                continue;
            }

            // Enforce bi-weekly schedule: only generate if it's been at least 14 days since the last generated payroll
            $lastPayroll = Payroll::where('employeeID', $emp->employeeID)
                ->orderBy('payEnd', 'desc')
                ->first();
            if ($lastPayroll) {
                $daysSinceLast = Carbon::parse($lastPayroll->payEnd)->diffInDays(Carbon::parse($payEnd));
                if ($daysSinceLast < 14) {
                    $this->line("Employee {$emp->employeeID}: last payroll only {$daysSinceLast} days ago. Skipping.");
                    $skipped++;
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
                $weeks[$weekKey] += floatval($att->totalHours ?? 0);
            }

            // Calculate gross first, then apply 4% deduction of gross, adjust payment accordingly
            $salaryData = $emp->calculateSalary($weeks, 0);
            $gross = round($salaryData['gross'] ?? 0, 2);
            $overtime = round($salaryData['overtimeHours'] ?? 0, 2);
            $deduction = round($gross * 0.04, 2);
            $payment = round(max($gross - $deduction, 0), 2);

            // Skip if payment is 0
            if ($payment == 0) {
                $this->line("Employee {$emp->employeeID}: payment is 0. Skipping.");
                $skipped++;
                continue;
            }

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

            $this->line("✓ Employee {$emp->employeeID}: gross={$gross}, overtime={$overtime}hrs, deductions={$deduction}, payment={$payment}");
            $created++;
        }

        $this->info("Payroll generation complete — created/updated: {$created} payroll records, skipped: {$skipped}.");
    }
}

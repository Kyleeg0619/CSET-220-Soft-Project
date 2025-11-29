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
        
    }
}

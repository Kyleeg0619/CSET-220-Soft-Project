<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;

class Employee extends Authenticatable
{
    protected $fillable = [
        'firstName', 'lastName', 'email', 'password',
        'departmentID', 'designationID', 'companyID',
        'salary', 'employee_type', 'salary_type', 'rate','profile_pic'
    ];

    public $timestamps = false;

    protected $primaryKey = 'employeeID';


    public function calculateSalary(array $weeks, float $deduction = 0): array
    {
        $gross = 0;
        $overtimeHours = 0;

        // Validate rate exists and is numeric
        $rate = floatval($this->rate ?? 0);
        if ($rate < 0) {
            $rate = 0;
        }

        // Determine salary type (default to hourly if not set)
        $salaryType = strtolower($this->salary_type ?? 'hourly');

        if ($salaryType === 'hourly') {
            foreach ($weeks as $weekHours) {
                $weekHours = floatval($weekHours);
                if ($weekHours > 40) {
                    $gross += 40 * $rate;
                    $gross += ($weekHours - 40) * $rate * 1.5;
                    $overtimeHours += ($weekHours - 40);
                } else {
                    $gross += $weekHours * $rate;
                }
            }
        } else {
            // Salaried/monthly: rate is the monthly salary
            $gross = $rate;
        }

        // Ensure all monetary values are rounded to 2 decimals
        $gross = round($gross, 2);
        $deduction = round($deduction, 2);
        $payment = max(round($gross - $deduction, 2), 0);
        $overtimeHours = round($overtimeHours, 2);

        return [
            'gross'         => $gross,
            'payment'       => $payment,
            'overtimeHours' => $overtimeHours
        ];
    }
}

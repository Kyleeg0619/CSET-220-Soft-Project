<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;

class Employee extends Authenticatable
{
    protected $fillable = [
        'firstName', 'lastName', 'email', 'password',
        'departmentID', 'designationID', 'companyID',
        'salary', 'employee_type', 'salary_type', 'rate'
    ];

    public $timestamps = false;

    protected $primaryKey = 'employeeID';

    public function calculateSalary(array $weeks, float $deduction = 0): array
    {
        $gross = 0;
        $overtimeHours = 0;

        if ($this->salary_type === 'hourly') {
            foreach ($weeks as $weekHours) {
                if ($weekHours > 40) {
                    $gross += 40 * $this->rate;
                    $gross += ($weekHours - 40) * $this->rate * 1.5;
                    $overtimeHours += ($weekHours - 40);
                } else {
                    $gross += $weekHours * $this->rate;
                }
            }
        } else {
            $gross = $this->rate ?: 0;
        }

        return [
            'gross'         => $gross,
            'payment'       => max($gross - $deduction, 0),
            'overtimeHours' => $overtimeHours
        ];
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Payroll extends Model
{
    protected $primaryKey='payrollID';
    protected $fillable=[
        'payrollID',
        'employeeID',
        'companyID',
        'month',
        'basepay',
        'overtimeHours',
        'otRate',
        'totalSalary',
        'status'
    ];
}

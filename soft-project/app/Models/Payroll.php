<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class payroll extends Model
{
    protected $table = 'payroll';

    protected $primaryKey = 'payrollID';

    protected $fillable = [
        'payrollID',
        'employeeID',
        'companyID',
        'payPeriodEnd',
        'grossPay',
        'netPay',
        'deductions',
        'companyID'
    ];
}

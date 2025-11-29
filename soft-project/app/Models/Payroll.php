<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payroll extends Model
{
    use HasFactory;

    protected $table = 'payroll';
    protected $primaryKey = 'payrollID';
    public $timestamps = false;

    protected $fillable = [
        'employeeID',
        'companyID',
        'payStart',
        'payEnd',
        'grossPay',
        'overtimeHours',
        'deductions',
        'payment',
        'status',
        'notes'
    ];

    public function employee()
    {
        return $this->belongsTo(Employee::class, 'employeeID', 'employeeID');
    }

    public function company()
    {
        return $this->belongsTo(Company::class, 'companyID', 'companyID');
    }
}

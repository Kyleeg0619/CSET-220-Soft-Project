<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    protected $primaryKey = 'employeeID';
    protected $fillable = [
        'firstName',
        'lastName',
        'email',
        'password',
        'departmentID',
        'designationID',
        'companyID',
        'salary'
    ];
}

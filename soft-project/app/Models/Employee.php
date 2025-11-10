<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Employee extends Authenticatable
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

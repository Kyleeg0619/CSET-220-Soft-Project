<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    protected $primaryKey = 'employeeID';
    public $timestamps = false;
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

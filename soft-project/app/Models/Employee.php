<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    protected $table = 'employee'; // matches your phpMyAdmin table name
    protected $primaryKey = 'employeeID'; // custom primary key
    public $timestamps = false; // disable if your table doesn't use created_at/updated_at

    protected $fillable = [
        'employeeFirstName',
        'employeeLastName',
        'employeeEmail',
        'departmentID',
        'designation',
        'salary'
    ];

}

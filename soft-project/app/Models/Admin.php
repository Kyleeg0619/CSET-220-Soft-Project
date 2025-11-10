<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Admin extends Model
{
    protected $primaryKey = 'adminID';
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

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\CompanyUsers;
use App\Models\Company;

class Department extends Model
{
    protected $primaryKey = 'departmentID';
    protected $fillable = [
        'departmentID',
        'departmentName',
        'companyID'
    ];
}

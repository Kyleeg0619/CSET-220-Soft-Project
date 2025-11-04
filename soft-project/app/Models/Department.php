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

    public function company() {
        return $this->belongsTo(Company::class,'companyID');
    }

    public function user() {
        return $this->hasMany(CompanyUsers::class,'departmentID');
    }
}

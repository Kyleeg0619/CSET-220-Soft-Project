<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use app\Models\Department;

class Company extends Model
{
    protected $primaryKey = 'companyID';
        protected $fillable = [
        'companyID',
        'companyName'
    ];
}

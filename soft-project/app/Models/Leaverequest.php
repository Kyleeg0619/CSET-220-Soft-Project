<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Leaverequest extends Model
{
    protected $table = 'leaverequests';
    public $timestamps = false;

    protected $primaryKey = 'requestID';

    protected $fillable = [
        'employeeID',
        'companyID',
        'reason',
        'leaveStart',
        'leaveEnd',
        'approvalStatus',
        'submissionDate'
    ];
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Attendance extends Model
{
    protected $table = 'attendance';
    public $timestamps = false;

    protected $primaryKey = 'attendanceID';

    protected $fillable = [
        'employeeID',
        'scheduleDate',
        'clockIN',
        'clockOUT',
        'totalHours'
    ];
}

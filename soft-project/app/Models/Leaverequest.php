<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Leaverequest extends Model
{
    protected $table = 'leaverequests';
    public $timestamps = false;

    protected $primaryKey = 'RequestID';

    protected $fillable = [
        'userID',
        'reason',
        'leaveStart',
        'leaveEnd',
        'approvalStatus',
        'requestDate'
    ];
}

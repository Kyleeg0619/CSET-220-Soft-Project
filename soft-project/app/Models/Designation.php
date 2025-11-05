<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Designation extends Model
{
    protected $primaryKey = 'designationID';
    protected $fillable = [
        'designationName'
    ];
}

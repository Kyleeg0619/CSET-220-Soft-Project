<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CompanyUsers extends Model
{
    protected $primaryKey = 'userID';
    protected $fillable = [
        'firstName',
        'lastName',
        'email',
        'password',
        'departmentID',
        'designation',
        'salary'
    ];

    public function department() {
        return $this->belongsTo(Department::class,'departmentID');
    }

    protected function casts(): array {
        return [
            'password'=>'hashed',
        ];
    }
}

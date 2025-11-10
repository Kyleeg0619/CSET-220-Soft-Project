<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    // 🔹 Explicitly link to your renamed table
    protected $table = 'company_users';
    protected $primaryKey = 'userID';
    public $timestamps = false; // no created_at or updated_at in your schema

    protected $fillable = [
        'firstName',
        'lastName',
        'email',
        'password',
        'departmentID',
        'designation',
        'salary',
        'userRole'
    ];

    protected $hidden = ['password'];

    protected function casts(): array
    {
        return [
            'salary' => 'decimal:2',
            'password' => 'hashed',
        ];
    }
}

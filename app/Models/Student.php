<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;

class Student extends Authenticatable
{
    protected $fillable = [
        'name',
        'googleId',
        'email',
        'mobile_number',
        'password',
        'user_type',
    ];

    public static function getUserDataByEmail($email){
        $user = Student::where('email', $email)->first();
        return $user;
    }
}

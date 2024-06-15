<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Students extends Model
{
    use HasFactory;
    protected $fillable = [
        'cnic',
        'registerationNo',
        'name',
        'fatherName',
        'email',
        'dob',
        'gender',
        'department',
        'mobileNo',
        'password',
        'image',
        'slipImage',
        'certificate',
        'verifyMobileNo',
        'status',
    ];
}

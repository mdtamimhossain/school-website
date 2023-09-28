<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserInfo extends Model
{
    use HasFactory;
    protected $fillable=[
        'user_id',
        'fullName',
        'email',
        'number',
        'class',
        'birthdate',
        'fatherName',
        'motherName',
        'address'
    ];
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Admission extends Model
{
    use HasFactory;
    protected $fillable=[
        'name',
        'fName',
        'mName',
        'age',
        'gender',
        'birthdate',
        'address',
        'number',
        'email',
        'currentClass',
        'intendedClass'
    ];
}

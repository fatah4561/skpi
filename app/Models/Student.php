<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    use HasFactory;
    protected $fillable = [
        'nrp',
        'name',
        'class',
        'major',
        'college_type',
        'phone_number',
        'picture',
        'defence_status',
    ];
}

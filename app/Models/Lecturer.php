<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lecturer extends Model
{
    use HasFactory;

    protected $fillable = [
        'lecturer_name',
    ];

    // one to many skpiData
    public function skpiData(){
        return $this -> hasMany('App\SkpiData');
    }
}

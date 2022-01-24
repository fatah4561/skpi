<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SkpiData extends Model
{
    use HasFactory;
    
    protected $table = 'skpi_datas';

    // many to one SkpiCollection
    public function skpiCollection(){
        return $this -> belongsTo('App\SkpiData');
    }

    // one to one SkpiFile
    public function skpiFile(){
        return $this -> hasOne('App\SkpiFile');
    }

    // one to one student
    public function student(){
        return $this -> belongsTo('App\Student');
    }

    // one to one lecturer
    public function lecturer(){
        return $this -> belongsTo('App\Lecturer');
    }

    // one to many activityData
    public function activityData(){
        return $this -> hasMany('App\ActivityData');
    }
}

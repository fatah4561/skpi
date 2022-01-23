<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ActivityData extends Model
{
    use HasFactory;

    // one to many skpiData
    public function skpiData(){
        return $this -> belongsTo('App\SkpiData');
    }

    // one to one activityFile
    public function activityFile(){
        return $this -> hasOne('App\ActivityFile');
    }
}

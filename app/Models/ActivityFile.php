<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ActivityFile extends Model
{
    use HasFactory;

    // one to many activityData
    public function activityData(){
        return $this -> belongsTo('App\activityData');
    }
}

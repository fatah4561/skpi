<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SkpiFile extends Model
{
    use HasFactory;

    // many to one SkpiCollection
    public function skpiCollection(){
        return $this -> belongsTo('App\SkpiCollection');
    }

    // one to one SkpiData
    public function skpiData(){
        return $this -> belongsTo('App\SkpiData');
    }
}

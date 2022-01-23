<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CollectionDetail extends Model
{
    use HasFactory;

    // many to one SkpiCollection
    public function skpiCollection(){
        return $this -> belongsTo('App\SkpiCollection');
    }

    // one to one student
    public function student(){
        return $this -> hasOne('App\SkpiCollection');
    }
}

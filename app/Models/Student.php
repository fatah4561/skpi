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
    // one to one user
    public function user(){
        return $this -> belongsTo('App\User');
    }

    // one to one skpiData
    public function skpiData(){
        return $this -> hasOne('App\SkpiData');
    }

    // many to one collectionDetail
    public function collectionDetail(){
        return $this -> belongsTo('App\CollectionDetail');
    }
}

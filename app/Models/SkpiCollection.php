<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SkpiCollection extends Model
{
    use HasFactory;

    // fillable
    protected $fillable = [
        'start_date',
        'end_date',
        'collection_type',
        'detail',
        'academic_year',
        
    ];
    
    // one to many SkpiData
    public function skpiData(){
        return $this -> hasMany('App\SkpiData');
    }

    // one to many SkpiFile
    public function skpiFile(){
        return $this -> hasMany('App\SkpiFile');
    }

    // one to many CollectionDetails
    public function collectionDetail(){
        return $this -> hasMany('App\CollectionDetail');
    }
}

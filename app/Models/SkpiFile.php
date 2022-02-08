<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SkpiFile extends Model
{
    use HasFactory;
    protected $fillable = [
        'skpi_data_id',
        'collection_id',
        'mosmta_file',
        'oracle_file',
        'mtcna_file',
        'ccent_file',
        'ccna_file',
        'toeic_file',
        'moswa_file',
        'other_file',
        'organization_experience_file',
        'award_file',
        'created_at',
        'date_filled',
    ];

    // many to one SkpiCollection
    public function skpiCollection(){
        return $this -> belongsTo('App\SkpiCollection');
    }

    // one to one SkpiData
    public function skpiData(){
        return $this -> belongsTo('App\SkpiData');
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CertificateVersion extends Model
{
    use HasFactory;

    protected $table = 'certificate_versions';
    protected $fillable = [
        'certificate_id',
        'version'
    ];
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

// models proses SKPI
use App\Models\ActivityData;
use App\Models\ActivityFile;
use App\Models\CollectionDetail;
use App\Models\SkpiCollection;
use App\Models\SkpiData;
use App\Models\SkpiFile;

class SkpiController extends Controller
{
    //
    public function indexStudent(){
        return view('skpi.indexMahasiswa', ['type' => 1]);
    }
    public function indexAdmin(){
        return view('layouts.custom', ['type' => 0]);
    }
}

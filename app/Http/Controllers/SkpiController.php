<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

// other class
use DateTime;

// models proses SKPI
use App\Models\ActivityData;
use App\Models\ActivityFile;
use App\Models\CollectionDetail;
use App\Models\SkpiCollection;
use App\Models\SkpiData;
use App\Models\SkpiFile;
use App\Models\Student;

use Illuminate\Support\Facades\Auth;

class SkpiController extends Controller
{
    //
    public function indexStudent(){
        $collections = SkpiCollection::all();
        // looping untuk date, menghitung deadline
        $diff = array();
        $today = new DateTime('now');
        // cek apakah collection kosong atau tidak
        if(!$collections->isEmpty()){
            // looping date
            foreach ($collections as $collection){
                $d2 = new DateTime($collection->end_date);
                array_push($diff, $today->diff($d2));
            }
        }else{
            $diff = null;
        }

        // nama belum diuji karena tidak ada datanya coba nyien hela jang insert studentna
        $nama = $this->getNama(Auth::id());

        return view('skpi.indexStudent', [
            'type' => 1,
            'nama' => $nama,
            'collections' => $collections,
            'today' => $today,
            'deadlines' => $diff,
        ]);
    }
    public function indexAdmin(){
        return view('layouts.custom', ['type' => 0]);
    }
    // belum diuji
    private function getNama($user_id){
        $student = Student::find($user_id);
        return $student->name;
    }
}

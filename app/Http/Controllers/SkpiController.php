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
        // $nama = $this->getNama(Auth::id());

        return view('skpi.indexStudent', [
            'type' => 1,
            'menu' => 'dashboard',
            'nama' => 'nama_acan',
            'collections' => $collections,
            'today' => $today,
            'deadlines' => $diff,
        ]);
    }
    public function indexAdmin(){
        // inisialisasi
        $collections = SkpiCollection::all();
        $skpi_datas = SkpiData::all();
        $students = Student::all();


        // hitung jumlah
        $total_collection = $collections->count();
        $total_skpi_data = $skpi_datas->count();
        $total_student = $students->count();
        // jumlah belum kdu query manual sigana

        // dd(Auth::user()->name);
        return view('skpi.indexAdmin', [
            'type' => 0,
            'menu' => 'dashboard',
            'user_name' => 'Admin',
            'pic' => 'admin',
            'total_collection' => $total_collection,
            'total_skpi_data' => $total_skpi_data,
            'total_student' => $total_student,
            'total_unfilled' => 0,
        ]);
    }
    public function indexSkpi(){
        $collections = SkpiCollection::all();
        return view('skpi.skpiManagement', [
            'type' => 0,
            'menu' => 'skpi',
            'collections' => $collections,
        ]);
    }

    // search ajax
    public function searchAjax($search){
        
    }
    // belum diuji
    private function getNama($user_id){
        $student = Student::find($user_id);
        return $student->name;
    }
}

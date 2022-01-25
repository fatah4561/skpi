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
    // bagian mahasiswa
    public function indexStudent(){
        $today = new DateTime('now');
        $collections = SkpiCollection::all();
        $diff = $this->deadline($today, $collections);
        // nama belum diuji karena tidak ada datanya coba nyien hela jang insert studentna
        // $nama = $this->getNama(Auth::id());

        return view('skpi.indexStudent', [
            'type' => 1,
            'menu' => 'dashboard',
            'user_name' => 'nama_acan',
            'pic' => 'null',
            'collections' => $collections,
            'today' => $today,
            'deadlines' => $diff,
        ]);
    }

    // bagian admin
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
    // index untuk menampilkan pengumpulan SKPI
    public function indexSkpi(){
        $today = new DateTime('now');
        $collections = SkpiCollection::all();
        $diff = $this->deadline($today, $collections);

        // mengecek apakah pengumpulan skpi ada isinya,
        // memecah academic year
        $has_fill = [];
        foreach($collections as $collection){
            // $academic_year.array_push($this->splitYear($collection));
            array_push($has_fill, $this->getSkpiData($collection->id));
        }
        // foreach ($has_fill as $item){
        //     dd($item);
        // }


        return view('skpi.skpiManagement', [
            'type' => 0,
            'menu' => 'skpi',
            'user_name' => 'Admin',
            'pic' => 'admin',
            'today' => $today,
            'diff' => $diff,
            'has_fill' => $has_fill,
            'collections' => $collections,
        ]);
    }
    // index untuk menampilkan ISI pengumpulan SKPI
    public function indexSkpiData(){
        return "ok gan";
    }
    // fungsi store pengumpulan SKPI
    public function storeCollection(Request $request, SkpiCollection $collection){
        // cek jika data student sudah ada maka update
        if($request->student_id == 1){
            // dd($request->student_id);
            $this -> updateCollection($request, $collection);
            return redirect('/skpi')->with('success', 'Data Pengumpulan Diubah');
        }else{
            // merge tahun akademik
            $academic_year = $request->year_a."-".$request->year_b;
            // insert pengumpulan
            $collection = SkpiCollection::create([
                'start_date' => $request->start_date,
                'end_date' => $request->end_date,
                'collection_type' => $request->collection_type,
                'detail' => $request->detail,
                'academic_year' => $academic_year,
            ]);
            $collection -> save();
            // get last inserted id
            return redirect('/skpi')->with('success', 'Data Pengumpulan Ditambahkan');
        }
    }
    // update pengumpulan SKPI
    public function updateCollection(Request $request, SkpiCollection $collection)
    {
        # code...
    }
    // delete pengumpulan skpi jika kosong
    public function deleteCollection($collection_id)
    {
        # code...
    }
    // fungsi penghitung deadline pengumpulan, input datetime today, array collection
    private function deadline($today, $collections){
        // looping untuk date, menghitung deadline
        $diff = array();
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
        return $diff;
    }
    // fungsi untuk memecahkan academic year karena format asalnya yyyy-yyyy menjadi 2
    // yyyy dan yyyy karena pada form ada 2 input untuk academic year
    private function splitYear($collection){
        return end($split);
    }
    // inner join skpi_data, student, lecturer
    private function getSkpiData($collection_id){
        $data = SkpiData::join('students', 'skpi_datas.student_id', '=', 'students.id')
        ->join('lecturers', 'skpi_datas.lecturer_id', '=', 'lecturers.id')
        ->where('collection_id', '=', $collection_id)
        ->get();
        return $data;
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

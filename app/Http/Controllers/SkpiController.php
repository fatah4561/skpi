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
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class SkpiController extends Controller
{
    /**
     * bagian mahasiswa
     */
    // index setelah login
    public function indexStudent(){
        $today = new DateTime('now');
        $collections = SkpiCollection::all();
        $diff = $this->deadline($today, $collections);

        // mengambil data student saat ini
        $id_user = Auth::id();
        $student = Student::where('user_id', '=', $id_user)->first();
        $user_name = $student->name;
        $user_pic = $student->picture;

        // session mahasiswa
        session(['user_id' => $id_user]);
        session(['user_name' => $user_name]);
        session(['user_type' => '1']);
        session(['user_pic' => $user_pic]);

        return view('skpi.indexStudent', [
            'menu' => 'dashboard',
            'collections' => $collections,
            'today' => $today,
            'deadlines' => $diff,
        ]);
    }
    // index profile mahasiswa
    public function indexProfile(){
        // inner join
        $student = Student::join('users', 'students.user_id', '=', 'users.id')
        ->where('students.user_id', '=', session('user_id'))
        ->first();
        // $student = Student::where('user_id', session('user_id'))->first();
        return view('skpi.student.profile', [
            'student' => $student,
            'menu' => 'profile'
        ]);
    }
    // halaman form skpi mahasiswa
    public function indexForm(){
        // inner join
        $student = Student::join('users', 'students.user_id', '=', 'users.id')
        ->where('students.user_id', '=', session('user_id'))
        ->first();
        // $student = Student::where('user_id', session('user_id'))->first();
        return view('skpi.student.form', [
            'student' => $student,
            'menu' => 'form'
        ]);
    }
    /**
     * private function mahasiswa
     */

    private function getNRP($nrp){
        
    }

    /**
     * bagian admin
     */
    public function indexAdmin(){
        // inisialisasi
        $collections = SkpiCollection::all();
        $skpi_datas = SkpiData::all();
        $students = Student::all();

        // simpan session
        session(['user_name' => 'Admin']);
        session(['user_type' => '0']);
        session(['user_pic' => 'admin']);

        // hitung jumlah
        $total_collection = $collections->count();
        $total_skpi_data = $skpi_datas->count();
        $total_student = $students->count();
        // jumlah belum kdu query manual sigana, enggs jir naon sih

        // dd(Auth::user()->name);
        return view('skpi.indexAdmin', [
            'menu' => 'dashboard',
            'total_collection' => $total_collection,
            'total_skpi_data' => $total_skpi_data,
            'total_student' => $total_student,
            'total_unfilled' => 0,
        ]);
    }
    // index untuk menampilkan pengumpulan SKPI
    public function indexSkpi(){
        $today = new Carbon();
        $collections = SkpiCollection::all();
        $diff = $this->deadline($today, $collections);

        // mengecek isi pengumpulan apakah kosong
        $has_fill = [];
        foreach($collections as $collection){
            array_push($has_fill, $this->getSkpiData($collection->id));
        }


        return view('skpi.skpiManagement', [
            'menu' => 'skpi',
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
        if($request->collection_id != null){
            // dd($request->student_id);
            $this -> updateCollection($request, $collection);
            return redirect('/skpi')->with('success', 'Pengumpulan SKPI Diubah');
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
            return redirect('/skpi')->with('success', 'Pengumpulan SKPI Ditambahkan');
        }
    }
    // update pengumpulan SKPI
    public function updateCollection(Request $request, SkpiCollection $collection)
    {
        # code...
        // merge tanggal akademik
        $academic_year = $request->year_a."-".$request->year_b;
        // mulai update
        $collection = SkpiCollection::find($request->collection_id);
        $collection->update([
            'start_date' => $request->start_date,
            'end_date' => $request->end_date,
            'collection_type' => $request->collection_type,
            'detail' => $request->detail,
            'academic_year' => $academic_year,
        ]);
    }
    // delete pengumpulan skpi jika kosong
    public function deleteCollection($collection_id)
    {
        // hapus pengumpulan
        $collection = SkpiCollection::find($collection_id);
        $collection->delete();
        return redirect('/skpi')->with('success', 'Pengumpulan SKPI Dihapus');

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

    // inner join skpi_data, student, lecturer
    private function getSkpiData($collection_id){
        $data = SkpiData::join('students', 'skpi_datas.student_id', '=', 'students.id')
        ->join('lecturers', 'skpi_datas.lecturer_id', '=', 'lecturers.id')
        ->where('collection_id', '=', $collection_id)
        ->get();
        if($data->isEmpty()){
            return false;
        }else{
            // dd($data);
            return true;
        }
    }

    // search ajax
    public function searchAjaxCollection(Request $request){
        $collections = SkpiCollection::where('start_date', 'like', '%'.$request->search_skpi.'%' )
        ->orWhere('end_date', 'like', '%'.$request->search_skpi.'%' )
        ->orWhere('collection_type', 'like', '%'.$request->search_skpi.'%' )
        ->orWhere('detail', 'like', '%'.$request->search_skpi.'%' )
        ->orWhere('academic_year', 'like', '%'.$request->search_skpi.'%' )
        ->get();

        $today = new Carbon();
        $diff = $this->deadline($today, $collections);

        // mengecek isi pengumpulan apakah kosong
        $has_fill = [];
        foreach($collections as $collection){
            array_push($has_fill, $this->getSkpiData($collection->id));
        }

        // render HTML meh teu kdu nga loop js :)
        $returnHTML = view('skpi.ajax.skpiCollection', [
            'today' => $today,
            'diff' => $diff,
            'has_fill' => $has_fill,
            'collections' => $collections,
        ])->render();

        return $returnHTML;
    }


}

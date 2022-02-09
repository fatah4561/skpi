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
use App\Models\Lecturer;
use App\Models\CertificateVersion;

use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class SkpiController extends Controller
{
    // private Global $id_collection = '';

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
        session(['student_id' => $student->id]);
        session(['student_nrp' => $student->nrp]);
        session(['student_class' => $student->class]);
        dd(session('student_class'));

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
        $student_id = session('student_id');
        // list pembimbing
        $lecturers = Lecturer::orderBy('lecturer_name', 'asc')->get();

        // get versi sertifikat
        $certificates = CertificateVersion::all();

        // get pengumpulan sekarang
        $collections = SkpiCollection::all();
        // bandingkan tanggal
        $today = new DateTime('now');
        $diff = $this->deadline($today, $collections);

        // get data mahasiswa jika sudah mengumpulkan
        $skpi = SkpiData::where('student_id', $student_id)->first(); 
        
        // ketentuan pengisian form ialah
        // 1 pengumpulan skpi belum melebihi deadline -> diambilkan pengumpulan terkini dengan deadline tertinggi, acan kie sih
        // 2 data student pengisi merupakan data yang telah lulus
        // 3 kategori pengumpulan skpi cocok dengan kategori mahasiswanya
        // misalnya kelas IF berarti IF hungkul kitu sih
        $loop_index = 0;
        $id_collection = [];
        foreach($diff as $item ){
            if($item->invert != 1){
                array_push($id_collection, $loop_index);
            }
            $loop_index++;
        }
        // cek jika ada pengumpulan
        if(!empty($id_collection)){
            $category = $collections[$id_collection[0]];
            // dd($category->id);
        }else{
            session()->flash('msg', 'Tidak ada pengisian SKPI tersedia');
            return view('skpi.indexStudent', [
                'menu' => 'dashboard',
                'collections' => $collections,
                'today' => $today,
                'deadlines' => $diff,
            ]);
        }
        // cek apakah memenuhi sarat
        if(!empty($skpi)){
            session()->flash('msg', 'Anda telah mengisi data SKPI');
            return view('skpi.indexStudent', [
                'menu' => 'dashboard',
                'collections' => $collections,
                'today' => $today,
                'deadlines' => $diff,
            ]);
        }elseif($student->defence_status == 'Sudah Lulus' && 
            (($category->collection_type == 'Semua Mahasiswa') ||
               ($category->collection_type == 'Mahasiswa Jurusan SI' && ($student->major == 'MI' || $student->major == 'SI')) ||
                ($category->collection_type == 'Mahasiswa Jurusan IF' && ($student->major == 'MI' || $student->major == 'IF')) ||
                ($category->collection_type == 'Mahasiswa Jurusan MI' && ($student->major == 'MI' || $student->major == 'IF' || $student->major == 'SI')) || 
                ($category->collection_type == 'Mahasiswa Tingkat 4 Saja' && (substr($student->class, 0 , 1) == '4')) || 
                ($category->collection_type == 'Mahasiswa Tingkat 3 Saja' && (substr($student->class, 0, 1) == '3')) || 
                ($category->collection_type == 'Beberapa Mahasiswa' && ($student->nrp == '100101010'))
            )
            ){
            return view('skpi.student.form', [
                'student' => $student,
                'lecturers' => $lecturers,
                'certificates' => $certificates,
                'id_collection' => $category->id,
                'menu' => 'form'
            ]);
        }elseif($student->defence_status == 'Belum Lulus'){
            // dd('if');
            session()->flash('msg', 'Anda berstatus belum lulus sidang');
            return view('skpi.indexStudent', [
                'menu' => 'dashboard',
                'collections' => $collections,
                'today' => $today,
                'deadlines' => $diff,
            ]);
        }

    }

    public function fillForm(Request $request){
        $today = new DateTime('now');
        $collections = SkpiCollection::all();
        $diff = $this->deadline($today, $collections);

        // insert skpi data table
        $date_filled = new DateTime('now');
        $array_cert = ['mos', 'oracle', 'mtcna', 'ccent', 'ccna', 'toeic', 'moswa', 'other', 'organization_experience', 'award'];
        $certs = [];
        // looping tiap jenis sertifikat jika dikirim 1 atau ada maka input ke array,
        // jika 1 maka 0 versi sertifikat dari request nya jika 0 maka push 0
        foreach($array_cert as $cert){
            if($request[$cert] == 1){
                // dd('ok');
                $temp_cert = 'select_'.$cert;
                // dd($request->$temp_cert);
                array_push($certs, $request[$temp_cert]);
            }elseif($request[$cert] == 0){
                array_push($certs, $request[$cert]);
            }
        }
        // dd($certs);
        $skpi_data = SkpiData::create([
            'student_id' => session('student_id'),
            'collection_id' => $request->id_collection,
            'lecturer_id' => $request->lecturer,
            'mosmta' => $certs[0],
            'oracle' => $certs[1],
            'mtcna' => $certs[2],
            'ccent' => $certs[3],
            'ccna' => $certs[4],
            'toeic' => $certs[5],
            'moswa' => $certs[6],
            'other' => $certs[7],
            'organization_experience' => $certs[8],
            'award' => $certs[9],
            'thesis_title' => $request->thesis_title,
            'date_filled' => $date_filled,
        ]);
        $skpi_data->save();
        $id_skpi_data = $skpi_data->id;

        // Storage::makeDirectory('storage/test');
        // dd($request->file() );

        // file upload tabel skpi_files
        // algo na teh
        // loop list certifikat diluhur terus cek mun si file na teu null berarti pindahken 
        // nah array push weh si lokasi filena nu te null mun null nya null pushna
        $file_db = [];
        $nrp = session('student_nrp');
        $name = session('user_name');
        $class = session('student_class');
        foreach($array_cert as $index=>$cert){
            // dd($request->file("file_moswa"));
            if($request->file("file_{$cert}")!= null){
                $extension = $request->file("file_{$cert}")->getClientOriginalExtension();
                $filename = $nrp.'_'.$cert.'.'.$extension;
                $filepath = $request->file("file_{$cert}")->storeAs("storage/{$class}_{$nrp}_{$name}", $filename, 'public');
                array_push($file_db, $filepath);
            }else{
                array_push($file_db, null);
            }

        }
        $skpi_file = SkpiFile::create([
            'skpi_data_id' => $id_skpi_data,
            'collection_id' => $request->id_collection,
            'mosmta_file' => $file_db[0],
            'oracle_file' => $file_db[1],
            'mtcna_file' => $file_db[2],
            'ccent_file' => $file_db[3],
            'ccna_file' => $file_db[4],
            'toeic_file' => $file_db[5],
            'moswa_file' => $file_db[6],
            'other_file' => $file_db[7],
            'organization_experience_file' => $file_db[7],
            'award_file' => $file_db[8],
            'created_at' => $date_filled,
            'date_filled',
        ]);
        $skpi_file->save();

        return view('skpi.indexStudent', [
            'menu' => 'dashboard',
            'collections' => $collections,
            'today' => $date_filled,
            'deadlines' => $diff,
        ])->with('success', 'Data SKPI berhasil dikumpulkan');
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
        ])->with('success', 'Data SKPI berhasil dikumpulkan');
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
    public function indexSkpiData($collection_id){
        $skpi_datas = SkpiCollection::join('skpi_datas', 'skpi_collections.id', '=', 'skpi_datas.collection_id')
        ->join('skpi_files', 'skpi_datas.id', '=', 'skpi_files.skpi_data_id')
        ->join('students', 'skpi_datas.student_id', '=', 'students.id')
        ->join('lecturers', 'skpi_datas.lecturer_id', '=', 'lecturers.id')
        ->where('skpi_collections.id', '=', $collection_id)
        ->get();
        return view('skpi.skpiData', [
            'skpi_datas' => $skpi_datas,
            'menu' => 'skpi'
        ]);
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

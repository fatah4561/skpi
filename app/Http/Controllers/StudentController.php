<?php

namespace App\Http\Controllers;

use App\Models\Student;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;

class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $students = Student::all();
        return view('skpi.studentManagement', [
            'type' => 0,
            'menu' => 'student',
            'user_name' => 'Admin',
            'pic' => 'admin',
            'students' => $students,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Student $student)
    {
        // validate server acan

        // cek jika data student sudah ada maka update
        if($request->data_mahasiswa == 1){
            // dd($request->student_id);
            $this -> update($request, $student);
            return redirect('/student')->with('success', 'Data Mahasiswa Diubah');
        }else{
            // insert user
            $user = User::create([
                'email' => $request->email,
                'password' => Hash::make($request->email),
                'type' => 1,
                'google_id' => null,
            ]);
            $user -> save();
            // get last inserted id
            $user_id = $user->id;
            // dd($user_id);
            // insert student table
            $student::create([
                'user_id' => $user_id,
                'nrp' => $request->nrp,
                'name' => $request->name,
                'class' => $request->class,
                'major' => $request->major,
                'college_type' => $request->college_type,
                'phone_number' => $request->phone_number,
                'picture' => null,
                'defence_status' => $request->defence_status,
            ]);
            return redirect('/student')->with('success', 'Data Mahasiswa Ditambahkan');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Student  $student
     * @return \Illuminate\Http\Response
     */
    public function show(Student $student)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Student  $student
     * @return \Illuminate\Http\Response
     */
    public function edit(Student $student)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Student  $student
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Student $student)
    {
        //
        // dd($request->student_id);
        $student = Student::find($request->student_id);
        $student->update([
            'nrp' => $request->nrp,
            'name' => $request->name,
            'class' => $request->class,
            'major' => $request->major,
            'college_type' => $request->college_type,
            'phone_number' => $request->phone_number,
            'defence_status' => $request->defence_status,
        ]);
        // $student->save();
        return redirect('/student')->with('success', 'Data Mahasiswa Diubah');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Student  $student
     * @return \Illuminate\Http\Response
     */
    public function destroy(Student $student)
    {
        //
    }

    // search ajax, sukses cuk
    public function searchAjax(Request $request){
        $students = Student::where('name', 'like', '%'.$request->search_student.'%')
        ->orWhere('nrp', 'like', '%'.$request->search_student.'%' )
        ->orWhere('class', 'like', '%'.$request->search_student.'%' )
        ->orWhere('major', 'like', '%'.$request->search_student.'%' )
        ->orWhere('college_type', 'like', '%'.$request->search_student.'%' )
        ->orWhere('defence_status', 'like', '%'.$request->search_student.'%' )
        ->get();
        // render HTML meh teu kdu nga loop js ;)
        $returnHTML = view('skpi.ajax.student')->with('students', $students)->render();
        return $returnHTML;
    }

    // search duplikat nrp ajax
    public function nrpCheck(Request $request){
        // dd($request->nrp);
        $students = Student::where('nrp', '=',$request->nrp)->first();
        // dd($students);
        if($students != null){
            return 1;
        }else{
            return 0;
        }
        // return $students;
    }
}

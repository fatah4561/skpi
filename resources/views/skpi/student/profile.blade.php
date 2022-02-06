@extends('layouts.custom')
    @section('content')
        {{-- profile mahasiswa --}}
        {{-- native lengitken --}}
        {{-- <div>
            <?=$header -> get_alert(3, 'Jika ada data yang kurang tepat silahkan hubungi prodi');?>
        </div> --}}
        <div class="card">

            <div class="card-body">
            <form>
                <!-- row 1, readonly data -->
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="namaLengkap">Nama Lengkap</label>
                        <input type="text" class="form-control" id="nama_lengkap" value="{{$student->name}}" placeholder="Nama Lengkap" readonly>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="inputEmail">Email</label>
                        <input type="email" class="form-control" id="email" value="{{$student->email}}" placeholder="Email"  readonly>
                    </div>

                </div>
                <!-- row 2, readonly data -->
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="nrp">NRP</label>
                        <input type="email" class="form-control" id="nrp" value="{{$student->nrp}}" readonly>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="kelas">Kelas</label>
                        <input type="textarea" class="form-control" id="kelas" value="{{$student->class}}" readonly>
                    </div>
                </div>

                <!-- row 3, readonly data -->
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="nrp">Jurusan</label>
                        <input type="email" class="form-control" id="jurusan" value="{{$student->major}}" readonly>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="kelas">Semester</label>
                        <input type="textarea" class="form-control" id="semester" value="{{($student->class[0]=='3')?'6':'8'}}" readonly>
                    </div>
                </div>

                <!-- row 4, readonly data -->
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="nrp">Tipe Kuliah</label>
                        <input type="email" class="form-control" id="nrp" value="{{$student->college_type}}" readonly>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="kelas">No Telepon</label>
                        <input type="textarea" class="form-control" id="kelas" value="{{$student->phone_number}}" readonly>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md">
                        <label for="nrp">Status Sidang</label>
                        <input type="email" class="form-control" id="nrp" value="{{$student->defence_status}}" readonly>
                    </div>
                </div>
            </form>
            </div>
        </div>
    @endsection
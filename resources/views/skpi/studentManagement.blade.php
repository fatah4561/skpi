@extends('layouts.custom')
    @section('content')
        @if (session()->get('success'))
            <div class="alert alert-success">
                {{ session()->get('success')}}
            </div>
        @endif
        <div class="card">
            <div class="card-body">

                <div class="row">
                    <div class="col"><h2>Data Mahasiswa</h2></div>

                    <div class="col-right text-right px-2"><a class="btn btn-primary btn-sm" id="tambah" href="" role="button" data-toggle="modal" data-target="#tambah_pengumpulan">Tambah</a></div>
                    <div class="col-right">
                    <div class="d-flex justify-content-center px-2">
                        {{-- <?php // button?> --}}
                    </div>
                    </div>
                    <div class="col-right">
                        <div class="d-flex justify-content-center px-2">
                            <div class="search"> <input id="search_skpi" type="text" class="search-input" placeholder="Cari..." name=""> <a href="#" class="search-icon"> <i class="fa fa-search"></i> </a> </div>
                        </div>
                    </div>
                    
                </div>
                <div id="spot_alert">

                    {{-- spot alert acan --}}
                    {{-- <?php
                        if(isset($_GET['sukses'])):
                            $teks;
                            if($_GET['sukses'] == 1){
                                $teks = 'Data mahasiswa berhasil ditambahkan';
                            }elseif($_GET['sukses'] == 2){
                                $teks = 'Data mahasiswa berhasil diperbaharui';
                            }
                        ?>  
                            
                        <?php
                            echo $header -> get_alert(0, $teks);
                        endif;
                    ?> --}}
                </div>

                <hr class="border">
                <div class="table-responsive">
                    <table class="table table-striped table-hover">
                        <thead class="bg-primary text-light">
                            <tr>
                            <th scope="col">#</th>
                            <th scope="col">NRP</th>
                            <th scope="col">Nama</th>
                            <th scope="col">Kelas</th>
                            <th scope="col">Jurusan</th>
                            <th scope="col">Tipe&nbsp;Kuliah</th>
                            <th scope="col">Email</th>
                            <th scope="col">Nomor&nbsp;Telepon</th>
                            <th scope="col">Status&nbsp;Sidang</th>
                            <th scope="col" class="text-center">Opsi</th>
                            </tr>
                        </thead>
                        <tbody id="isi_tabel_mahasiswa">
                            @foreach ($students as $student)                          
                                <tr>
                                    <th scope="row">{{ $loop->iteration }}</th>
                                    
                                    <td>{{ $student->nrp }}</td>
                                    <td>{{ $student->name }}</td>
                                    <td>{{ $student->class }}</td>
                                    <td>{{ $student->major }}</td>
                                    <td>{{ $student->college_type }}</td>
                                    <td>{{ $student->user->email }}</td>
                                    <td>{{ $student->phone_number }}</td>
                                    <td>{{ $student->defence_status }}</td>
                                    <td><a class="btn btn-outline-primary" href="" id="edit" data-toggle="modal" 
                                        data-target="#tambah_pengumpulan" data-nrp="{{$student->nrp}}" 
                                        data-nama="{{$student->name}}" data-kelas="{{$student->class}}" 
                                        data-jurusan="{{$student->major}}" data-tipe="{{$student->college_type}}" 
                                        data-email="{{$student->user->email }}" data-no="{{$student->phone_number}}" 
                                        data-status="{{$student->defence_status}}"
                                            role="button"><i class="fa fa-pencil" aria-hidden="true"></i></a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <script src="{{asset('js/jquery/jquery.min.js')}}"></script>
        <script>
            $(document).ready(function(){
                // fungsi update
                $(document).on('click', '#edit', function(){
                    var nrp = $(this).attr('data-nrp');
                    var nama = $(this).attr('data-nama');
                    var kelas = $(this).attr('data-kelas');
                    var jurusan = $(this).attr('data-jurusan');
                    var tipe = $(this).attr('data-tipe');
                    var email = $(this).attr('data-email');
                    var no = $(this).attr('data-no');
                    var status = $(this).attr('data-status');


                    if(tipe == "Reguler"){
                        tipe = 1;
                    }else if(tipe == "Profesional"){
                        tipe = 2;
                    }
                    if(status == "Belum Lulus"){
                        status = 1;
                    }else if(status == "Sudah Lulus"){
                        status = 2;
                    }

                    
                    $('#button_tambah_mahasiswa').html('Ubah');
                    $('#data_mahasiswa').val(1);
                    $('#nrp').val(nrp);
                    $('#nama').val(nama);
                    $('#kelas').val(kelas);
                    $('#jurusan').val(jurusan);
                    $('#email').val(email);
                    $('#nomor_telp').val(no);
                    $('#tipe_kuliah').val(tipe);
                    $('#status').val(status);

                    $('#banyak_button').hide();
                });
                // fungsi tambah (reset isi)
                $(document).on('click', '#tambah', function(){
                    $('#data_mahasiswa').val(0);
                    $('#button_tambah_mahasiswa').html('Tambahkan');
                    $("#form_tambah_mahasiswa").trigger("reset");
                    $('#banyak_button').show();
                });

                // search ajax
                $('#search_skpi').keyup(function(){
                    let search_student = $('#search_skpi').val();
                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $(`meta[name="csrf-token"]`).attr('content')
                        }
                    });
                    $.ajax({
                        method:"POST",
                        url:`{!! route('search_student') !!}`,
                        data: {search_student: search_student},
                        success:function(data)
                        {
                            $(`#isi_tabel_mahasiswa`).html(data);
                        }
                    });
                });

            });
        </script>

        <!-- modal -->
        <div class="modal fade bd-example-modal-lg" id="tambah_pengumpulan" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Tambah mahasiswa</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
            </div>
            <div class="modal-body">
                    <nav class="nav nav-pills nav-fill" role="tablist">
                        <a class="nav-link active" id="manual_button" aria-current="page" href="#manual" aria-controls="manual" role="tab" data-toggle="tab">Satuan / Manual</a>
                        <a class="nav-link" id="banyak_button" href="#banyak" aria-controls="banyak" role="tab" data-toggle="tab">Import Excel</a>
                    </nav>
                    <hr/>
                    <div class="tab-content">
                        <!-- Tab manual -->
                        <div role="tabpanel" class="tab-pane active" id="manual">
                            <form method="post" action="{{route('student.store')}}" name="form_tambah_mahasiswa" id="form_tambah_mahasiswa" enctype="multipart/form-data">
                                @csrf
                                <div class="row">
                                    <div class="col" id="alert_nrp">
                                        {{-- alert nrp dinamis can jalan --}}
                                    </div>
                                </div>
                                <input type="hidden" value="0" name="student_id" id="data_mahasiswa">
                                <div class="row">
                                    <div class="col">
                                        <label for="nrp">NRP</label>
                                        <input id="nrp" type="number" min="1000000" max="999999999"  class="form-control" name="nrp" required>
                                    </div>
                                    <div class="col">
                                        <label for="nama">Nama</label>
                                        <input id="nama" type="text"  class="form-control" name="name" required>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col">
                                        <label for="kelas">Kelas</label>
                                        <input id="kelas" maxlength="7" style="text-transform:uppercase" type="text"  class="form-control" name="class" required>
                                    </div>
                                    <div class="col">
                                        <label for="jurusan">Jurusan</label>
                                        <input id="jurusan" style="text-transform:uppercase" type="text"  class="form-control" name="major" readonly>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col">
                                        <label for="email">Email</label>
                                        <input id="email" type="email"  class="form-control" name="email" required readonly>
                                    </div>
                                    <div class="col">
                                        <label for="nomor_telp">Nomor Telepon</label>
                                        <input id="nomor_telp" type="text" class="form-control" min-length="11" max-length="14" name="phone_number" required>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col">
                                        <label for="tipe_kuliah">Tipe Kuliah</label></br>
                                        <div class="input-group mb-3">
                                            <div class="input-group-prepend">
                                                <label class="input-group-text" for="tipe_kuliah">Pilih</label>
                                            </div>
                                            <select class="custom-select" id="tipe_kuliah" name="college_type" required>
                                                <option value="1">Reguler</option>
                                                <option value="2">Professional</option>
                                            </select>
                                        </div>
                                        
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col">
                                        <label for="status">Status Sidang</label></br>
                                        <div class="input-group mb-3">
                                            <div class="input-group-prepend">
                                                <label class="input-group-text" for="status">Pilih</label>
                                            </div>
                                            <select class="custom-select" id="status" name="defence_status" required>
                                                <option value="1">Belum Lulus</option>
                                                <option value="2">Sudah Lulus</option>
                                            </select>
                                        </div>
                                        
                                    </div>
                                </div>
                            </form>
                        </div>
                        <!-- Tab banyak -->
                        <div role="tabpanel" class="tab-pane" id="banyak">
                            <center><h6>Format Excel Samakan Seperti Berikut:</h6>
                            </center>
                            <img class="img-fluid" src="img\format_import.png" alt="format excel">
                            <h6>1. Urutan kolom harus sama</h6>
                            <h6>2. Nama kolom tidak harus persis</h6>
                            <h6>3. Baris pertama hanya header kolom (tidak akan dianggap sebagai data mahasiswa)</h6>
                            <h6>4. Data mahasiswa mulai dari baris kedua</h6>
                            <h6>5. Data mahasiswa yang dimasukkan hanya data yang sudah lulus sidang saja (berhak mengisi SKPI)</h6>
                            <form action="" id="form_import" name="form_import" enctype="multipart/form-data" method="POST">
                                @csrf
                                <div class="custom-file">
                                    <input name="file_import" type="file" class="custom-file-input" id="file_import" accept=".xls">
                                    <label class="custom-file-label" for="file_import">Pilih File format hanya excel 97-2003 workbook (.xls)</label>
                                </div>
                            </form>
                        </div>
                    </div>

                    

            </div>
            
            <div class="modal-footer">
                {{-- <?php $button = "Tambahkan";?>  --}}
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button id="button_tambah_mahasiswa" type="button" class="btn btn-primary">Tambahkan</button>
            </div>
        </div>
        </div>
    </div>
    @endsection
    {{-- custom js --}}
    @section('custom_js')
    <script type="text/javascript">
        $(document).ready(function(){
            var kelas;
            var nrp;
            let input;
            let nama;
            let ajaran;
            let email;
            let allow;
    
    
            $(document).on('click', '#tambah', function(){
                input = 0;
                $('#tambah_pengumpulan').find('.modal-title').text('Tambah Mahasiswa');
            });
            $(document).on('click', '#edit', function(){
                input = 1;
                $('#tambah_pengumpulan').find('.modal-title').text('Edit Mahasiswa');
            });
            // tab modal
            $(document).on('click', '#manual_button', function(){
                input = 0;
            });
            $(document).on('click', '#banyak_button', function(){
                input = 3;
            });
    
            // jurusan otomatis + tipe kuliah
            $("#kelas").keyup(function(){
                kelas = $(this).val();
                kelas = kelas.replace(/\d+/g,'');
                ajaran = kelas.replace(/[-p]/g,'');
                $("#jurusan").val(ajaran);
    
                if(kelas.includes('P') || kelas.includes('p')){
                    $("#tipe_kuliah").val(2);
                }else{
                    $("#tipe_kuliah").val(1);
                }
            });
            // email otomatis
                $("#nrp").keyup(function(){
                nrp = $(this).val();
                email = nrp+'@fellow.lpkia.ac.id'
                $("#email").val(email);
    
                // live cek nrp
                let cek_nrp = $(this).val();
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $(`meta[name="csrf-token"]`).attr('content')
                    }
                });
                $.ajax({
                    method:"POST",
                    url:`{!! route('nrp_check') !!}`,
                    data: {nrp: nrp},
                    complete:function(r){
                        if(r.responseText == "1" && !document.getElementById('isi_alert_nrp' && input == 0)){
                            $("#alert_nrp").append(`
                            <div class="alert alert-danger" role="alert" id="isi_alert_nrp">
                                <i class="fa fa-exclamation-circle" aria-hidden="true"></i> NRP terdapat dalam database</div>`);
                            allow = 1;
                        }else if(r.responseText != "1"){
                            $('#isi_alert_nrp').remove();
                            allow = 2;
                        }
                    }
    
                });
            });
            // nama regex
            $("#nama").keyup(function(){
                nama = $(this).val();
                nama = nama.replace(/[^a-z A-Z]/g,'');
                $("#nama").val(nama);
            });

            // phone number regex
            $('#nomor_telp').keyup(function(){
                nomor = $(this).val();
                nomor = nomor.replace(/[^0-9]/g, '');
                $("#nomor_telp").val(nomor);
            });
            // button submit form, validasi required
            $(document).on('click', '#button_tambah_mahasiswa', function(){	
                if(input == 3){
                    // import excel
                    var formData = new FormData($("#form_import")[0]);
                    jQuery.ajax({
                        url: 'class/excel.php',
                        type: "POST",
                        data: formData,
                        success: function(data) {
                            $('#tambah_pengumpulan').modal('hide');
                            $('#spot_alert').append(`{{'header alert here'}}`);
                            $("#form_import").trigger("reset");
                            window.history.replaceState( null, null, window.location.href );
                            window.location.replace('index.php?page=mahasiswa&sukses=1');
                        },
                        error: function(data) {
                            $('#spot_alert').append(`{{'header gagal here'}}`);
                            $("#form_import").trigger("reset");
                        },
                        cache: false,
                        contentType: false,
                        processData: false,
                    });
                }else{
                    // input manual dan edit 
                  for (const el of document.getElementById('form_tambah_mahasiswa').querySelectorAll("[required]")) {
                    if (!el.reportValidity()) {
                      return;
                    }
                  }if(allow == 2 || input == 1){$('#form_tambah_mahasiswa').submit();}
                }
            });
        });
    </script>
    @endsection
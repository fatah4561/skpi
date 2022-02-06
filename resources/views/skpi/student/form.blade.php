@extends('layouts.custom')
    @section('content')
        {{-- native --}}
        {{-- <?php
            // isi container untuk data skpi

            if($cek_isi == true){
                // nothing
                echo "<script>
                alert('Anda sudah mengisi data');
                window.location.replace('index.php');
                </script>";
            }
            // if(isset($_POST['form_data'])){
            //     $_SESSION['NamaLengkap'] = $_POST['namaLengkap'];
            //     $_SESSION['NamaLengkap'] = $_POST['namaLengkap'];
            // }
        ?> --}}
        <div id="alert_spot_data">

        </div>
        <div class="card">

            <div class="card-body">
                <form method="POST" action="class/fileUpload.php" enctype="multipart/form-data" id="form_data" name="form_data">
                    <!-- row 1, readonly data -->
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="namaLengkap">Nama Lengkap</label>
                            <input type="text" class="form-control" id="namaLengkap" value="{{$student->name}}" name="namaLengkap" readonly>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="inputEmail">Email</label>
                            <input type="email" class="form-control" id="inputEmail" value="{{$student->email}}"  readonly name="email">
                        </div>

                    </div>
                    <!-- row 2, readonly data -->
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="nrp">NRP</label>
                            <input type="text" class="form-control" id="nrp" value="{{$student->nrp}}" readonly name="nrp">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="kelas">Kelas</label>
                            <input type="text" class="form-control" id="kelas" value="{{$student->class}}" name="kelas" readonly>
                        </div>
                    </div>

                    <input type="hidden" name="id_pengumpulan" value="{{'id ti pengumpulanna acan'}}">

                    <!-- MOS -->
                    <div class="form-group">
                        <label for="inputAddress">Memiliki Sertifikat Microsoft Office Specialist (MOS) ?/ Microsoft Technology Associate (MTA)</label></br>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="mos" id="mos1" value="1" required>
                            <label class="form-check-label" for="mos1">Ya</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="mos" id="mos2" value="0" checked>
                            <label class="form-check-label" for="mos2" >Tidak</label>
                        </div>
                        <div  class="form-check" id="div_file_mos">

                        </div>
                    </div>

                    <!-- oracle -->
                    <div class="form-group">
                        <label for="inputAddress">Memiliki Sertifikat Oracle ?</label></br>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="oracle" id="oracle1" value="1" required>
                            <label class="form-check-label" for="oracle1">Ya</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="oracle" id="oracle2" value="0" checked>
                            <label class="form-check-label" for="oracle2" >Tidak</label>
                        </div>
                        <div  class="form-check" id="div_file_oracle">
                        </div>
                    </div> 

                    <!-- mtcna -->
                    <div class="form-group">
                        <label for="inputAddress">Memiliki Sertifikat Mikrotik Certified Network Associate (MTCNA) ?</label></br>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="mtcna" id="mtcna1" value="1" required>
                            <label class="form-check-label" for="mtcna1">Ya</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="mtcna" id="mtcna2" value="0" checked>
                            <label class="form-check-label" for="mtcna2" >Tidak</label>
                        </div>
                        <div  class="form-check" id="div_file_mtcna">
                        </div>
                    </div> 

                    <!-- cisco ccent -->
                    <div class="form-group">
                        <label for="inputAddress">Memiliki Sertifikat CISCO CCENT ?</label></br>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="ccent" id="ccent1" value="1" required>
                            <label class="form-check-label" for="ccent1">Ya</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="ccent" id="ccent2" value="0" checked>
                            <label class="form-check-label" for="ccent2" >Tidak</label>
                        </div>
                        <div  class="form-check" id="div_file_ccent">
                        </div>
                    </div>   
                    
                    <!-- cisco ccna -->
                    <div class="form-group">
                        <label for="inputAddress">Memiliki Sertifikat CISCO CCNA ?</label></br>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="ccna" id="ccna1" value="1" required>
                            <label class="form-check-label" for="ccna1">Ya</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="ccna" id="ccna2" value="0" checked>
                            <label class="form-check-label" for="ccna2" >Tidak</label>
                        </div>
                        <div  class="form-check" id="div_file_ccna">
                        </div>
                    </div> 

                    <!-- toeic -->
                    <div class="form-group">
                        <label for="inputAddress">Memiliki Sertifikat TOEIC ?</label></br>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="toeic" id="toeic1" value="1" required>
                            <label class="form-check-label" for="toeic1">Ya</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="toeic" id="toeic2" value="0" checked>
                            <label class="form-check-label" for="toeic2" >Tidak</label>
                        </div>
                        <div  class="form-check" id="div_file_toeic">
                        </div>
                    </div>   

                    <!-- moswa -->
                    <div class="form-group">
                        <label for="inputAddress">Memiliki Sertifikat MOSWA ?</label></br>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="moswa" id="moswa1" value="1" required>
                            <label class="form-check-label" for="moswa1">Ya</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="moswa" id="moswa2" value="0" checked>
                            <label class="form-check-label" for="moswa2" >Tidak</label>
                        </div>
                        <div  class="form-check" id="div_file_moswa">
                        </div>
                    </div>  

                    <!-- other cert -->
                    <div class="form-group">
                        <label for="other">Nama Sertifikasi Internasional selain di atas</label>
                        <input type="text" name="other" class="form-control" id="other" placeholder="tulis nama sertifikasi dengan lengkap jangan di singkat Contoh : 'CEH (Certified Ethical Hacker)'">
                        <div class="form-check" id="div_other">
                            
                        </div>
                    </div>

                    <!-- Sertifikat / Kegiatan (1) -->
                    <div class="form-group">
                        <label for="keg1">Sertifikat / Kegiatan (1)</label>
                        <input type="text" name="keg1" class="form-control" id="keg1" placeholder="opsional">
                        <div class="form-check" id="div_keg1">
                            
                        </div>
                    </div>
                    <div id="keg_lain">

                    </div>


                    <!-- Sertifikat / Kegiatan (3) -->
                    <!-- <div class="form-group">
                        <label for="keg3">Sertifikat / Kegiatan (3)</label>
                        <input type="text" name="keg3" class="form-control" id="keg3" placeholder="opsional">
                        <div class="form-check" id="div_keg3">
                            
                        </div>
                    </div> -->

                    <!-- organisasi -->
                    <div class="form-group">
                        <label for="organisasi">Pengalaman Organisasi di LPKIA</label>
                        <input type="text" name="organisasi" class="form-control" id="organisasi" max="60" placeholder="kosongkan bila tidak memiliki pengalaman Organisasi di LPKIA">
                        <div class="form-check" id="div_organisasi">  
                        </div>
                    </div>

                    <!-- prestasi -->
                    <div class="form-group">
                        <label for="prestasi">Penghargaan dan Pemenang Kejuaraan/Prestasi di LPKIA </label>
                        <input type="text" name="prestasi" class="form-control" id="prestasi" max="60" placeholder="kosongkan bila tidak memiliki Penghargaan dan Pemenang Kejuaraan/Prestasi di LPKIA">
                        <div class="form-check" id="div_prestasi">  
                        </div>
                    </div>

                    <!-- pembimbing -->
                    <div class="form-group">
                        <label for="pembimbing">Nama Pembimbing Proyek Akhir </label>
                        <select class="form-control" name="pembimbing" id="pembimbing">
                            {{-- list pembimbing ge acan --}}
                            {{-- <?php
                                $nama_dosen = $atur -> get_nama_dosen(); 
                                while($nama_nama = $nama_dosen-> fetch_assoc()):?>
                            <option value="<?=$nama_nama['id_dosen']?>"><?=$nama_nama['nama_dosen']?></option>
                            <?php endwhile;?> --}}
                        </select>
                    </div>

                    <!-- proyek -->
                    <div class="form-group">
                        <label for="proyek">Judul Proyek Akhir  </label>
                        <input type="text" name="proyek" class="form-control" id="proyek" placeholder="Ketik Lengkap" required>
                    </div>
                    <button type="button" class="btn btn-primary" id="button_submit">Kirim</button>
                </form>

            </div>
        </div>

    @endsection
    @section('custom_js')
    <script>
        $(document).ready(function(){

            
            // fungsi custom jika buttton iya diklik maka tambahkan input file jika "tidak" diklik maka hapus input file jika ada
            function add_radio(count, button1, button2, nama_file){
                $(button1).click(function(){
                    if($(this).is(':checked') && count == 0){
                        $(`#div_file_${nama_file}`).append(`<div class="file_${nama_file}">
                                    <input type="file" class="custom-file-input" id="file_${nama_file}" name="file_${nama_file}" type="file" accept=".pdf" required>
                                    <label class="custom-file-label" for="customFile">Pilih File (tipe pdf, ukuran maksimal 3 MB)</label>
                                </div>`);
                        count = 1;
                    }
                    // Add the following code if you want the name of the file appear on select
                    $(".custom-file-input").on("change", function() {
                        var fileName = $(this).val().split("\\").pop();
                        $(this).siblings(".custom-file-label").addClass("selected").html(fileName);
                    });
                
                });
                $(button2).click(function(){
                    if($(this).is(':checked')){
                        $(`.file_${nama_file}`).remove();
                        count = 0;
                    }
                });
            }
            var nama_radio = ["mos", "oracle", "mtcna", "ccent", "ccna", "toeic", "moswa"];
            nama_radio.forEach(element => add_radio(0, `#${element}1`, `#${element}2`, element));

            // fungsi custom tambah button dng param counter, field input yang diklik, append (div dan nama file input)   
            function add_input(count, field){
                $(`#${field}`).on("keyup change", function(){
                    if($(`#${field}`).val()==""){
                        $(`.file_${field}`).remove();
                        count = 0;
                    }else if(count == 0){
                        $(`#div_${field}`).append(`<div class="file_${field}">
                                    <input type="file" class="custom-file-input" id="file_${field}" name="file_${field}" type="file" accept=".pdf" required>
                                    <label class="custom-file-label" for="customFile">Pilih File (tipe pdf, ukuran maksimal 3 MB)</label>
                                </div>`);
                        // Add the following code if you want the name of the file appear on select
                        $(".custom-file-input").on("change", function() {
                            var fileName = $(this).val().split("\\").pop();
                            // validasi ukuran file tidak jalan
                            // var ukuran = $(this)[0].files[0].size;
                            $(this).siblings(".custom-file-label").addClass("selected").html(fileName);
                            //     console.log(ukuran);
                            // if(ukuran > 3145728){
                            //     console.log(ukuran);
                            //     $(this).reset();
                            // }

                        });
                        count = 1;
                    }
                });
            }
            // tambahkan input kegiatan lain jika mengisi 1 keg lain
            function add_keg(number){
                $("#keg_lain").append(`<div class="form-group keg${number}">
                            <label for="keg${number}">Sertifikat / Kegiatan (${number})</label>
                            <input type="text" name="keg${number}" class="form-control" id="keg${number}" placeholder="opsional">
                            <div class="form-check" id="div_keg${number}">
                                
                            </div>
                        </div>`);
            }
                // tambah kegiatan baru + inputan file
                $("#keg1").on('keyup', function(){
                    if(!document.getElementById('keg2') && $(this).val()!=''){
                        add_keg(2);
                    }else if($(this).val()==''){
                        $('.keg2').remove();
                        $('.keg3').remove();
                    }
                });
                $(document).on('keyup', '#keg2', function(){
                    if(!document.getElementById('file_keg2') && $(this).val()!=''){
                        add_input(0, "keg2");
                    }else if($(this).val()==''){
                        $('#file_keg2').remove();
                    }
                    
                    if(!document.getElementById('keg3') && $(this).val()!=''){
                        add_keg(3);
                    }else if($(this).val()==''){
                        $('.keg3').remove();
                    }
                });
                $(document).on('keyup', '#keg3', function(){
                    if(!document.getElementById('file_keg3') && $(this).val()!=''){
                        add_input(0, "keg3");
                    }else if($(this).val()==''){
                        $('#file_keg3').remove();
                    }
                    
                });
                
            

            var inputan = ["other", "keg1", "organisasi", "prestasi"];
            inputan.forEach(element => add_input(0, element));
            
            

            $(document).on('click', '#button_submit', function(){
                let hitung = 0;
                $("#form_data input[type=file]").each(function() {
                    if($(this).val() != "") {
                        hitung++;
                    }
                });
                console.log(hitung);
                if(hitung > 2){
                    $('#form_data').submit();
                }else{
                    // alert dihandap bnerken
                    $("#alert_spot_data")[0].scrollIntoView();
                }
            });

        });
    </script>

    {{-- $("#alert_spot_data").append(`<?=$header -> get_alert(1, 'KUM kurang dari 2, syarat mengisi SKPI harus memiliki 2 sertifikat internasional dan total nilai KUM 12');?>`); --}}

    @endsection
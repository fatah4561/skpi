@extends('layouts.custom')
    @section('content')
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col"><h2>Pengumpulan SKPI</h2></div>
                    <div class="col-right">
                        <div class="d-flex justify-content-center px-2">
                        <button type="button" id="button_download" class="btn btn-primary btn-sm" data-id-download="{{'id_file'}}">Download Semua File</button>
                        </div>
                    </div>
                    <div class="col-right">
                        <div class="d-flex justify-content-center px-2 dropdown">
                        <button class="btn btn-primary btn-sm dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Report Excel
                        </button>
                        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                            <a type="button" id="button_report" class="dropdown-item"  data-id-report="{{'id_report'}}">Format Full</a>
                            <a type="button" id="button_report_s" class="dropdown-item"  data-id-report_s="{{'id_report'}}">Format 2</a>
                        </div>
                        </div>
                    </div>
                    <div class="col-right">
        
                        <div class="d-flex justify-content-center px-2">
        
                            <div class="search"> 
                                <input id="search" type="text" class="search-input" placeholder="Cari..." name=""> 
                                <a href="#" class="search-icon"> <i class="fa fa-search"></i> </a> 
                            </div>
                        </div>
                    </div>
                    
                </div>
                <hr class="border">
                <div class="freeze-table table-responsive tableFixHead">
                    <table class="table table-striped table-hover table-fit" style="">
                        <thead class="table bg-primary text-light" style="">
                            <tr>
                            <th scope="col">Nama&nbsp;Lengkap</th>
                            <th scope="col">NRP</th>
                            <th scope="col" class="fit">Kelas</th>
                            <th scope="col">MOS&nbsp;/&nbsp;MTA</th>
                            <th scope="col">Oracle</th>
                            <th scope="col">MTCNA</th>
                            <th scope="col">Cisco&nbsp;CCENT</th>
                            <th scope="col">Cisco&nbsp;CCNA</th>
                            <th scope="col">TOEIC</th>
                            <th scope="col">Moswa</th>
                            <th scope="col">Sertifikat&nbsp;Internasional&nbsp;Lain</th>
                            <th scope="col">Sertifikat&nbsp;/&nbsp;Kegiatan&nbsp;1</th>
                            <th scope="col">Sertifikat&nbsp;/&nbsp;Kegiatan&nbsp;2</th>
                            <th scope="col">Sertifikat&nbsp;/&nbsp;Kegiatan&nbsp;3</th>
                            <th scope="col">Pengalaman&nbsp;Organisasi</th>
                            <th scope="col">Penghargaan</th>
                            <th scope="col">Pembimbing&nbsp;Proyek&nbsp;Akhir</th>
                            <th scope="col">Judul&nbsp;Proyek&nbsp;Akhir</th>
                            <!-- <th scope="col" class="text-center">Verifikasi</th> -->
                            <!-- <th scope="col" class="text-center">Minta&nbsp;Kirim&nbsp;Ulang</th> -->
                            </tr>
                        </thead>
                        <tbody id="table-skpi" >
                            <div>
                            {{-- <?php
                                $array = $skpi -> get_data_isi($_GET['id']);
                                $i = 1;
                                
                                while($skpi_array = $array -> fetch_assoc()):
                                    // simpan gambar hidden
                                    $array_db = array('mosmta', 'oracle', 'mtcna', 'ccent', 'ccna', 'toeic', 'moswa', 'other', 'keg1', 'keg2', 'keg3', 'organisasi', 'prestasi');
                                    $foto = $skpi -> get_foto($skpi_array['nrp']) -> fetch_assoc();
                                    for($x = 0; $x <13; $x++){
                                        if($foto != null){
                                        $sumber = $foto["file_$array_db[$x]"];
                                        if($sumber == "Kosong"){
                                            $sumber = "";
                                        }else{
                                            echo "<embed src='{$sumber}' alt='' style='display: none;' id='gambar_{$array_db[$x]}_{$skpi_array['nrp']}'>";
                                        }
                                        }
                                    }
                                    
                                    
                            ?> --}}
                                </div>
                            @forEach($skpi_datas as $data)
                                    <tr id="rrow{{$loop->index}}">
                                    <th class="beda">{{$data->name}}</th>
                                    <td>{{$data->nrp}}</td>
                                    <td class="text-nowrap">{{$data->class}}</td>
                                    {{-- {{dd($data->nrp);}} --}}
                                    <td><center>@icon([$data->mosmta, 'mosmta', $data->nrp])</center></td>
                                    <td><center>@icon([$data->oracle, 'oracle', $data->nrp])</center></td>
                                    <td><center>@icon([$data->mtcna, 'mtcna', $data->nrp])</center></td>
                                    <td><center>@icon([$data->ccent, 'ccent', $data->nrp])</center></td>
                                    <td><center>@icon([$data->ccna, 'ccna', $data->nrp])</center></td>
                                    <td><center>@icon([$data->toeic, 'toeic', $data->nrp])</center></td>
                                    {{-- <td><center>{{@icon([$data->moswa, 'moswa', $data->nrp])}}</center></td> --}}
                                    {{-- <td class="text-nowrap">{{$skpi -> get_href($data->sertLain, 'other', $data->nrp)}}</td>
                                    <td class="text-nowrap">{{$skpi -> get_href($data->keg1, 'keg1', $data->nrp)}}</td>
                                    <td class="text-nowrap">{{$skpi -> get_href($data->keg2, 'keg2', $data->nrp)}}</td>
                                    <td class="text-nowrap">{{$skpi -> get_href($data->keg3, 'keg3', $data->nrp)}}</td>
                                    <td class="text-nowrap">{{$skpi -> get_href($data->pengOrganisasi, 'organisasi', $data->nrp)}}</td>
                                    <td class="text-nowrap">{{$skpi -> get_href($data->penghargaan, 'prestasi', $data->nrp)}}</td> --}}
                                    <td class="text-nowrap">{{$data->lecturer_name}}</td>
                                    <td class="text-nowrap">{{$data->thesis_title}}</td>
                                </tr>
                            {{-- <?php $i++; endwhile;?> --}}
                            @endforeach
                            
                        </tbody>
                        <script src="vendor/jquery/jquery.min.js"></script>
                    </table>
                </div>
            </div>
        </div>
        
        <!-- Modal -->
        <div class="modal fade bd-example-modal-lg" id="modal-gambar" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                <h5 class="modal-title" id="judul"></h5>
                <button type="button" class="close close_button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                </div>
                <div class="modal-body" id="div_pdf">
                </div>
                <div class="modal-footer">
                <button type="button" class="btn btn-secondary close_button" data-dismiss="modal">Tutup</button>
                </div>
            </div>
            </div>
        </div>
        <script>
            $(document).ready(function(){
        
            // verifikasi ajax
            $(document).on('click','#verifikasi', function(){
                var nrp = $(this).attr('data-nrp');
                var row = $(this).attr('data-id-row');
                $.ajax({
                            method:"POST",
                            url:"class/prosesSKPI.php",
                            data: {nrp: nrp},
                            success:function(data)
                            {
                                $(`#${row}`).html(data);
                            }
                        });
            });
            // search ajax
            $('#search').keyup(function(){
                let search = $('#search').val();
                $.ajax({
                            method:"POST",
                            url:"class/prosesSKPI.php",
                            data: {search: search},
                            success:function(data)
                            {
                                $(`#table-skpi`).html(data);
                            }
                        });
                    });
            
            // klik report
            $(document).on('click','#button_report', function(){
                var report = $(this).attr('data-id-report');
                console.log(report);
                var link = `class/excel.php?report=${report}`
                $(`<a href="${link}" target="_blank">External Link</a>`)[0].click();;
            });
            // report tipe 2
            $(document).on('click','#button_report_s', function(){
                var report = $(this).attr('data-id-report_s');
                console.log(report);
                var link = `class/excel.php?report=${report}&tipe2`
                $(`<a href="${link}" target="_blank">External Link</a>`)[0].click();;
            });
        
            // klik download
            $(document).on('click','#button_download', function(){
                var id = $(this).attr('data-id-download');
                console.log(id);
                var link = `class/zip.php?id=${id}`
                $(`<a href="${link}" target="_blank">External Link</a>`)[0].click();;
        
            });
        
            // hapus ajax
            $(document).on('click','#kirim_ulang', function(){
                var nrp = $(this).attr('data-nrp');
                var row = $(this).attr('data-id-rrow');
                var kirim = 1;
                $.ajax({
                            method:"POST",
                            url:"class/prosesSKPI.php",
                            data: {kirim: kirim, NRP: nrp},
                            success:function(data)
                            {
                                $(`#${row}`).html(data);
                            }
                        });
            });
            // klik icon / href tampil pdf
            var nama_icon = ["mosmta", "oracle", "mtcna", "ccent", "ccna", "toeic", "moswa", "other", "keg1", "keg2", "keg3", "organisasi", "prestasi"];
        
            function klik_pdf(nama_icon){
                $(document).on('click',`.icon_${nama_icon}`, function(){
                var nrp = $(this).attr('data-nrp');
                $(`#pdf_hasil`).remove();
                $(`#div_pdf`).append(`<embed class="embed-responsive" id="pdf_hasil" src="" type="application/pdf" style="height: 35vw!important;">`);
                document.getElementById("pdf_hasil").src = document.getElementById(`gambar_${nama_icon}_${nrp}`).src;
                if(nama_icon == "mosmta"){
                    judul.innerText = "MOS / MTA";
                }else if(nama_icon == "oracle"){
                    judul.innerText = "Oracle";
                }else if(nama_icon == "mtcna"){
                    judul.innerText = "MTCNA";
                }else if(nama_icon == "ccent"){
                    judul.innerText = "CCENT";
                }else if(nama_icon == "ccna"){
                    judul.innerText = "CCNA";
                }else if(nama_icon == "ccna"){
                    judul.innerText = "CCNA";
                }else if(nama_icon == "toeic"){
                    judul.innerText = "TOEIC";
                }else if(nama_icon == "moswa"){
                    judul.innerText = "MOSWA";
                }else if(nama_icon == "other"){
                    judul.innerText = "Sertifikat Internasional Lain";
                }else if(nama_icon == "keg1"){
                    judul.innerText = "Sertifikat / Kegiatan 1";
                }else if(nama_icon == "keg2"){
                    judul.innerText = "Sertifikat / Kegiatan 2";
                }else if(nama_icon == "keg3"){
                    judul.innerText = "Sertifikat / Kegiatan 3";
                }
                });
            }
            nama_icon.forEach(element => klik_pdf(element));
            // klik close button modal
            $(document).on('click','.close_button', function(){
                document.getElementById("pdf_hasil").src = "";
            });
            });
        </script>
    @endsection
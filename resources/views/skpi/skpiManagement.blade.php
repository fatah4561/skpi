@extends('layouts.custom')
    @section('content')
    {{-- <?php
    $skpi = new prosesSKPI;
        if(isset($_GET['id_hapus'])){
            $skpi -> hapus_pengumpulan($_GET['id_hapus']);
            echo "<script>
            alert('Data dihapus');
            window.location.replace('index.php?page=skpi');
            </script>";
        }
    ?> --}}
    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col"><h2>Pengumpulan SKPI</h2></div>
                <div class="col-right text-right px-2"><a class="btn btn-primary btn-sm" id="tambah" href="" role="button" data-toggle="modal" data-target="#tambah_pengumpulan">Tambah</a></div>
                <div class="col-right">
                  <div class="d-flex justify-content-center px-2">
                    <button type="button" id="button_belum" class="btn btn-primary btn-sm" >Report Mahasiswa Belum Mengumpulkan</button>
                  </div>
                </div>
                <div class="col-right">
                    <div class="d-flex justify-content-center px-2">
                        <div class="search"> <input id="search_skpi" type="text" class="search-input" placeholder="Cari..." name=""> <a href="#" class="search-icon"> <i class="fa fa-search"></i> </a> </div>
                    </div>
                </div>
                
            </div>
            <hr class="border">
            <div class="table-responsive">
                <table class="table table-striped table-hover">
                    <thead class="bg-primary text-light">
                        <tr>
                        <th scope="col">#</th>
                        <th scope="col">Tanggal Mulai</th>
                        <th scope="col">Deadline</th>
                        <th scope="col">Sisa&nbsp;Waktu</th>
                        <th scope="col">Kategori&nbsp;Mahasiswa</th>
                        <th scope="col">Tahun&nbsp;Ajaran</th>
                        <th scope="col">Keterangan</th>
                        <th scope="col" class="text-center">Opsi</th>
                        </tr>
                    </thead>
                    <tbody id="isi_tabel_skpi">
                        {{-- <?php
                            $array = $skpi -> get_data_semua();
                            $i = 1;
                            while($skpi_array = $array -> fetch_assoc()):
                        ?>
                        <tr>
                        <th scope="row"><?=$i++?></th>
                        <td><?=$skpi_array['tanggal_mulai']?></td>
                        <td><?=$skpi_array['tanggal_akhir']?></td>
                        <?php
                            date_default_timezone_set('Asia/Jakarta');
                            $d1 = new datetime("now");
                            $d2 = new datetime($skpi_array['tanggal_akhir']);
                            $diff = $d1 -> diff($d2);
                            $array_ajar = explode("-", $skpi_array['tahun_ajaran']);
                        ?>
                        <td><?php if($d1 > $d2){echo 'Overdue';}else{echo $diff ->format('%d Hari %h Jam');}?></td>
                        <td><?=$skpi_array['jenis_pengumpul']?></td>
                        <td><?=$skpi_array['tahun_ajaran']?></td>
                        <td><?=$skpi_array['keterangan']?></td>
                        <td class="text-center">
                            <a class="btn btn-outline-primary" href="index.php?page=isi&id=<?=$skpi_array['id_pengumpulan']?>" role="button"><i class="fa fa-eye" aria-hidden="true"></i></a>
                            <a class="btn btn-outline-primary" href="" id="edit" data-toggle="modal" data-target="#tambah_pengumpulan" 
                                data-tahunA="<?=$array_ajar[0]?>" data-tahunB="<?=$array_ajar[1]?>"
                                data-tanggalM="<?=date('Y-m-d\TH:i', strtotime($skpi_array['tanggal_mulai']))?>" data-tanggalA="<?=date('Y-m-d\TH:i', strtotime($skpi_array['tanggal_akhir']))?>" 
                                data-jenis="<?=$skpi_array['jenis_pengumpul']?>" data-ket="<?=$skpi_array['keterangan']?>" data-id-pengumpulan="<?=$skpi_array['id_pengumpulan']?>" role="button"><i class="fa fa-pencil" aria-hidden="true"></i></a>
                            <?php
                            if( $skpi -> get_data_isi($skpi_array['id_pengumpulan'])->num_rows == 0):  ?>
                                <a class="btn btn-outline-primary" href="?page=skpi&id_hapus=<?=$skpi_array['id_pengumpulan']?>" onclick="return confirm('Apakah anda yakin ? (menghapus pengumpulan akan menghapus data yang terkait seperti file file yang diupload untuk pengumpulan ini)')" role="button"><i class="fa fa-trash" aria-hidden="true"></i></a>
                            <?php endif; ?>
                        </td>
                        </tr>
                        <?php endwhile;?> --}}
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <script src="vendor/jquery/jquery.min.js"></script>
    <script>
        $(document).ready(function(){
            // fungsi update
            $(document).on('click', '#edit', function(){
                var tanggal_mulai = $(this).attr('data-tanggalM');
                var tanggal_akhir = $(this).attr('data-tanggalA');
                var jenis = $(this).attr('data-jenis');
                var keterangan = $(this).attr('data-ket');
                var id = $(this).attr('data-id-pengumpulan');
                var tahunA = $(this).attr('data-tahunA');
                var tahunB = $(this).attr('data-tahunB');
                $('#tombol').val(1);
                $('#button_tambah_pengumpulan').html('Ubah');
                $('#tahunA').val(tahunA);
                $('#tahunB').val(tahunB);
                $('#tanggalM').attr('min', tanggal_mulai);
                $('#tanggalA').attr('min', tanggal_akhir);
                $('#tanggalM').val(tanggal_mulai);
                $('#tanggalA').val(tanggal_akhir);
                $(`#jenis`).val(jenis);
                $('#ket').val(keterangan);
                $('#id_pengumpulan').val(id);
            });
            // fungsi tambah (reset isi)
            $(document).on('click', '#tambah', function(){
                $('#tombol').val(0);
                $('#button_tambah_pengumpulan').html('Tambahkan');
                $('#tahunA').val('');
                $('#tahunB').val('');
                $('#tanggalM').val('');
                $('#tanggalA').val('');
                $(`#jenis`).val('');
                $('#ket').val('');
            });
            // search ajax
            $('#search_skpi').keyup(function(){
                let search_skpi = $('#search_skpi').val();
                $.ajax({
                    method:"POST",
                    url:"class/prosesSKPI.php",
                    data: {search_skpi: search_skpi},
                    success:function(data)
                    {
                        $(`#isi_tabel_skpi`).html(data);
                    }
                });
            });
            // klik belum
            $(document).on('click','#button_belum', function(){
            // var report = $(this).attr('data-id-report');
            // console.log(report);
            var link = `class/excel.php?belum=1`
            $(`<a href="${link}" target="_blank">External Link</a>`)[0].click();;
    
            });
        });
    </script>
    
    <!-- modal -->
    <div class="modal fade bd-example-modal-lg" id="tambah_pengumpulan" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-lg">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Tambah Pengumpulan</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <form method="post" action="" name="form_tambah" id="form_tambah" enctype="multipart/form-data">
                    <input type="hidden" id="id_pengumpulan" name="id_pengumpulan" value="">
                    <input type="hidden" value="0" name="tombol" id="tombol">
                    <div class="row">
                        <?php
                            $tanggalMin = date("Y-m-d h:i:s");
                        ?>
                        <div class="col">
                            <label for="tanggalM">Tanggal Mulai</label>
                            <input id="tanggalM" type="datetime-local" min="<?=date("Y-m-d")."T".date("h:i");?>" class="form-control" name="tanggalM" required>
                        </div>
                        <div class="col">
                            <label for="tanggalA">Tanggal Terakhir Pengumpulan</label>
                            <input id="tanggalA" type="datetime-local" min="<?=date("Y-m-d")."T".date("h:i");?>" class="form-control" name="tanggalA" required>
                        </div>
                    </div>
                    </br>
                    <div class="row">
                        <label class="col" for="tahunAjaran">Tahun Ajaran</label>
                    </div>
                    <div class="row">
                        <div class="col">
                            <input type="number" class="form-control" name="tahunA" id="tahunA" min="2018" max="2050" required>
                        </div>
                        <div class="col">
                            <input type="number" class="form-control" name="tahunB" id="tahunB" readonly>
                        </div>
                    </div>
                    </br>
                    <div class="row">
                    
                        <div class="col">
                        <label for="kategori">Kategori Mahasiswa</label></br>
                            <div class="input-group mb-3">
                                
                                <div class="input-group-prepend">
                                    <label class="input-group-text" for="kategori">Pilih</label>
                                </div>
                                <select class="custom-select" id="jenis" name="kategori" required>
                                    <option value="Semua Mahasiswa">Semua Mahasiswa</option>
                                    <option value="Mahasiswa Jurusan SI">Mahasiswa Jurusan SI</option>
                                    <option value="Mahasiswa Jurusan IF">Mahasiswa Jurusan IF</option>
                                    <option value="Mahasiswa Jurusan MI">Mahasiswa Jurusan MI</option>
                                    <option value="Mahasiswa Tingkat 4 Saja">Mahasiswa Tingkat 4 Saja</option>
                                    <option value="Mahasiswa Tingkat 3 Saja">Mahasiswa Tingkat 3 Saja</option>
                                    <option value="Beberapa Mahasiswa">Beberapa Mahasiswa</option>
                                </select>
                                
                            </div>
                            
                        </div>
                    </div>
                    <div class="wrapper" id="tambah_div"  style="visibility: hidden;">
                        <!-- input dinamis -->
                    </div>
                    <div class="row">
                        <div class="col">
                            <label for="ket">Keterangan</label>
                            <textarea name="ket" class="form-control" id="ket" cols="10" rows="4"></textarea>
                            <!-- <input id="ket" type="text" class="form-control" name="ket"> -->
                        </div>
                    </div>
                </form>
          </div>
          <div class="modal-footer">
              <?php $button = "Tambahkan";?> 
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button id="button_tambah_pengumpulan" type="button" class="btn btn-primary"></button>
          </div>
        </div>
      </div>
      <script type="text/javascript">
        $(document).ready(function(){
            var maxField = 10; //Input fields increment limitation
            var addButton = $('#tambah_button'); //Add button selector
            var wrapper = $('.wrapper'); //Input field wrapper
            var x = 0; //Initial field counter is 1
            var fieldHTML = `<main id="main_tambah" class="input-group mb-3 main_tambah"><input required min="1000000" max="999999999" type="number" id="beberapa" name="beberapa[]" class="form-control" aria-label="Amount (to the nearest dollar)" placeholder="Masukkan NRP contoh: 190613015"><div class="input-group-append" style="background: white; !important; border-color: #d1d3e2; !important"><span class="input-group-text" style="background: white; !important;  border-color: #d1d3e2; !important"><a href="javascript:void(0);" class="remove_button"><i class="fas fa-trash-alt" style="color: red;"></i></a></span></div></main>`; //New input field html 
            var tahunA;
    
            // jika kategori mahasiswa diubah maka
            $('#jenis').change(function(){
                if( $(this).val() == 'Beberapa Mahasiswa' ){
                    $("#tambah_div").css("visibility","visible");
                    $('.wrapper').append('<div class="row"><div id="tambah_button_div" class="col" ><a href="#" id="tambah_button"><i class="fas fa-plus fa-lg"></i>Tambah Mahasiswa &nbsp;</a></div></div>');
                }else{
                    $("#tambah_div").css("visibility","hidden");
                    $("#beberapa").val("");
                    $(".main_tambah").remove();
                    $("#tambah_button_div").remove();
                    x = 0;
    
                }
            });
            
            //Once add button is clicked
            $(document).on('click', '#tambah_button', function(){
                //Check maximum number of input fields
                if(x < maxField){ 
                    x++; //Increment field counter
                    $(wrapper).append(fieldHTML); //Add field html
                }
            });
            
            //Once remove button is clicked
            $(wrapper).on('click', '.remove_button', function(e){
                e.preventDefault();
                $(this).parents('main').remove(); //Remove field html
                x--; //Decrement field counter
            });
            // tahun akhir otomatis
            $("#tahunA").keyup(function(){
                tahunA = parseInt($("#tahunA").val())+1;
                // console.log(typeof tahunA);
                $("#tahunB").val(tahunA);
            });
    
    
            // button submit form, validasi required
            $(document).on('click', '#button_tambah_pengumpulan', function(){	
                  for (const el of document.getElementById('form_tambah').querySelectorAll("[required]")) {
                    if (!el.reportValidity()) {
                      return;
                    }
                  }$('#form_tambah').submit();
            });
        });
      </script>
    </div>
    <?php
        if(isset($_POST['tanggalM']) && isset($_POST['tanggalA'])){
            $tanggalM = date("Y-m-d H:i:s",strtotime($_POST['tanggalM']));
            $tanggalA = date("Y-m-d H:i:s",strtotime($_POST['tanggalA']));
            $tahunAjaran = $_POST['tahunA']."-".$_POST['tahunB'];
            // echo $tahunAjaran;
            if($_POST['tombol']==0){
                $skpi -> tambah_pengumpulan($tanggalM, $tanggalA, $_POST['kategori'], $tahunAjaran, $_POST['ket']);
                if($_POST['kategori'] == "Beberapa Mahasiswa"){
                    $skpi -> tambah_beberapa($_POST['beberapa'], $tanggalM, $tanggalA, $_POST['kategori']);
                }
                echo "<script>
                alert('Data ditambahkan');
                window.location.replace('index.php?page=skpi');
                </script>";
    
            }elseif($_POST['tombol']==1){
                // echo $_POST['id_pengumpulan'];
                $skpi -> update_pengumpulan($tanggalM, $tanggalA, $_POST['kategori'], $tahunAjaran, $_POST['ket'], $_POST['id_pengumpulan']);
                echo "<script>
                alert('Data diupdate');
                window.location.replace('index.php?page=skpi');
                </script>";
            }
        }
    ?>
    @endsection
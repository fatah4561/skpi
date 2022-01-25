@extends('layouts.custom')
    @section('content')
    <style>
        /* style kartu */
        .containerCard {
        margin-top: 30px
    }
    
    .counter-box {
        display: block;
        background: #f6f6f6;
        padding: 40px 20px 37px;
        text-align: center
    }
    
    .counter-box p {
        margin: 5px 0 0;
        padding: 0;
        color: #909090;
        font-size: 18px;
        font-weight: 500
    }
    
    .counter-box i {
        font-size: 60px;
        margin: 0 0 15px;
        color: #d2d2d2
    }
    
    .counter {
        display: block;
        font-size: 32px;
        font-weight: 700;
        color: #666;
        line-height: 28px
    }
    
    .counter-box.colored {
        background: #DA4450;
    }
    
    .counter-box.colored p,
    .counter-box.colored i,
    .counter-box.colored .counter {
        color: #fff
    }
    </style>
    <div class="containerCard">
    <h5>Statistik</h5>
        <div class="row">
            <div class="four col-md-3">
                <div class="counter-box colored"> 
                    <i class="fa fa-files-o"></i> 
                    <span class="counter">{{ $total_skpi_data }}</span>
                    <p>SKPI Dikumpulkan</p>
                </div>
            </div>
            <div class="four col-md-3">
                <div class="counter-box colored" style="background: #FFCE0A;"> 
                    <i class="fas fa-file-alt"></i> 
                    <span class="counter">{{ $total_collection }}</span>
                    <p>Pengumpulan SKPI</p>
                </div>
            </div>
            <div class="four col-md-3">
                <div class="counter-box colored" style="background: #3ACF87;"> 
                    <i class="fa fa-user-times"></i> 
                    <span class="counter">{{ $total_unfilled }}</span>
                    <p>Belum Mengumpulkan</p>
                </div>
            </div>
            <div class="four col-md-3">
                <div class="counter-box colored" style="background: #2A2A72;"> 
                    <i class="fa fa-group"></i> 
                    <span class="counter">{{ $total_student }}</span>
                    <p>Jumlah Mahasiswa</p>
                </div>
            </div>
        </div>
    </div>
    
    <!-- aktifitas terbaru -->
    <div class="container mt-5">
        <div class="row">
            <div class="col">
                <div class="headings d-flex justify-content-between align-items-center mb-3">
                    <h5>Pengumpulan Terkini</h5>
                    <div class="buttons"> <span class="badge bg-white d-flex flex-row align-items-center"> </span> </div>
                </div>
                {{-- <?php
                    $hasil = $skpi -> get_data_pengumpulan();
                    while($isi_mahasiswa = $hasil -> fetch_assoc()):
                        date_default_timezone_set('Asia/Jakarta');
                        $d1 = new datetime("now");
                        $d2 = new datetime($isi_mahasiswa['tanggal_dikumpulkan']);
                        $diff = $d2 -> diff($d1);
                ?>
                <?php endwhile;?> --}}
    
            </div>
        </div>
    </div>
    <script src="vendor/jquery/jquery.min.js"></script>
    <script>
    $(document).ready(function() {
        $('.counter').each(function () {
        $(this).prop('Counter',0).animate({
        Counter: $(this).text()
        }, {
        duration: 4000,
        easing: 'swing',
        step: function (now) {
        $(this).text(Math.ceil(now));
        }
        });
        });
    
    });
    </script>

    @endsection
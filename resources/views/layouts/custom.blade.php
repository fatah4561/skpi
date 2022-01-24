<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="F">
  <meta name="author" content="F">
  <link href="{{asset('img/logo/SKPI-logos_white.png')}}" rel="icon">
  <title>SKPI - Dashboard</title>
  <script src="https://kit.fontawesome.com/de3ee75fd3.js" crossorigin="anonymous"></script>
  <link href="{{asset('/bootstrap/css/bootstrap.min.css')}}" rel="stylesheet" type="text/css">
  <link href="{{asset('css/custom.css')}}" rel="stylesheet" type="text/css">
  <link href="{{asset('css/ruang-admin.min.css')}}" rel="stylesheet">
</head>

<body id="page-top">
  <div id="wrapper">
    <!-- Sidebar -->
    @if ($type == 1)
        @include('layouts.navigations.b')
    @elseif ($type == 0)
        @include('layouts.navigations.a')
    @endif

    {{-- native - hapus --}}
    {{-- <?php
      echo $tampil_sidebar = $header -> get_sidebar($jenis);
    ?> --}}
    
    <div id="content-wrapper" class="d-flex flex-column">
      <div id="content">
        <!-- TopBar -->
        <nav class="navbar navbar-expand navbar-light bg-navbar topbar mb-4 static-top">
          <button id="sidebarToggleTop" class="btn btn-link rounded-circle mr-3">
            <i class="fa fa-bars"></i>
          </button>
          <ul class="navbar-nav ml-auto">

            <div class="topbar-divider d-none d-sm-block"></div>
            <!-- profile  -->
            <li class="nav-item dropdown no-arrow">
              <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown"
                aria-haspopup="true" aria-expanded="false">
                <img class="img-profile rounded-circle" src="{{'link_gambar'}}" style="max-width: 60px">
                <span class="ml-2 d-none d-lg-inline text-white small">nama</span>
              </a>
              <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
                <!-- profile -->
                {{-- @if (session::get('type') == 'biasa')
                    @include('layouts.navigations.b')
                @elseif (session::get('type') == 'admin')
                    @include('layouts.navigations.a')
                @endif --}}
                {{-- <?php
                  if($jenis != 'admin'){
                    $header -> get_profile_link();
                  }
                ?> --}}
                <!-- Setting -->
                <!-- <a class="dropdown-item" href="#">
                  <i class="fas fa-cogs fa-sm fa-fw mr-2 text-gray-400"></i>
                  Settings
                </a> -->
                
                <a class="dropdown-item" href="javascript:void(0);" data-toggle="modal" data-target="#logoutModal">
                  <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                  Logout
                </a>

              </div>
            </li>

          </ul>
        </nav>
        <!-- Topbar -->
        <!-- Container Fluid-->

        <div class="container-fluid" id="container-wrapper">
        <div id="slot_alert">
        </div>
        {{-- content --}}
        @yield('content')
        
        {{-- native - hapus --}}
          {{-- <?php if(isset($_GET['page'])) : ?>
              <?php
                  $alert_tidak = $header -> get_alert(1, 'Tidak ada pengisian tersedia');
                  $alert_belum = $header -> get_alert(1, 'Anda belum lulus sidang, jika ternyata sudah informasikan ke prodi untuk pembaharuan');
                  if($_GET['page'] == 'profile' && $jenis != 'admin'){
                      include "pages/profile.php";
                  }elseif($_GET['page'] == 'data' && $jenis != 'admin'){
                      if($isi == 0){
                        include "pages/dashboard.php";
                        echo `
                        <input type="text" value="{$isi}" hidden>
                        <script>
                        $('#slot_alert').append('{$alert_tidak}');
                        </script>`;
                      }elseif($isi == 1){
                        include "pages/dashboard.php";
                        echo `<script>
                        <input type="text" value="{$isi}" hidden> 
                        $('#slot_alert').append('{$alert_belum}');
                        </script>`;
                      }else{
                        include "pages/data.php";
                      }
                      
                  }elseif($_GET['page']== 'skpi' && $jenis == 'admin'){
                    include "pages/skpi.php";
                  }elseif($_GET['page']== 'isi' && $jenis == 'admin'){
                    include "pages/skpi_isi.php";
                  }elseif($_GET['page']== 'mahasiswa' && $jenis == 'admin'){
                    include "pages/mahasiswa.php";
                  }
              ?>
          <?php else:
              if($jenis == 'admin'){
                include "pages/dashboard_a.php";
              }elseif($jenis != 'admin'){
                include "pages/dashboard.php";
              }
              
          ?>
          <?php endif; ?> --}}

          <!-- <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
            <ol class="breadcrumb">
              <li class="breadcrumb-item"><a href="./">Home</a></li>
              <li class="breadcrumb-item active" aria-current="page">Dashboard</li>
            </ol>
          </div> -->

        </div>
        <!---Container Fluid-->
      </div>
            </br>
      <!-- Footer -->
      <footer class="sticky-footer bg-white">
        <div class="container my-auto">
          <div class="copyright text-center my-auto">
             <span>copyright &copy; <script> document.write(new Date().getFullYear()); </script> 
            </span>
          </div>
        </div>
      </footer>
      <!-- Footer -->
    </div>
  </div>

  
  <!-- Scroll to top -->
  <a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
  </a>

  <!-- Modal Logout -->
    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabelLogout" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabelLogout">Logout</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p>Apakah anda yakin ?</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-primary" data-dismiss="modal">Cancel</button>
                    {{-- logout form, post method --}}
                    <form method="POST" action="{{ route('logout') }}">
                      @csrf
                      <button type="submit" onclick="signOut();" class="btn btn-primary">Logout</button>
                    </form>
                    {{-- revisi script dibawah sigana ges teu dipake --}}
                    <script>
                        function signOut() {
                        var auth2 = gapi.auth2.getAuthInstance();
                        auth2.signOut().then(function () {
                            console.log('User signed out.');
                        });
                        }
                    </script>
                </div>
            </div>
        </div>
    </div>
    
</body>

</html>

<script src="{{asset('js/jquery/jquery.min.js')}}"></script>
<script src="{{asset('bootstrap/js/bootstrap.bundle.min.js')}}"></script>
<script src="{{asset('js/jquery-easing/jquery.easing.min.js')}}"></script>
<script src="{{asset('js/ruang-admin.min.js')}}"></script>

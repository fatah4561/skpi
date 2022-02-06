<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="F">
  <meta name="author" content="F">
  <meta name="csrf-token" content="{{ csrf_token() }}">
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
    @if (session('user_type') == 1)
        @include('layouts.navigations.b')
    @elseif (session('user_type') == 0)
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
                <img class="img-profile rounded-circle" src="{{(session('user_pic') == 'admin')? asset('img/profil.jpg'): session('user_pic')}}" style="max-width: 60px">
                <span class="ml-2 d-none d-lg-inline text-white small">{{ session('user_name') }}</span>
              </a>
              <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
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
@yield('custom_js')

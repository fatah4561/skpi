<!-- Sidebar 1 -->
<ul class="navbar-nav sidebar sidebar-light accordion" id="accordionSidebar">
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="{{route('index')}}">
        <div class="sidebar-brand-icon">
        </div>
        <div class="sidebar-brand-text mx-3"><div class="" style="background: white; color: blue; font-family:fantasy;">S</div>SKPI</div>
    </a>
    <hr class="sidebar-divider my-0">

    <li class="nav-item {{($menu=='dashboard')?'active':''}}">
        <a class="nav-link" href="{{route('index')}}">
        <i class="fas fa-fw fa-tachometer-alt"></i>
        <span>Dashboard</span></a>
    </li>
    <hr class="sidebar-divider">
    <div class="sidebar-heading">
        Navigasi
    </div>
    
    <li class="nav-item {{($menu=='student')?'active':''}}">
        <a class="nav-link" href="{{route('student.index')}}">
        <i class="fas fa-fw fa-users"></i>
        <span>Data Mahasiswa</span>
        </a>
    </li>

    <li class="nav-item {{($menu=='lecturer')?'active':''}}">
        <a class="nav-link" href="{{route('lecturer.index')}}">
        <i class="fas fa-fw fa-user-graduate"></i>
        <span>Data Pembimbing</span>
        </a>
    </li>

    <li class="nav-item {{($menu=='skpi')?'active':''}}">
        <a class="nav-link" href="{{route('skpi')}}">
        <i class="fas fa-fw fa-copy"></i>
        <span>Kelola Data SKPI</span>
        </a>
    </li>

    <li class="nav-item {{($menu=='config')?'active':''}}">
        {{-- <a class="nav-link" href="{{'config route soon'}}"> --}}
        <a class="nav-link" data-toggle="collapse" href="#collapse_menu">
        <i class="fas fa-fw fa-cogs"></i>
        <span>Konfigurasi</span>
        </a>
        <div id="collapse_menu" class="collapse" aria-labelledby="headingTable" data-parent="#accordionSidebar" style="">
            <div class="py-2 bg-white collapse-inner rounded {{'show_engke'}}" id="">
                <h6 class="collapse-header">Konfigurasi</h6>
                <ul class="navbar-nav accordion">
                    <li class="collapse-item {{($menu=='kum')?'active':''}}">
                        <a class="collapse-item" href="{{('config route soon')}}">
                            <i class="fas fa-thumbtack"></i>
                            <span>Nilai Kum</span>
                        </a>
                    </li>

                    <li class="collapse-item {{($menu=='sertifikat')?'active':''}}">
                        <a class="collapse-item" href="{{('config route soon')}}">
                            <i class="fab fa-wpforms"></i>
                            <span>Form Sertifikat</span>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </li>
    <hr class="sidebar-divider">
    <div class="version" id="version-ruangadmin"></div>
</ul>
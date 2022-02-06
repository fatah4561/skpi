<!-- sidebar 2 -->
<ul class="navbar-nav sidebar sidebar-light accordion" id="accordionSidebar">
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.php">
        <div class="sidebar-brand-icon">
        <!-- <img src="img\logo\SKPI-logos_white.png" style="width:500px;height:600px;"> -->
        </div>
        <div class="sidebar-brand-text mx-3"><div class="" style="background: white; color: blue; font-family:fantasy;">S</div>SKPI</div>
    </a>
    <hr class="sidebar-divider my-0">

    <li class="nav-item {{($menu=='dashboard')?'active':''}}">
        <a class="nav-link" href="{{route('dashboard')}}">
        <i class="fas fa-fw fa-tachometer-alt"></i>
        <span>Dashboard</span></a>
    </li>
    <hr class="sidebar-divider">
    <div class="sidebar-heading">
        Navigasi
    </div>
    
    <li class="nav-item {{($menu=='profile')?'active':''}}">
        <a class="nav-link" href="{{route('profile')}}">
        <i class="fas fa-fw fa-id-card"></i>
        <span>Data Pribadi</span>
        </a>
    </li>

    <li class="nav-item {{($menu=='form')?'active':''}}">
        <a class="nav-link" href="{{route('fill_form')}}">
        <i class="fas fa-fw fa-certificate"></i>
        <span>Isi Data SKPI</span>
        </a>
    </li>
    

    <hr class="sidebar-divider">
    <div class="version" id="version-ruangadmin"></div>
</ul>
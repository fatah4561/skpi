<!-- Sidebar 1 -->
<ul class="navbar-nav sidebar sidebar-light accordion" id="accordionSidebar">
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.php">
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
        <a class="nav-link" href="{{route('student.index')}}">
        <i class="fas fa-fw fa-certificate"></i>
        <span>Kelola Data SKPI</span>
        </a>
    </li>

    

    <hr class="sidebar-divider">
    <div class="version" id="version-ruangadmin"></div>
</ul>
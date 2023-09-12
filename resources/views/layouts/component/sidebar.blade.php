<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="{{ url('/') }}">
        <div class="sidebar-brand-icon ">
            {{-- <i class="fa-brands fa-stack-overflow"></i> --}}
            <img src="{{ asset('frontend') }}/img/icon/bavel.png" class="img-fluid" style="height:30px;">
        </div>
        <div class="sidebar-brand-text mx-3">{{ config('app.name', 'SIPETA') }}</div>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider ">
    <div class="sidebar-heading">
        {{ env('APP_NAME') }}
    </div>
    <!-- Nav Item - Dashboard -->
    <li class="nav-item {{ Nav::isRoute('home') }}">
        <a class="nav-link" href="{{ url('/home') }}">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>{{ __('Dashboard') }}</span>
        </a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider">
    <!-- Heading -->
    <div class="sidebar-heading">
        {{ __('Master Data') }}
    </div>
    <!-- Nav Item - desa -->
    <li class="nav-item {{ Nav::isRoute('desa') }}">
        <a class="nav-link" href="{{ url('/desa') }}">
            <i class="fas fa-folder"></i>
            <span>{{ __('Desa') }}</span>
        </a>
    </li>
    <!-- Nav Item - wisata -->
    <li class="nav-item {{ Nav::isRoute('wisata') }}">
        <a class="nav-link" href="{{ url('/wisata') }}">
            <i class="fas fa-folder"></i>
            <span>{{ __('Wisata') }}</span>
        </a>
    </li>
    <!-- Nav Item - kegiatan -->
    <li class="nav-item {{ Nav::isRoute('kegiatan') }}">
        <a class="nav-link" href="{{ url('/kegiatan') }}">
            <i class="fas fa-folder"></i>
            <span>{{ __('Event') }}</span>
        </a>
    </li>
    <!-- Nav Item - lapak -->
    <li class="nav-item {{ Nav::isRoute('lapak') }}">
        <a class="nav-link" href="{{ url('/lapak') }}">
            <i class="fas fa-folder"></i>
            <span>{{ __('Lapak') }}</span>
        </a>
    </li>
    {{-- start admin --}}
    <hr class="sidebar-divider d-none d-md-block">
    {{-- end admin --}}
    <!-- Heading -->


    <div class="sidebar-heading">
        {{ __('Settings') }}
    </div>

    <!-- Nav Item - Profile -->
    <li class="nav-item {{ Nav::isRoute('profile') }}">
        <a class="nav-link" href="{{ route('profile') }}">
            <i class="fas fa-fw fa-user"></i>
            <span>{{ __('Profile') }}</span>
        </a>
    </li>



    <!-- Divider -->
    <hr class="sidebar-divider d-none d-md-block">

    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>

</ul>

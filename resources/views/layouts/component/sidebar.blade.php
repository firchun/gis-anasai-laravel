<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="{{ url('/') }}">
        <div class="sidebar-brand-icon ">
            {{-- <i class="fa-brands fa-stack-overflow"></i> --}}
            <img src="{{ asset('img/favicon.png') }}" class="img-fluid" style="height:30px;">
        </div>
        <div class="sidebar-brand-text mx-3">{{ config('app.name', 'SIPETA') }}</div>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider ">
    <div class="sidebar-heading">
        {{ env('APP_NAME') }}
    </div>
    <!-- Nav Item - Dashboard -->
    <li class="nav-item {{ Request::is('/') ? 'active' : '' }}">
        <a class="nav-link" href="{{ url('/') }}">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>{{ __('Dashboard') }}</span>
        </a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider">

    {{-- start admin --}}
    @if (auth()->user()->role == 'admin' || auth()->user()->role == 'super_admin')
        <!-- Heading -->
        <div class="sidebar-heading">
            {{ __('Master Data') }}
        </div>
        <!-- Nav Item - agama -->
        <li class="nav-item {{ Nav::isRoute('agama') }}">
            <a class="nav-link" href="{{ route('agama') }}">
                <i class="fas fa-fw fa-heart"></i>
                <span>{{ __('Agama') }}</span>
            </a>
        </li>
        <!-- Nav Item - bidang -->
        <li class="nav-item {{ Nav::isRoute('bidang') }}">
            <a class="nav-link" href="{{ route('bidang') }}">
                <i class="fas fa-fw fa-folder"></i>
                <span>{{ __('Bidang') }}</span>
            </a>
        </li>
        <!-- Nav Item - jabatan -->
        <li class="nav-item {{ Nav::isRoute('jabatan') }}">
            <a class="nav-link" href="{{ route('jabatan') }}">
                <i class="fas fa-fw fa-folder"></i>
                <span>{{ __('Jabatan') }}</span>
            </a>
        </li>
        <!-- Nav Item - pendidikan -->
        <li class="nav-item {{ Nav::isRoute('pendidikan') }}">
            <a class="nav-link" href="{{ route('pendidikan') }}">
                <i class="fas fa-fw fa-folder"></i>
                <span>{{ __('Pendidikan Terakhir') }}</span>
            </a>
        </li>
        <!-- Nav Item - Pages Collapse Menu -->
        <li
            class="nav-item {{ request()->is('jenis_file_pribadi*') || request()->is('jenis_file_umum*') ? 'active' : '' }}">
            <a class="nav-link collapsed {{ request()->is('jenis_file_pribadi*') || request()->is('jenis_file_umum*') ? 'active' : '' }}"
                href="#" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="true"
                aria-controls="collapseTwo">
                <i class="fas fa-fw fa-file"></i>
                <span>Jenis File</span>
            </a>
            <div id="collapseTwo"
                class="collapse {{ request()->is('jenis_file_pribadi*') || request()->is('jenis_file_umum*') ? 'show' : '' }}"
                aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                <div class="bg-white py-2 collapse-inner rounded">
                    <h6 class="collapse-header">Jenis File :</h6>
                    <a class="collapse-item {{ request()->is('jenis_file_pribadi*') ? 'active' : '' }}"
                        href="{{ route('jenis_file_pribadi') }}">File Pribadi</a>
                    <a class="collapse-item {{ request()->is('jenis_file_umum*') ? 'active' : '' }}"
                        href="{{ route('jenis_file_umum') }}">File Umum</a>
                </div>
            </div>
        </li>

        <hr class="sidebar-divider">

        <!-- Heading -->
        <div class="sidebar-heading">
            {{ __('Files') }}
        </div>
        {{-- <!-- Nav Item - surat -->
        <li class="nav-item {{ Nav::isRoute('surat') }}">
            <a class="nav-link" href="{{ route('surat') }}">
                <i class="fas fa-fw fa-folder"></i>
                <span>{{ __('File Surat') }}</span>
            </a>
        </li> --}}
        <!-- Nav Item - Pegawai -->
        <li class="nav-item {{ Nav::isRoute('pegawai.all') }}">
            <a class="nav-link" href="{{ route('pegawai.all') }}">
                <i class="fas fa-fw fa-folder"></i>
                <span>{{ __('File Pegawai') }}</span>
            </a>
        </li>

        <!-- Nav Item - file umum -->
        <li class="nav-item {{ Nav::isRoute('file_upload.index') }}">
            <a class="nav-link" href="{{ route('file_upload.index') }}">
                <i class="fas fa-fw fa-folder"></i>
                <span>{{ __('File Umum') }}</span>
            </a>
        </li>
        <!-- Divider -->
        <hr class="sidebar-divider">
        <div class="sidebar-heading">
            {{ __('Laporan') }}
        </div>
        <!-- Nav Item - laporan pegawai-->
        <li class="nav-item {{ Nav::isRoute('laporan.pegawai') }}">
            <a class="nav-link" href="{{ route('laporan.pegawai') }}">
                <i class="fas fa-fw fa-folder"></i>
                <span>{{ __('Laporan Pegawai') }}</span>
            </a>
        </li>
        <!-- Nav Item - laporan bidang -->
        <li class="nav-item {{ Nav::isRoute('laporan.bidang') }}">
            <a class="nav-link" href="{{ route('laporan.bidang') }}">
                <i class="fas fa-fw fa-folder"></i>
                <span>{{ __('Laporan Bidang') }}</span>
            </a>
        </li>
        <!-- Nav Item - laporan surat-->
        <li class="nav-item {{ Nav::isRoute('laporan.surat') }}">
            <a class="nav-link" href="{{ route('laporan.surat') }}">
                <i class="fas fa-fw fa-folder"></i>
                <span>{{ __('Laporan Surat') }}</span>
            </a>
        </li>
        <!-- Nav Item - laporan file dinas-->
        <li class="nav-item {{ Nav::isRoute('laporan.file_umum') }}">
            <a class="nav-link" href="{{ route('laporan.file_umum') }}">
                <i class="fas fa-fw fa-folder"></i>
                <span>{{ __('Laporan File Umum') }}</span>
            </a>
        </li>
        <hr class="sidebar-divider">

        <!-- Heading -->
        <div class="sidebar-heading">
            {{ __('Akun') }}
        </div>
        <!-- Nav Item - akun admin -->
        <li class="nav-item {{ Nav::isRoute('akun_admin') }}">
            <a class="nav-link" href="{{ route('akun_admin') }}">
                <i class="fas fa-fw fa-users"></i>
                <span>{{ __('Akun Admin') }}</span>
            </a>
        </li>
        <!-- Nav Item - akun pegawai -->
        <li class="nav-item {{ Nav::isRoute('akun_pegawai') }}">
            <a class="nav-link" href="{{ route('akun_pegawai') }}">
                <i class="fas fa-fw fa-users"></i>
                <span>{{ __('Akun Pegawai') }}</span>
            </a>
        </li>
        <hr class="sidebar-divider">
    @endif
    @if (Auth::user()->role == 'bagian_umum')
        <!-- Heading -->
        <div class="sidebar-heading">
            {{ __('Files') }}
        </div>
        <!-- Nav Item - surat -->
        <li class="nav-item {{ Nav::isRoute('surat') }}">
            <a class="nav-link" href="{{ route('surat') }}">
                <i class="fas fa-fw fa-folder"></i>
                <span>{{ __('File Surat') }}</span>
            </a>
        </li>

        <!-- Nav Item - file umum -->
        {{-- <li class="nav-item {{ Nav::isRoute('file_upload.index') }}">
            <a class="nav-link" href="{{ route('file_upload.index') }}">
                <i class="fas fa-fw fa-folder"></i>
                <span>{{ __('File Umum') }}</span>
            </a>
        </li> --}}
        <hr class="sidebar-divider">
    @endif

    @if (Auth::guard('pegawai')->user())
        <div class="sidebar-heading">
            {{ __('Files') }}
        </div>
        <!-- Nav Item - Pegawai -->
        <li class="nav-item {{ Nav::isRoute('pegawai.index') }}">
            <a class="nav-link" href="{{ route('pegawai.index') }}">
                <i class="fas fa-fw fa-folder"></i>
                <span>{{ __('File Pegawai') }}</span>
            </a>
        </li>
        <hr class="sidebar-divider">
    @endif
    @if (Auth::user()->role == 'bidang')
        <div class="sidebar-heading">
            {{ __('File') }}
        </div>
        <!-- Nav Item -  file bidang-->
        <li class="nav-item {{ Nav::isRoute('file_upload.index') }}">
            <a class="nav-link" href="{{ route('file_upload.index') }}">
                <i class="fas fa-fw fa-folder"></i>
                <span>{{ __('File Bidang') }}</span>
            </a>
        </li>
        <!-- Nav Item -  file bidang-->
        <li class="nav-item {{ Nav::isRoute('surat.bidang') }}">
            <a class="nav-link" href="{{ route('surat.bidang') }}">
                <i class="fas fa-fw fa-folder"></i>
                <span>{{ __('Arsip Surat') }}</span>
            </a>
        </li>
        <hr class="sidebar-divider">
    @endif
    @if (Auth::user()->role == 'kadis')
        <div class="sidebar-heading">
            {{ __('Laporan') }}
        </div>
        <!-- Nav Item - laporan pegawai-->
        <li class="nav-item {{ Nav::isRoute('laporan.pegawai') }}">
            <a class="nav-link" href="{{ route('laporan.pegawai') }}">
                <i class="fas fa-fw fa-folder"></i>
                <span>{{ __('Laporan Pegawai') }}</span>
            </a>
        </li>
        <!-- Nav Item - laporan bidang -->
        <li class="nav-item {{ Nav::isRoute('laporan.bidang') }}">
            <a class="nav-link" href="{{ route('laporan.bidang') }}">
                <i class="fas fa-fw fa-folder"></i>
                <span>{{ __('Laporan Bidang') }}</span>
            </a>
        </li>
        <!-- Nav Item - laporan surat-->
        <li class="nav-item {{ Nav::isRoute('laporan.surat') }}">
            <a class="nav-link" href="{{ route('laporan.surat') }}">
                <i class="fas fa-fw fa-folder"></i>
                <span>{{ __('Laporan Surat') }}</span>
            </a>
        </li>
        <!-- Nav Item - laporan file dinas-->
        <li class="nav-item {{ Nav::isRoute('laporan.file_umum') }}">
            <a class="nav-link" href="{{ route('laporan.file_umum') }}">
                <i class="fas fa-fw fa-folder"></i>
                <span>{{ __('Laporan File Umum') }}</span>
            </a>
        </li>
        <hr class="sidebar-divider">
    @endif
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

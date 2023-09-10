<div class="row mt-5 justify-content-center">
    @if (Auth::user()->role == 'admin' || Auth::user()->role == 'super_admin' || Auth::user()->role == 'kadis')
        @include('pages.dashboard.component.card_item', [
            'title' => 'Bidang',
            'color' => 'warning',
            'count' => $bidang,
            'icon' => 'home',
        ])
        @include('pages.dashboard.component.card_item', [
            'title' => 'Users',
            'color' => 'primary',
            'count' => $users,
            'icon' => 'users',
        ])
        @include('pages.dashboard.component.card_item', [
            'title' => 'Pegawai',
            'color' => 'secondary',
            'count' => $pegawai,
            'icon' => 'users',
        ])
        @include('pages.dashboard.component.card_item', [
            'title' => 'File Umum terupload',
            'color' => 'success',
            'count' => $file_umum,
            'icon' => 'folder',
        ])
        @include('pages.dashboard.component.card_item', [
            'title' => 'Jenis File Umum',
            'color' => 'primary',
            'count' => $jenis_file_umum,
            'icon' => 'file',
        ])
        @include('pages.dashboard.component.card_item', [
            'title' => 'Jenis File Pribadi',
            'color' => 'danger',
            'count' => $jenis_file_pribadi,
            'icon' => 'file',
        ])
        @include('pages.dashboard.component.card_item', [
            'title' => 'Surat Keluar',
            'color' => 'info',
            'count' => $surat_keluar,
            'icon' => 'folder-open',
        ])
        @include('pages.dashboard.component.card_item', [
            'title' => 'Surat Masuk',
            'color' => 'primary',
            'count' => $surat_masuk,
            'icon' => 'folder-open',
        ])
        @include('pages.dashboard.component.card_item', [
            'title' => 'File Pegawai terupload',
            'color' => 'secondary',
            'count' => $file_pegawai,
            'icon' => 'folder',
        ])
        @include('pages.dashboard.component.card_item', [
            'title' => 'total File pada sistem',
            'color' => 'danger',
            'count' => $file_sistem,
            'icon' => 'database',
        ])
        @include('pages.dashboard.component.card_item', [
            'title' => 'ukuran pada file sistem',
            'color' => 'danger',
            'count' => $size_file_sistem . ' <small>MB</small>',
            'icon' => 'database',
        ])
    @elseif(Auth::user()->role == 'bagian_umum')
        @include('pages.dashboard.component.card_item', [
            'title' => 'Surat Keluar',
            'color' => 'info',
            'count' => $surat_keluar,
            'icon' => 'folder-open',
        ])
        @include('pages.dashboard.component.card_item', [
            'title' => 'Surat Masuk',
            'color' => 'primary',
            'count' => $surat_masuk,
            'icon' => 'folder-open',
        ])
    @elseif(Auth::user()->role == 'bidang')
        @php
            $pegawai_bidang = App\Models\Pegawai::where('id_bidang', Auth::user()->id_bidang);
            $nama_bidang = App\Models\Bidang::find(Auth::user()->id_bidang);
            $file_bidang = App\Models\FileUmumUpload::where('id_bidang', $nama_bidang->id)->count();
        @endphp
        @include('pages.dashboard.component.card_item', [
            'title' => 'Pegawai Bidang ' . $nama_bidang->nama_bidang,
            'color' => 'warning',
            'count' => $pegawai_bidang->count() . '<small class="text-muted"> Pegawai</small>',
            'icon' => 'users',
        ])
        @include('pages.dashboard.component.card_item', [
            'title' => 'File Bidang ' . $nama_bidang->nama_bidang,
            'color' => 'primary',
            'count' => $file_bidang . '<small class="text-muted"> File</small>',
            'icon' => 'folder',
        ])
    @elseif (Auth::guard('pegawai')->user())
        @php
            $jumlah_file = App\Models\Pegawai::find(Auth::guard('pegawai')->user()->id)->file_pribadi->count();
        @endphp
        @include('pages.dashboard.component.card_item', [
            'title' => 'File Ter-upload ',
            'color' => 'primary',
            'count' => $jumlah_file . '<small class="text-muted"> File</small>',
            'icon' => 'folder',
        ])
    @endif
</div>

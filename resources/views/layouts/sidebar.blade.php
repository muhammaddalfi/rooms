<div class="sidebar sidebar-main sidebar-expand-lg align-self-start">

    <!-- Sidebar content -->
    <div class="sidebar-content">

        <!-- Sidebar header -->
        <div class="sidebar-section">
            <div class="sidebar-section-body d-flex justify-content-center">
                <h5 class="sidebar-resize-hide flex-grow-1 my-auto">Navigation</h5>

                <div>
                    <button type="button"
                        class="btn btn-light btn-icon btn-sm rounded-pill border-transparent sidebar-control sidebar-main-resize d-none d-lg-inline-flex">
                        <i class="ph-arrows-left-right"></i>
                    </button>

                    <button type="button"
                        class="btn btn-light btn-icon btn-sm rounded-pill border-transparent sidebar-mobile-main-toggle d-lg-none">
                        <i class="ph-x"></i>
                    </button>
                </div>
            </div>
        </div>
        <!-- /sidebar header -->

        <!-- Main navigation -->
        <div class="sidebar-section">
            <ul class="nav nav-sidebar" data-nav-type="accordion">
                <!-- Main -->
                <li class="nav-item-header pt-0">
                    <div class="text-uppercase fs-sm lh-sm opacity-50 sidebar-resize-hide">Main</div>
                    <i class="ph-dots-three sidebar-resize-show"></i>
                </li>

                @can('monster read')
                    <li class="nav-item nav-item-submenu">
                        <a href="#" class="nav-link">
                            <i class="ph-finn-the-human"></i>
                            <span>MONSTER</span>
                        </a>
                        <ul class="nav-group-sub collapse" data-submenu-title="Layouts">

                            @can('dashboard cluster')
                                <li class="nav-item">
                                    <a href="{{ route('dashboard.cluster') }}" class="nav-link">
                                        <i class="ph-graph"></i>
                                        <span>Dashboard Cluster</span>
                                    </a>
                                </li>
                            @endcan

                            @can('dashboard keluhan')
                                <li class="nav-item">
                                    <a href="{{ route('dashboard.keluhan') }}" class="nav-link">
                                        <i class="ph-smiley-sad"></i>
                                        <span>Dashboard Keluhan</span>
                                    </a>
                                </li>
                            @endcan

                            @can('kegiatan read')
                                <li class="nav-item">
                                    <a href="{{ route('daily.dashboard') }}" class="nav-link">
                                        <i class="ph-camera"></i>
                                        <span>Kegiatan Cluster</span>
                                    </a>
                                </li>
                            @endcan

                            @can('keluhan read')
                                <li class="nav-item">
                                    <a href="{{ route('keluhan.dashboard') }}" class="nav-link">
                                        <i class="ph-chat-circle-text"></i>
                                        <span>Keluhan Cluster</span>
                                    </a>
                                </li>
                            @endcan

                            @can('olt read')
                                <li class="nav-item">
                                    <a href="{{ route('olt.dashboard') }}" class="nav-link">
                                        <i class="ph-broadcast"></i>
                                        <span>Nama Cluster</span>
                                    </a>
                                </li>
                            @endcan

                            @can('laporan read')
                                <li class="nav-item">
                                    <a href="{{ route('laporan.index') }}" class="nav-link">
                                        <i class="ph-calendar"></i>
                                        <span>Laporan Kegiatan</span>
                                    </a>
                                </li>
                            @endcan

                            @can('kategori kegiatan read')
                                <li class="nav-item">
                                    <a href="{{ route('activity.dashboard') }}" class="nav-link">
                                        <i class="ph-activity"></i>
                                        <span>kategori Kegiatan</span>
                                    </a>
                                </li>
                            @endcan

                            @can('kategori keluhan read')
                                <li class="nav-item">
                                    <a href="{{ route('jenis_keluhan.dashboard') }}" class="nav-link">
                                        <i class="ph-smiley-sad"></i>
                                        <span>Kategori Keluhan</span>
                                    </a>
                                </li>
                            @endcan

                            @can('sales read')
                                <li class="nav-item">
                                    <a href="{{ route('upline.dashboard') }}" class="nav-link">
                                        <i class="ph-git-fork"></i>
                                        <span>Sales Internal</span>
                                    </a>
                                </li>
                            @endcan

                            @can('perusahaan read')
                                <li class="nav-item">
                                    <a href="{{ route('mpp.dashboard') }}" class="nav-link">
                                        <i class="ph-user-list"></i>
                                        <span>Sales Perusahaan</span>
                                    </a>
                                </li>
                            @endcan

                            @can('radius read')
                                <li class="nav-item">
                                    <a href="{{ route('radius.dashboard') }}" class="nav-link">
                                        <i class="ph-map-pin"></i>
                                        <span>Radius Cluster</span>
                                    </a>
                                </li>
                            @endcan

                        </ul>
                    </li>
                @endcan
                {{-- {{ dd(auth()->user()->status) }} --}}
                @if (auth()->user()->status)
                    @can('muntang read')
                        <li class="nav-item nav-item-submenu">
                            <a href="#" class="nav-link">
                                <i class="ph-layout"></i>
                                <span>MUNTANG</span>
                            </a>

                            <ul class="nav-group-sub collapse" data-submenu-title="Layouts">

                                @can('dashboard piutang')
                                    <li class="nav-item">
                                        <a href="{{ route('dashboard.piutang') }}" class="nav-link">
                                            <i class="ph-chart-pie-slice"></i>
                                            <span>Dashboard</span>
                                        </a>
                                    </li>
                                @endcan
                                <li class="nav-item">
                                    <a href="{{ route('baddeb.index') }}" class="nav-link">
                                        <i class="ph-currency-circle-dollar"></i>
                                        <span>Data Piutang</span>
                                    </a>
                                </li>

                                @can('kategori piutang read')
                                    <li class="nav-item">
                                        <a href="{{ route('katdeb.index') }}" class="nav-link">
                                            <i class="ph-diamonds-four"></i>
                                            <span>Kategori Telat Bayar</span>
                                        </a>
                                    </li>
                                @endcan

                                <li class="nav-item">
                                    <a href="{{ route('report.index') }}" class="nav-link">
                                        <i class="ph-calendar"></i>
                                        <span>Laporan</span>
                                    </a>
                                </li>
                            </ul>
                        </li>
                    @endcan
                @endif

                @can('user read')
                    <li class="nav-item">
                        <a href="{{ route('pengguna.dashboard') }}" class="nav-link">
                            <i class="ph-user-plus"></i>
                            <span>Tambah Pengguna</span>
                        </a>
                    </li>
                @endcan

                @can('role read')
                    <li class="nav-item">
                        <a href="{{ route('role.index') }}" class="nav-link">
                            <i class="ph-lock"></i>
                            <span>Tambah Role</span>
                        </a>
                    </li>
                @endcan

                @can('permission read')
                    <li class="nav-item">
                        <a href="{{ route('permission.index') }}" class="nav-link">
                            <i class="ph-lock"></i>
                            <span>Tambah Permission</span>
                        </a>
                    </li>
                @endcan

                {{-- @role('gm')
                    <li class="nav-item">
                        <a href="{{ route('dashboard.keluhan') }}" class="nav-link">
                            <i class="ph-smiley-sad"></i>
                            <span>Dashboard Keluhan</span>
                        </a>
                    </li>

                    <!-- Layout -->
                    <li class="nav-item-header">
                        <div class="text-uppercase fs-sm lh-sm opacity-50 sidebar-resize-hide">Layout</div>
                        <i class="ph-dots-three sidebar-resize-show"></i>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('daily.dashboard') }}" class="nav-link">
                            <i class="ph-camera"></i>
                            <span>Kegiatan Cluster</span>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a href="{{ route('keluhan.dashboard') }}" class="nav-link">
                            <i class="ph-chat-circle-text"></i>
                            <span>Keluhan Cluster</span>
                        </a>
                    </li>
                @endrole

                @can('leader read')
                    <!-- Layout -->
                    <li class="nav-item-header">
                        <div class="text-uppercase fs-sm lh-sm opacity-50 sidebar-resize-hide">Layout</div>
                        <i class="ph-dots-three sidebar-resize-show"></i>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('daily.dashboard') }}" class="nav-link">
                            <i class="ph-camera"></i>
                            <span>Kegiatan Cluster</span>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a href="{{ route('keluhan.dashboard') }}" class="nav-link">
                            <i class="ph-chat-circle-text"></i>
                            <span>Keluhan Cluster</span>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a href="{{ route('olt.dashboard') }}" class="nav-link">
                            <i class="ph-broadcast"></i>
                            <span>Nama Cluster</span>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a href="{{ route('upline.dashboard') }}" class="nav-link">
                            <i class="ph-git-fork"></i>
                            <span>Anggota</span>
                        </a>
                    </li>
                @endcan

                @can('user read')
                    <!-- Layout -->
                    <li class="nav-item-header">
                        <div class="text-uppercase fs-sm lh-sm opacity-50 sidebar-resize-hide">Layout</div>
                        <i class="ph-dots-three sidebar-resize-show"></i>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('daily.dashboard') }}" class="nav-link">
                            <i class="ph-camera"></i>
                            <span>Kegiatan Cluster</span>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a href="{{ route('keluhan.dashboard') }}" class="nav-link">
                            <i class="ph-chat-circle-text"></i>
                            <span>Keluhan Cluster</span>
                        </a>
                    </li>
                @endcan --}}
                <!-- /layout -->

            </ul>
        </div>
        <!-- /main navigation -->

    </div>
    <!-- /sidebar content -->

</div>

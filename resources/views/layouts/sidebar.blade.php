@can('admin read')
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
                    <li class="nav-item">
                        <a href="{{ route('home.dashboard') }}" class="nav-link">
                            <i class="ph-house"></i>
                            <span>Dashboard</span>
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
                            <span>Dokumentasi</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('olt.dashboard') }}" class="nav-link">
                            <i class="ph-broadcast"></i>
                            <span>OLT</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('activity.dashboard') }}" class="nav-link">
                            <i class="ph-activity"></i>
                            <span>Jenis Kegiatan</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="" class="nav-link">
                            <i class="ph-user"></i>
                            <span>Pengguna</span>
                        </a>
                    </li>

                    <!-- /layout -->

                </ul>
            </div>
            <!-- /main navigation -->

        </div>
        <!-- /sidebar content -->

    </div>
@endcan

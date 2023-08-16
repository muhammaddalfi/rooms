<div class="sidebar sidebar-main sidebar-expand-lg align-self-start sidebar-main-resized">

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
                        <i class="ph-graph"></i>
                        <span>Dashboard Cluster</span>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{{ route('keluhan.dashboard') }}" class="nav-link">
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

                @can('admin read')
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
                        <a href="{{ route('upline.dashboard') }}" class="nav-link">
                            <i class="ph-git-fork"></i>
                            <span>PIC Internal</span>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a href="{{ route('mpp.dashboard') }}" class="nav-link">
                            <i class="ph-user-list"></i>
                            <span>PIC Perusahaan</span>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a href="{{ route('radius.dashboard') }}" class="nav-link">
                            <i class="ph-map-pin"></i>
                            <span>Radius Cluster</span>
                        </a>
                    </li>
                @endcan

                <!-- /layout -->

            </ul>
        </div>
        <!-- /main navigation -->

    </div>
    <!-- /sidebar content -->

</div>

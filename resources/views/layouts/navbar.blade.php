<div class="navbar navbar-sm navbar-light navbar-expand-lg">
    <div class="container-fluid">
        <div class="d-flex d-lg-none me-2">
            <button type="button" class="navbar-toggler sidebar-mobile-main-toggle rounded">
                <i class="ph-list"></i>
            </button>
        </div>

        <div class="navbar-brand">
            <a href="{{ route('home.dashboard') }}" class="d-inline-flex align-items-center">
                <img src="{{ asset('assets/images/logo_icon.svg') }}" alt="">

            </a>
        </div>

        <ul class="nav gap-sm-2 order-1 order-lg-2 ms-auto">
            <li class="nav-item nav-item-dropdown-lg dropdown">
                <a href="#" class="navbar-nav-link align-items-center rounded p-1" data-bs-toggle="dropdown"
                    aria-expanded="false">
                    <div class="status-indicator-container">
                        <img src="{{ asset('assets/images/demo/users/face2.jpg') }}" class="w-32px h-32px rounded"
                            alt="">
                        <span class="status-indicator bg-success"></span>
                    </div>
                    <span class="d-none d-lg-inline-block mx-lg-2">{{ Auth::user()->name }}</span>
                </a>

                <div class="dropdown-menu dropdown-menu-end">
                    <a href="" class="dropdown-item profile"><i class="icon-user-plus"></i> Ganti Password</a>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button class="dropdown-item">Keluar</button>
                    </form>
                </div>
            </li>
        </ul>
    </div>
</div>

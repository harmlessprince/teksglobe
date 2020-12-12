<div class="nav-left-sidebar sidebar-dark">
    <div class="menu-list">
        <nav class="navbar navbar-expand-lg navbar-light">
            <a class="d-xl-none d-lg-none" href="#">Dashboard</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav flex-column">
                    <li class="nav-divider text-center">
                        @can('isAdmin')
                            @if (\Request::route()->getPrefix() == '/admin')
                            <h3 style="color: #fff">Aministrator Panel</h3>
                            @else
                            <h3 style="color: #fff">Member Panel</h3>
                            @endif
                        @else
                            <h3 style="color: #fff">Member Panel</h3>
                        @endcan

                    </li>
                    {{-- <li class="nav-divider text-center">
                        <div class="user">
                            <div class="photo">
                                <img src="{{ asset('uploads/avatars/default.jpg') }}" class="photo__image">
                            </div>
                        </div>
                        <a class="nav-link " href="#" data-toggle="collapse" aria-expanded="false"
                            data-target="#submenu-0" aria-controls="submenu-0"><i class="fa fa-fw fa-user"></i>Taofee
                            Adewuyi </a>
                        <div id="submenu-0" class="collapse submenu" style="">
                            <ul class="nav flex-column">
                                <li class="nav-item">
                                    <a class="nav-link" href="#">Edit Profile</a>
                                </li>
                            </ul>
                        </div>
                    </li> --}}
                    @if (\Request::route()->getPrefix() == '/admin')
                        @include('partials.side-menu.admin')
                    @else
                        @include('partials.side-menu.user')
                    @endif
                </ul>
            </div>
        </nav>
    </div>
</div>

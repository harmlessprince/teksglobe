<!-- ============================================================== -->
<div class="dashboard-header">
    <nav class="navbar navbar-expand-lg bg-white fixed-top">
        @include('components.navbarbrand')
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse " id="navbarSupportedContent">
            <ul class="navbar-nav ml-auto navbar-right-top">
                @can('isAdmin')
                    <li class="nav-item">

                        @if (Route::current()->getName() === 'admindb')
                            <a class="nav-link nav-icons" href="{{ route('generaldb') }}" aria-haspopup="true"
                                aria-expanded="false">
                                <span class="indicator"></span>Go To User Panel</a>
                        @else
                            <a class="nav-link nav-icons" href="{{ route('admindb') }}" aria-haspopup="true"
                                aria-expanded="false">
                                <span class="indicator"></span>Go To Admin Panel</a>
                        @endif
                    </li>
                @else

                @endcan

                <li class="nav-item">
                    <a class="nav-link nav-icons" href="#" aria-haspopup="true" aria-expanded="false"><i
                            class="fas fa-fw fa-home"></i> <span class="indicator"></span>Homepage</a>

                </li>
                <li class="nav-item">
                    <a class="nav-link nav-icons" href="#" aria-haspopup="true" aria-expanded="false"><i
                            class="fas fa-fw fa-pencil-alt"></i> <span class="indicator"></span>Write a review</a>

                </li>
                <li class="nav-item">
                    <a class="nav-link nav-icons" href="#" aria-haspopup="true" aria-expanded="false"><i
                            class="fab fa-fw fa-blogger"></i> <span class="indicator"></span>Blog</a>

                </li>
                <li class="nav-item">
                    <a class="nav-link nav-icons" href="#" aria-haspopup="true" aria-expanded="false"><i
                            class="fas fa-fw fa-phone-square"></i> <span class="indicator"></span>Support center</a>

                </li>
                <li class="nav-item">
                    <a class="nav-link nav-icons" href="#" aria-haspopup="true" aria-expanded="false"><i
                            class="fas fa-fw fa-hands-helping"></i> <span class="indicator"></span>Request support</a>

                </li>
                <li class="nav-item dropdown nav-user">
                    <a class="nav-link nav-user-img" href="#" id="navbarDropdownMenuLink2" data-toggle="dropdown"
                        aria-haspopup="true" aria-expanded="false">
                        <img src="{{ asset('uploads/avatars/default.jpg') }}" class="user-avatar-md rounded-circle">
                        {{-- <img src="assets/images/avatar-1.jpg" alt=""
                            class="user-avatar-md rounded-circle"></a> --}}
                    <div class="dropdown-menu dropdown-menu-right nav-user-dropdown"
                        aria-labelledby="navbarDropdownMenuLink2">
                        <div class="nav-user-info">
                            <h5 class="mb-0 text-white nav-user-name">{{ auth()->user()->name }}</h5>
                            <span class="status"></span><span class="ml-2">Available</span>
                        </div>
                        <a class="dropdown-item"
                            href="{{ route('profile.show', auth()->user()->id) }}">
                            {{-- <a class="dropdown-item" href="#"> --}}
                                <i class="fas fa-user mr-2"></i>Account</a>
                            <a class="dropdown-item" href="#"><i class="fas fa-cog mr-2"></i>Setting</a>
                            <!-- Authentication -->
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf

                                <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();
                                                            this.closest('form').submit();">
                                    <i class=" fas fa-power-off mr-2"></i>Logout</a>
                            </form>
                    </div>
                </li>
            </ul>
        </div>
    </nav>
</div>
<!-- ============================================================== -->

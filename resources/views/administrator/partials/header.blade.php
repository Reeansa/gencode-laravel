<div class="header">
    <div class="logo logo-dark">
        <a href="{{ route('dashboard') }}" class="d-flex align-items-center justify-content-center h-100">
            <img width="80" src="{{ asset('administrator/assets/img/logo/logo.png') }}" alt="Logo">
            <img width="40" class="logo-fold" src="{{ asset('administrator/assets/img/logo/logo-fold.png') }}" alt="Logo">
        </a>
    </div>
    <div class="logo logo-white">
        <a href="{{ route('dashboard') }}" class="d-flex align-items-center justify-content-center h-100">
            <img width="80" src="{{ asset('administrator/assets/img/logo/logo.png') }}" alt="Logo">
            <img width="40" class="logo-fold" src="{{ asset('administrator/assets/img/logo/logo-fold.png') }}" alt="Logo">
        </a>
    </div>
    <div class="nav-wrap">
        <ul class="nav-left">
            <li class="desktop-toggle">
                <a href="javascript:void(0);">
                    <i class="anticon"></i>
                </a>
            </li>
            <li class="mobile-toggle">
                <a href="javascript:void(0);">
                    <i class="anticon"></i>
                </a>
            </li>
            <li>
                <a href="{{ route('beranda.index') }}">
                    <i class="anticon anticon-shop"></i>
                </a>
            </li>
        </ul>
        <ul class="nav-right">
            <li class="dropdown dropdown-animated scale-left">
                <div class="pointer" data-toggle="dropdown">
                    <div class="avatar avatar-image  m-h-10 m-r-15">
                        <img src="@if(auth()->user()->image) {{ asset('administrator/storage/'.auth()->user()->image) }} @else {{ asset('administrator/assets/img/profiles/thumb-1.jpg') }} @endif" alt="{{ auth()->user()->first_name }}" style="object-fit: cover; object-position: center;">
                    </div>
                </div>
                <div class="p-b-15 p-t-20 dropdown-menu pop-profile">
                    <div class="p-h-20 p-b-15 m-b-10 border-bottom">
                        <div class="d-flex m-r-50">
                            <div class="avatar avatar-lg avatar-image">
                                <img src="@if(auth()->user()->image) {{ asset('administrator/storage/'.auth()->user()->image) }} @else {{ asset('administrator/assets/img/profiles/thumb-1.jpg') }} @endif" alt="{{ auth()->user()->first_name }}" style="object-fit: cover; object-position: center;">
                            </div>
                            <div class="m-l-10">
                                <p class="m-b-0 text-dark font-weight-semibold">{{ auth()->user()->first_name .' '. auth()->user()->last_name}}</p>
                                <p class="m-b-0 opacity-07">{{ auth()->user()->roles->name }}</p>
                            </div>
                        </div>
                    </div>
                    <a href="{{ route('profile.show', auth()->user()->id) }}" class="dropdown-item d-block p-h-15 p-v-10">
                        <div class="d-flex align-items-center justify-content-between">
                            <div>
                                <i class="anticon opacity-04 font-size-16 anticon-user"></i>
                                <span class="m-l-10">Profil</span>
                            </div>
                            <i class="anticon font-size-10 anticon-right"></i>
                        </div>
                    </a>
                    <a href="{{ route('logout') }}" class="dropdown-item d-block p-h-15 p-v-10">
                        <div class="d-flex align-items-center justify-content-between">
                            <div>
                                <i class="anticon opacity-04 font-size-16 anticon-logout"></i>
                                <span class="m-l-10">Logout</span>
                            </div>
                            <i class="anticon font-size-10 anticon-right"></i>
                        </div>
                    </a>
                </div>
            </li>
        </ul>
    </div>
</div>

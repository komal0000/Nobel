<div class="position-relative iq-banner">
    <!--Nav Start-->
    <nav class="nav navbar navbar-expand-xl navbar-light iq-navbar">
        <div class="container-fluid navbar-inner">
            <a href="{{ route('admin.index') }}" class="navbar-brand">

                <!--Logo start-->
                <div class="logo-main">
                    <div class="logo-normal">
                        <svg class="text-primary icon-30" viewBox="0 0 30 30" fill="none"
                            xmlns="http://www.w3.org/2000/svg">
                            <rect x="-0.757324" y="19.2427" width="28" height="4" rx="2"
                                transform="rotate(-45 -0.757324 19.2427)" fill="currentColor" />
                            <rect x="7.72803" y="27.728" width="28" height="4" rx="2"
                                transform="rotate(-45 7.72803 27.728)" fill="currentColor" />
                            <rect x="10.5366" y="16.3945" width="16" height="4" rx="2"
                                transform="rotate(45 10.5366 16.3945)" fill="currentColor" />
                            <rect x="10.5562" y="-0.556152" width="28" height="4" rx="2"
                                transform="rotate(45 10.5562 -0.556152)" fill="currentColor" />
                        </svg>
                    </div>
                    <div class="logo-mini">
                        <svg class="text-primary icon-30" viewBox="0 0 30 30" fill="none"
                            xmlns="http://www.w3.org/2000/svg">
                            <rect x="-0.757324" y="19.2427" width="28" height="4" rx="2"
                                transform="rotate(-45 -0.757324 19.2427)" fill="currentColor" />
                            <rect x="7.72803" y="27.728" width="28" height="4" rx="2"
                                transform="rotate(-45 7.72803 27.728)" fill="currentColor" />
                            <rect x="10.5366" y="16.3945" width="16" height="4" rx="2"
                                transform="rotate(45 10.5366 16.3945)" fill="currentColor" />
                            <rect x="10.5562" y="-0.556152" width="28" height="4" rx="2"
                                transform="rotate(45 10.5562 -0.556152)" fill="currentColor" />
                        </svg>
                    </div>
                </div>
                <!--logo End-->
                <h4 class="logo-title">Nobel</h4>
            </a>
            <div class="sidebar-toggle" data-toggle="sidebar" data-active="true">
                <i class="icon">
                    <svg width="20px" class="icon-20" viewBox="0 0 24 24">
                        <path fill="currentColor"
                            d="M4,11V13H16L10.5,18.5L11.92,19.92L19.84,12L11.92,4.08L10.5,5.5L16,11H4Z" />
                    </svg>
                </i>
            </div>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="mb-2 navbar-nav ms-auto align-items-center navbar-list mb-lg-0">

                    <li class="nav-item dropdown custom-drop">
                        <a class="py-0 nav-link d-flex align-items-center" href="#" id="navbarDropdown"
                            role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <img src="{{ asset('assets/images/avatars/01.png') }}" alt="User-Profile"
                                class="theme-color-default-img img-fluid avatar avatar-50 avatar-rounded">
                            <img src="{{ asset('assets/images/avatars/avtar_1.png') }}" alt="User-Profile"
                                class="theme-color-purple-img img-fluid avatar avatar-50 avatar-rounded">
                            <img src="{{ asset('assets/images/avatars/avtar_2.png') }}" alt="User-Profile"
                                class="theme-color-blue-img img-fluid avatar avatar-50 avatar-rounded">
                            <img src="{{ asset('assets/images/avatars/avtar_4.png') }}" alt="User-Profile"
                                class="theme-color-green-img img-fluid avatar avatar-50 avatar-rounded">
                            <img src="{{ asset('assets/images/avatars/avtar_5.png') }}" alt="User-Profile"
                                class="theme-color-yellow-img img-fluid avatar avatar-50 avatar-rounded">
                            <img src="{{ asset('assets/images/avatars/avtar_3.png') }}" alt="User-Profile"
                                class="theme-color-pink-img img-fluid avatar avatar-50 avatar-rounded">
                            <div class="caption ms-3 d-none d-md-block ">
                                <h6 class="mb-0 caption-title">User</h6>
                                <p class="mb-0 caption-sub-title">Their role</p>
                            </div>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                            <li><a class="dropdown-item" href="{{ asset('dashboard/app/user-profile.html') }}">Profile</a>
                            </li>
                            <li><a class="dropdown-item" href="{{ asset('dashboard/app/user-privacy-setting.html') }}">Privacy
                                    Setting</a></li>
                            <li>
                                <hr class="dropdown-divider">
                            </li>
                            <li><a class="dropdown-item" href="{{ route('logout') }}">Logout</a></li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
        <div class="iq-navbar-header" style="height: 215px;">
            <div class="container-fluid iq-container">
                <div class="row">
                    <div class="col-md-12">
                        <div class="flex-wrap d-flex justify-content-between align-items-center">
                            <div>
                                <h1>Hello Devs!</h1>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="iq-header-img">
                <img src="{{ asset('assets/images/dashboard/top-header.png') }}" alt="header"
                    class="theme-color-default-img img-fluid w-100 h-100 animated-scaleX">
                <img src="{{ asset('assets/images/dashboard/top-header1.png') }}" alt="header"
                    class="theme-color-purple-img img-fluid w-100 h-100 animated-scaleX">
                <img src="{{ asset('assets/images/dashboard/top-header2.png') }}" alt="header"
                    class="theme-color-blue-img img-fluid w-100 h-100 animated-scaleX">
                <img src="{{ asset('assets/images/dashboard/top-header3.png') }}" alt="header"
                    class="theme-color-green-img img-fluid w-100 h-100 animated-scaleX">
                <img src="{{ asset('assets/images/dashboard/top-header4.png') }}" alt="header"
                    class="theme-color-yellow-img img-fluid w-100 h-100 animated-scaleX">
                <img src="{{ asset('assets/images/dashboard/top-header5.png') }}" alt="header"
                    class="theme-color-pink-img img-fluid w-100 h-100 animated-scaleX">
            </div>
        </div>

</div>

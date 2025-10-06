<header id="page-topbar">
    <div class="layout-width">
        <div class="navbar-header">
            <div class="d-flex">
                <div class="navbar-brand-box horizontal-logo">
                    <a target="_blank" href="{{ config('constants.link_copyright') }}" class="logo logo-dark">
                        <span class="logo-sm">
                            <img src="{{asset('')}}backend/images/logo-sm.png" height="30">
                        </span>
                        <span class="logo-lg">
                            <img src="{{asset('')}}backend/images/logo-dark.png" height="30">
                        </span>
                    </a>

                    <a target="_blank" href="{{ config('constants.link_copyright') }}" class="logo logo-light">
                        <span class="logo-sm">
                            <img src="{{asset('')}}backend/images/logo-sm.png" height="30">
                        </span>
                        <span class="logo-lg">
                            <img src="{{asset('')}}backend/images/logo-light.png" height="30">
                        </span>
                    </a>
                </div>
                

                <button type="button" class="btn btn-sm ps-1 pe-3 fs-16 header-item vertical-menu-btn topnav-hamburger"
                    id="topnav-hamburger-icon">
                    <span class="hamburger-icon">
                        <span></span>
                        <span></span>
                        <span></span>
                    </span>
                </button>

                <form class="app-search d-none d-md-block">
                    <div class="position-relative" id="search-options">
                        <h5 class='mt-2'>@yield('title_page', 'SmartBiz')</h5>
                        <span class="mdi mdi-close-circle search-widget-icon search-widget-icon-close d-none"
                            id="search-close-options"></span>
                    </div>
                </form>
            </div>

            <div class="d-flex align-items-center">

                @include('backend.partials.header_search')

                <div class="ms-1 header-item d-none d-sm-flex">
                    <button type="button" class="btn btn-icon btn-topbar btn-ghost-secondary rounded-circle"
                        data-toggle="fullscreen">
                        <i class='bx bx-fullscreen fs-22'></i>
                    </button>
                </div>

                <div class="ms-1 header-item d-none d-sm-flex">
                    <button type="button"
                        class="btn btn-icon btn-topbar btn-ghost-secondary rounded-circle light-dark-mode">
                        <i class='bx bx-moon fs-22'></i>
                    </button>
                </div>

                <div class="dropdown header-item topbar-user">
                    <button type="button" class="btn" id="page-header-user-dropdown" data-bs-toggle="dropdown"
                        aria-haspopup="true" aria-expanded="false">
                        <span class="d-flex align-items-center">
                            <img class="rounded-circle header-profile-user" src="{{asset('')}}backend/images/user_avata.jpg">
                        </span>
                    </button>
                    <div class="dropdown-menu dropdown-menu-end">
                        <span class="dropdown-item py-2"><b>{{ Auth::user()->name }} </b></span></a>
                        <a class="dropdown-item" href="{{ route('admin.changeProfile') }}"><i
                                class="mdi mdi-account-circle text-muted fs-16 align-middle me-1"></i><span
                                class="align-middle">Thông tin cá nhân</span></a>
                        <a class="dropdown-item" href="{{ route('admin.changePassword') }}"><i
                                class="mdi mdi-cog-outline text-muted fs-16 align-middle me-1"></i><span
                                class="align-middle">Thay đổi mật khẩu</span></a>
                
                        <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();
                                                    document.getElementById('logout-form').submit();"><i
                                class="mdi mdi-logout text-muted fs-16 align-middle me-1"></i><span
                                class="align-middle" data-key="t-logout">Đăng xuất</span></a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            @csrf
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>
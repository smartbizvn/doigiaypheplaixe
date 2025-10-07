<div class="app-menu navbar-menu">
    <div class="navbar-brand-box">
        <a target="_blank" href="#" class="logo logo-dark">
            <span class="logo-sm">
                <img src="{{asset('backend/images/logo-sm.png')}}" height="30">
            </span>
            <span class="logo-lg">
                <img class='mt-2' src="{{asset('backend/images/logo-dark.png')}}" height="40">
            </span>
        </a>
        <a target="_blank" href="#" class="logo logo-light">
            <span class="logo-sm">
                <img src="{{asset('backend/images/logo-sm.png')}}" height="30">
            </span>
            <span class="logo-lg">
                <img class='mt-2' src="{{asset('backend/images/logo-light.png')}}" height="40">
            </span>
        </a>
        <button type="button" class="btn btn-sm p-0 fs-20 header-item float-end btn-vertical-sm-hover" id="vertical-hover">
            <i class="ri-record-circle-line"></i>
        </button>
    </div>

    <div id="scrollbar">
        <div class="container-fluid">
            <div id="two-column-menu"></div>
            <ul class="navbar-nav" id="navbar-nav">
                <li class="menu-title"><span data-key="t-menu">Chức năng</span></li>
                @php
                    $active_article = (request()->is('admin/articles*')  || request()->is('admin/article_categories*'))  ? true : false;
                @endphp
                <li class="nav-item">
                    <a class="nav-link menu-link" href="#sidebarArticle" data-bs-toggle="collapse" role="button"
                        aria-expanded="{{ $active_article ? 'true' : 'false' }}" aria-controls="sidebarArticle">
                        <i class="ri-article-line"></i> <span data-key="t-dashboards">Quản lý Bài viết</span>
                    </a>
                    <div class="collapse menu-dropdown {{ $active_article ? 'show' : '' }}" id="sidebarArticle">
                        <ul class="nav nav-sm flex-column">
                            @can('articles_access')
                                <li class="nav-item">
                                    <a href="{{ route("admin.articles.index") }}" class="nav-link {{ request()->is('admin/articles*') ? 'active' : '' }}"> Quản lý Bài viết
                                    </a>
                                </li>
                            @endcan
                            @can('article_category_access')
                                <li class="nav-item">
                                    <a href="{{ route("admin.article_categories.index") }}" class="nav-link {{ request()->is('admin/article_categories*') ? 'active' : '' }}"> Quản lý Danh mục </a>
                                </li>
                            @endcan
                        </ul>
                    </div>
                </li>

                @can('banners_access')
                <li class="nav-item">
                    <a class="nav-link menu-link {{ request()->is('admin/banners*') ? 'active' : '' }}" href="{{ route("admin.banners.index") }}">
                        <i class="las la-image"></i> <span data-key="t-widgets">Quản lý Banner</span>
                    </a>
                </li>
                @endcan

                @can('menus_access')
                <li class="nav-item">
                    <a class="nav-link menu-link {{ request()->is('admin/menus*') ? 'active' : '' }}" href="{{ route("admin.menus.index") }}">
                        <i class="bx bx-list-ul"></i> <span data-key="t-widgets">Quản lý Menu</span>
                    </a>
                </li>
                @endcan

                @can('user_management_access')
                @php
                    $active_user_management = (request()->is('admin/permissions*')  || request()->is('admin/roles*')  || request()->is('admin/users*'))  ? true : false;
                @endphp
                <li class="nav-item">
                    <a class="nav-link menu-link" href="#sidebarAccount" data-bs-toggle="collapse" role="button"
                        aria-expanded="{{ $active_user_management ? 'true' : 'false' }}" aria-controls="sidebarAccount">
                        <i class="ri-team-fill"></i> <span data-key="t-tables">Quản lý Tài khoản</span>
                    </a>
                    <div class="collapse menu-dropdown {{ $active_user_management ? 'show' : '' }}" id="sidebarAccount">
                        <ul class="nav nav-sm flex-column">
                            @can('users_access')
                                <li class="nav-item">
                                    <a href="{{ route("admin.users.index") }}" class="nav-link {{ request()->is('admin/users*') ? 'active' : '' }}" data-key="t-list-js">Quản lý Tài khoản</a>
                                </li>
                            @endcan
                            
                            @can('roles_access')
                                <li class="nav-item">
                                    <a href="{{ route("admin.roles.index") }}" class="nav-link {{ request()->is('admin/roles*') ? 'active' : '' }}" data-key="t-grid-js">Quản lý Vai trò</a>
                                </li>
                            @endcan

                            @can('permissions_access')
                                <li class="nav-item">
                                    <a href="{{ route("admin.permissions.index") }}" class="nav-link {{ request()->is('admin/permissions*') ? 'active' : '' }}" data-key="t-basic-tables">Quản lý Quyền</a>
                                </li>
                            @endcan
                        </ul>
                    </div>
                </li>
                @endcan

                @can('settings_access')
                <li class="nav-item">
                    <a class="nav-link menu-link {{ request()->is('admin/settings*') ? 'active' : '' }}" href="{{ route("admin.settings.index") }}">
                        <i class="ri-settings-3-line"></i> <span data-key="t-widgets">Cấu hình hệ thống</span>
                    </a>
                </li>
                @endcan
            </ul>
        </div>
    </div>
    <div class="text-center text-muted">
        <hr>
        Phát triển bởi <a target="_blank" href="{{ config('constants.link_copyright') }}"><span class='text-danger'>{{ config('constants.name_copyright') }}</span></a>
    </div>
</div>

<div class="vertical-overlay"></div>
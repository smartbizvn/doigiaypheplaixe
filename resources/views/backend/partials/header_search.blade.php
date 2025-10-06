
<div class="d-flex align-items-center justify-content-between w-100">
    <!-- Desktop -->
    <div class="d-none d-md-block">
        <div class="dropdown topbar-head-dropdown header-item me-3">
            <form action="{{ baseURL().'/admin/'.$module }}">
            <div class="search-bar d-flex align-items-center border bg-white">
                <i data-feather="search" class="icon-sm"></i>
                <input class="form-control flex-grow-1 border-0 input-search-header ps-2 pe-0" name='key' value="{{ Request::input('key') ?? "" }}"  placeholder="Tìm kiếm">
                <div class="btn-group d-flex gap-2 align-items-center">
                    <button class="btn btn-sm btn-link rounded-pill search-auto position-relative" title="Tìm nâng cao" type="button" data-izimodal-open=".izimodal_search">
                        <i data-feather="sliders" class="icon-xs"></i>
                    </button>
                </div>
            </div>
        </form>
    </div>
    </div>

    <!-- Mobile -->
    <div class="d-block d-md-none">
        <button class="btn btn-light rounded-circle p-2" type="button" title="Tìm kiếm" data-izimodal-open=".izimodal_search">
            <i data-feather="search" class="icon-sm"></i>
        </button>
    </div>
</div>
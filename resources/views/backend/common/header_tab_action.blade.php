@php
    $tabs = [
        'all' => ['label' => 'Tất cả', 'count' => $summary['total'] ?? 0],
        'active' => ['label' => 'Đang hoạt động', 'count' => $summary['active'] ?? 0],
        'inactive' => ['label' => 'Không hoạt động', 'count' => $summary['inactive'] ?? 0],
    ];
    $currentStatus = request('status', 'all');
@endphp


<div class="header_tab_action fixed_tab_header z_index_1 mb-3">
    <div class="page-title-box d-flex flex-wrap justify-content-between align-items-center">

        {{-- Tabs desktop --}}
        <div class="header_tabs gap-2 d-none d-md-block">
            <ul class="nav nav-tabs border-0 nav-tabs-custom nav-success" role="tablist">
                @foreach ($tabs as $key => $tab)
                    <li class="nav-item">
                        <a class="nav-link {{ $currentStatus === $key ? 'active' : '' }}"
                           href="{{ request()->fullUrlWithQuery(['status' => $key, 'page' => 1]) }}"
                           role="tab"
                           aria-selected="{{ $currentStatus === $key ? 'true' : 'false' }}">
                            {{ $tab['label'] }} ({{ $tab['count'] }})
                        </a>
                    </li>
                @endforeach
            </ul>
        </div>

        {{-- Tabs mobile --}}
        <div class="d-block d-md-none py-2">
            <div class="dropdown">
                <button class="btn btn-ghost-primary btn-sm dropdown-toggle" type="button" data-bs-toggle="dropdown">
                    <i class="las la-filter"></i> {{ $tabs[$currentStatus]['label'] ?? 'Chọn tab' }}
                </button>
                <ul class="dropdown-menu">
                    @foreach ($tabs as $key => $tab)
                        <li>
                            <a class="dropdown-item {{ $currentStatus === $key ? 'active fw-bold' : '' }}"
                               href="{{ request()->fullUrlWithQuery(['status' => $key, 'page' => 1]) }}">
                                {{ $tab['label'] }} ({{ $tab['count'] }})
                            </a>
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>
        @include('backend.common.actions')
    </div>
</div>

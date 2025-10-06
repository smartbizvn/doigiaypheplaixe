<div class="row px-1">
    @if (session('resp_success'))
        <div class="alert alert-success alert-border-left alert-dismissible fade show hidden_alert" role="alert">
            <i class="ri-check-double-line me-2 align-middle fs-16"></i>
            {{session('resp_success')}}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    @if (session('resp_info'))
        <div class="alert alert-info alert-border-left alert-dismissible fade show mb-xl-3" role="alert">
            <i class="ri-information-line me-2 align-middle fs-16"></i>
            {{session('resp_info')}}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    @if (session('resp_error'))
        <div class="alert alert-danger alert-border-left alert-dismissible fade show mb-xl-3" role="alert">
            <i class="ri-error-warning-line me-2 align-middle fs-16"></i>
            {{session('resp_error')}}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    @if ($errors->any()) 
        <div class="alert alert-warning alert-border-left alert-dismissible fade show" role="alert">
            <i class="ri-alert-line me-2 align-middle fs-16"></i>
            @php $error_validate = []; @endphp
            @foreach ($errors->all() as $error)
                @php $error_validate[] = $error; @endphp
            @endforeach
            {{ implode(", ",$error_validate) }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif
</div>
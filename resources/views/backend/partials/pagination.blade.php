<div class="row pagination_custom">
    <div class="col-sm-12 col-md-1">
        <form method="GET">
            <select name="page_row" class="form-select mt-3 mt-md-0" onchange="this.form.submit()">
                @foreach ([15, 25, 50, 100, 1000000] as $val)
                    <option value="{{ $val }}" {{ request('page_row', 15) == $val ? 'selected' : '' }}>
                        {{ $val == 1000000 ? 'Tất cả' : "$val dòng" }}
                    </option>
                @endforeach
            </select>
            @foreach(request()->except('page_row', 'page') as $key => $value)
                <input type="hidden" name="{{ $key }}" value="{{ $value }}">
            @endforeach
        </form>
    </div>
    <div class="col-sm-12 col-md-11">
        <div class="d-flex justify-content-center justify-content-md-end">
            {{ $results->withQueryString()->links('backend.partials.paginaton-bs5') }}
        </div>
    </div>
</div>
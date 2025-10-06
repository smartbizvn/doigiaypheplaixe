@extends('layouts.backend')

@push('extend_style')
@endpush

@section('title_page', 'Quản lý Menu')

@section('content')
    <div class="page-content">
        <div class="container-fluid">
            @include('backend.common.header_tab_action')
            @include('backend.partials.alert')
            <div class="card table_card mb-3">
                <div class="card-body">
                    <div class="table-responsive table-card table_custom mb-0">
                        <table class="table align-middle nowrap_header_mobile table-bordered table-hover">
                            <thead class="text-muted table-light">
                                <tr class="text-uppercase">
                                    <th class='text-center' width="50">
                                        <div class="form-check text-center">
                                            <input class="form-check-input checkbox_all custom_checkbox" type="checkbox">
                                        </div>
                                    </th>
                                    <th class="text-center" width="60">STT</th>
                                    <th class="text-left sortable" width="300">Tên menu</th>
                                    <th class="text-left sortable" width="300">Menu cha</th>
                                    <th class="text-left">Mô tả</th>
                                    <th class="text-center sortable" width="100">Thứ tự</th>
                                    {{-- Cột chung --}}
                                    @include('backend.common.table_column_common', ['type_column' => 'head'])
                                </tr>
                            </thead>
                            <tbody class="list form-check-all">
                                @if (!empty($results) && $results->count() > 0)
                                    @foreach ($results as $index => $result)
                                        <tr>
                                            <th class='text-center'>
                                                <div class="form-check text-center">
                                                    <input class="form-check-input checkbox_item custom_checkbox" type="checkbox" value="{{$result->id}}">
                                                </div>
                                            </th>
                                            <td class="text-center">
                                                <span class="fw-medium link-primary">
                                                    {{ $index+ 1 }}
                                                </span>
                                            </td>
                                            <td>
                                                <a title='Sửa' href="{{ route('admin.'.$module.'.edit', $result->id) }}">
                                                    {{  cutText($result->name ?? "") }}
                                                </a>
                                            </td>
                                            <td>
                                               {{ $result->parent->breadcrumb ?? "" }}
                                            </td>
                                            <td>
                                                {{  cutText($result->desc ?? "") }}
                                            </td>
                                            <td class="text-center">
                                                {{ $result->order ?? "" }}
                                            </td>
                                            {{-- Cột chung --}}
                                            @include('backend.common.table_column_common', ['type_column' => 'body'])
                                        </tr>
                                    @endforeach
                                @else
                                    @include('backend.common.table_empty')
                                @endif
                            </tbody>
                        </table>
                    </div>
                    @include('backend.partials.pagination',['results' => $results])
                </div>
            </div>
        </div>
    </div>
@endsection

@section('extend_html')
    @include('backend.'.$module.'.modal_search')
@endsection

@push('extend_script')
    
@endpush
@extends('layouts.backend')

@push('extend_style')
@endpush

@section('title_page', 'Quản lý danh mục')

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
                                    <th class="text-center" width="150">Hình ảnh</th>
                                    <th class="text-left sortable" width="300">Tên danh mục</th>
                                    <th class="text-left sortable" width="300">Danh mục cha</th>
                                    <th class="text-left">Hiển thị trang chủ</th>
                                    <th class="text-left">Loại danh mục</th>
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
                                            <td class="text-center">
                                                 <a title='Sửa' href="{{ route('admin.'.$module.'.edit', $result->id) }}">
                                                    <img src="{{ viewImage($result->image)}}" width="150" height="90">
                                                </a>
                                            </td>
                                            <td>
                                                <a target="_blank" href="{{ url($result->slug) }}">
                                                    {{  cutText($result->name ?? "") }}
                                                </a>
                                            </td>
                                            <td>
                                               {{ $result->parent->breadcrumb ?? "" }}
                                            </td>
                                            <td>
                                                {{ $result->show_homepage == true ? "Hiển thị" : "Không hiển thị" }}
                                            </td>
                                            <td>
                                                {{ $result->type_category == 'category' ? "Danh mục" : "Trang" }}
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
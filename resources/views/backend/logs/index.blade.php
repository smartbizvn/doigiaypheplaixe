@extends('layouts.backend')
@section('title_top', 'QUẢN LÝ LOG')
@section('content')
<div class="content-page">
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box">
                        <div class="page-title-right"></div>
                    </div>
                </div>
            </div>  
            @include('backend.partials.alert')
            <div class="row">
                <div class="col-12">
                    <div class="card-box">
                        <form action="">
                            <div class="table-responsive">
                                <table class="table_sort table table-hover table-centered dt-responsive table-bordered mb-0">
                                    <thead class='thead-light'>
                                        <tr>
                                            <th width="50" class='text-center'>
                                                <div class="checkbox checkbox-success checkbox-single">
                                                    <input type="checkbox" id="all_checkbox">
                                                    <label></label>
                                                </div>
                                            </th>
                                            <th width="60" class='text-center sortable'>STT <span class="ts-sort-indicator">▾</span></th>
                                            <th width="150" class='sortable'>Action</th>
                                            <th width="120" class='text-center sortable'>User Action</th>
                                            <th>Object</th>
                                            <th width="150" class='sortable'>Ngày tạo</th>
                                            <th width="110" class='text-center'>Xem Log</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse($result as $key => $data)
                                            <tr>
                                                <td class='text-center'>
                                                    <div class="checkbox checkbox-success checkbox-single">
                                                        <input type="checkbox" class="single_checkbox" value="{{ $data->id}}">
                                                        <label></label>
                                                    </div>
                                                </td>
                                                <td class='text-center'>{{$key+1}}</td>
                                                <td>{{ $data->action ?? '' }}</td>
                                                <td class='text-center'>{{ $data->user_id ?? '' }}</td>
                                                <td>{{ $data->obj_action ?? '' }}</td>
                                                <td>{{ $data->created_at }}</td>
                                                <td class='text-center'>
                                                    <a class='mr-2' title='Sửa' href="{{ route('admin.'.$module.'.edit', $data->id) }}">
                                                        <i class="far fa-eye"></i>
                                                    </a>
                                                </td>
                                            </tr>
                                            @empty
                                            <tr><td class='text-center' colspan="50">KHÔNG TÌM THẤY DỮ LIỆU</td></tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                            @include('backend.partials.pagination')
                        </form>
                    </div>
                </div>
            </div> 
        </div>
    </div>
</div>
@endsection

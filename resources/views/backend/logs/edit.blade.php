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
                <form>
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="card">
                                <div class="card-body">
                                    <h4 class="mb-3 header-title"><i class="far fa-edit mr-1"></i> XEM LOG</h4>
                                    <div class="form-group row mb-3 ">
                                        <label class="col-2 col-form-label">Action</label>
                                        <div class="col-9">
                                            <input class="form-control" type="text" value="{{ $result->action }}">
                                        </div>
                                    </div>
                                    <div class="form-group row mb-3 ">
                                        <label class="col-2 col-form-label">User Action</label>
                                        <div class="col-9">
                                            <input class="form-control" type="text" value="{{ $result->user_id }}">
                                        </div>
                                    </div>
                                    <div class="form-group row mb-3 ">
                                        <label class="col-2 col-form-label">Object</label>
                                        <div class="col-9">
                                            <input class="form-control" type="text" value="{{ $result->obj_action }}">
                                        </div>
                                    </div>
                                    <div class="form-group row mb-3">
                                        <label class="col-2 col-form-label">New Value</label>
                                        <div class="col-9">
                                            <textarea class="form-control" rows="15">
                                                @if (json_decode($result->new_value, true))
                                                @foreach(json_decode($result->new_value, true) as $key => $value) 
                                                {{ $key }} : {{ $value }}, @endforeach  @endif</textarea>
                                        </div>
                                    </div>
                                    <div class="form-group row mb-3">
                                        <label class="col-2 col-form-label">Old Value</label>
                                        <div class="col-9">
                                            <textarea class="form-control" rows="15">
                                                @if (json_decode($result->old_value, true))
                                                @foreach(json_decode($result->old_value, true) as $key => $value) 
                                                {{ $key }} : {{ $value }}, @endforeach @endif</textarea>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
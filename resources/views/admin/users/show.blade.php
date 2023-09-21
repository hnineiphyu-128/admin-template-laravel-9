@extends('layouts.admin')
@section('content')
<div class="row g-0">
    <div class="col-md-8 col-sm-12 col-12 mx-0 mx-sm-0 mx-md-2">
        <div class="card">
            <div class="card-header">
                {{ trans('global.show') }} {{ trans('cruds.user.title') }}
            </div>

            <div class="card-body">
                <div class="form-group my-2">
                    <table class="table table-bordered table-striped">
                        <tbody>
                            <tr>
                                <th>
                                    {{ trans('cruds.user.fields.name') }}
                                </th>
                                <td>
                                    {{ $user->name }}
                                </td>
                            </tr>
                            <tr>
                                <th>
                                    {{ trans('cruds.user.fields.phone') }}
                                </th>
                                <td>
                                    {{ $user->phone }}
                                </td>
                            </tr>
                            <tr>
                                <th>
                                    {{ trans('cruds.user.fields.email') }}
                                </th>
                                <td>
                                    {{ $user->email ?? '-' }}
                                </td>
                            </tr>
                            {{-- <tr>
                                <th>
                                    {{ trans('cruds.user.fields.address') }}
                                </th>
                                <td>
                                    {{ $user->address ?? '-' }}
                                </td>
                            </tr> --}}
                            <tr>
                                <th>
                                    {{ trans('cruds.user.fields.roles') }}
                                </th>
                                <td>
                                    @foreach($user->roles as $key => $roles)
                                        <span class="badge bg-info">{{ $roles->title }}</span>
                                    @endforeach
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-3 col-sm-12 col-12 mx-0 mx-sm-0 mx-md-2">
        <div class="card">
            <div class="card-header">
                {{ trans('global.show') }} {{ trans('cruds.user.fields.profile_image') }}
            </div>

            <div class="card-body">
                <div class="form-group my-2">
                    <table class="table table-bordered table-striped">
                        <tbody>
                            <tr>
                                <th>
                                    {{ trans('cruds.user.fields.profile_image') }}
                                </th>
                            </tr>
                            <tr>
                                <td>
                                    @php
                                        $src = \App\Helpers\common::getImageSrc($user->profile_image);
                                    @endphp
                                    <a href="javascript:void(0)" class="imageModal img-fluid" data-src="{{ $src }}" data-title="Profile Image">
                                        <img src="{{ $src }}" alt="Image" width="150" class="img">
                                    </a>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <div class="col-12 mx-0 mx-sm-0 mx-md-2">
        <div class="form-group my-2">
            <a onclick=history.back() class="btn btn-secondary text-white">
                {{ trans('global.back_to_list') }}
            </a>
        </div>
    </div>
</div>
@include('admin.common.modals.image-preview-admin')
@endsection
@section('scripts')
@include('admin.common.scripts.image-preview-admin')
@endsection

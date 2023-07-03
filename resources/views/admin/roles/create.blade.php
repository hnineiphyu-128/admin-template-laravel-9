@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.create') }} {{ trans('cruds.role.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.roles.store") }}" enctype="multipart/form-data">
            @csrf
            <div class="row">
                <div class="col-xl-4 col-lg-4 col-md-4 col-sm-12 col-12">
                    <div class="form-group my-2">
                        <label class="required" for="title">{{ trans('cruds.role.fields.title') }}</label>
                        <input class="form-control {{ $errors->has('title') ? 'is-invalid' : '' }}" type="text" name="title" id="title" value="{{ old('title', '') }}" required>
                        @if($errors->has('title'))
                            <div class="invalid-feedback">
                                {{ $errors->first('title') }}
                            </div>
                        @endif
                        <span class="help-block">{{ trans('cruds.role.fields.title_helper') }}</span>
                    </div>
                </div>

            </div>
            <div class="row form-group">
                <label class="required my-3" for="permissions">{{ trans('cruds.role.fields.permissions') }}</label>
                @foreach ($permissions as $id => $permission)
                    @php
                        $type_arr = explode('_', $permission);
                        // array_pop($type_arr);
                        $type = ucwords(join(' ', $type_arr));
                    @endphp
                    <div class="col-xl-3 col-lg-3 col-md-3 col-sm-12 col-12 m-2">
                        <div class="form-group my-2">
                            <input type="checkbox" name="permissions[]" id="permission{{ $id }}" value="{{ $id }}">
                            <label class="" for="permission{{ $id }}">{{ $type }}</label>
                            <span class="help-block">{{ trans('cruds.role.fields.permissions_helper') }}</span>
                        </div>
                    </div>
                @endforeach
            </div>
            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                <div class="form-group my-2">
                    <button class="btn btn-success" type="submit">
                        {{ trans('global.save') }}
                    </button>
                    <a onclick=history.back() class="btn btn-secondary text-white">{{ trans('global.cancel') }}</a>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection
@section('scripts')
@endsection
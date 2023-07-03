@extends('layouts.admin')
@section('content')

<div class="card g-0">
    <div class="col-md-12 mb-1">
        <div class="card">
            <div class="card-header">
                {{ trans('global.my_profile') }}
            </div>

            <div class="card-body">
                <form method="POST" action="{{ route("profile.password.updateProfile") }}">
                    @csrf
                    <div class="row">
                        <div class="col-md-6 col-12">
                            <div class="form-group my-2">
                                <label class="required" for="name">{{ trans('cruds.user.fields.name') }}</label>
                                <input class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}" type="text" name="name" id="name" value="{{ old('name', auth()->user()->name) }}" required>
                                @if($errors->has('name'))
                                    <div class="invalid-feedback">
                                        {{ $errors->first('name') }}
                                    </div>
                                @endif
                            </div>
                        </div>
                        <div class="col-md-6 col-12">
                            <div class="form-group my-2">
                                <label class="required" for="title">{{ trans('cruds.user.fields.phone') }}</label>
                                <input class="form-control {{ $errors->has('phone') ? 'is-invalid' : '' }}" type="text" name="phone" id="phone" value="{{ old('phone', auth()->user()->phone) }}" required>
                                @if($errors->has('phone'))
                                    <div class="invalid-feedback">
                                        {{ $errors->first('phone') }}
                                    </div>
                                @endif
                            </div>
                        </div>
                        <div class="col-md-12 col-12">
                            <div class="form-group my-2">
                                <button class="btn btn-success" type="submit">
                                    {{ trans('global.save') }}
                                </button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="col-md-12 mt-1">
        <div class="card">
            <div class="card-header">
                {{ trans('global.change_password') }}
            </div>

            <div class="card-body">
                <form method="POST" action="{{ route("profile.password.update") }}">
                    @csrf
                    <div class="row">
                        <div class="col-md-6 col-12">
                            <div class="form-group my-2">
                                <label class="required" for="title">New {{ trans('cruds.user.fields.password') }}</label>
                                <input class="form-control {{ $errors->has('password') ? 'is-invalid' : '' }}" type="password" name="password" id="password" required>
                                @if($errors->has('password'))
                                    <div class="invalid-feedback">
                                        {{ $errors->first('password') }}
                                    </div>
                                @endif
                            </div>
                        </div>
                        <div class="col-md-6 col-12">
                            <div class="form-group my-2">
                                <label class="required" for="title">Repeat New {{ trans('cruds.user.fields.password') }}</label>
                                <input class="form-control" type="password" name="password_confirmation" id="password_confirmation" required>
                            </div>
                        </div>
                        <div class="col-md-12 col-12">
                            <div class="form-group my-2">
                                <button class="btn btn-success" type="submit">
                                    {{ trans('global.save') }}
                                </button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
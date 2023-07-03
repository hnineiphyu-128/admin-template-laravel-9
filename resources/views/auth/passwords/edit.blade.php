@extends('layouts.admin')
@section('content')

<div class="card g-0">
    <div class="col-md-12 mb-1">
        <div class="card">
            <div class="card-header">
                <h5>{{ trans('global.my_profile') }} ( {{ auth()->user()->roles[0]->title ?? '' }} )</h5>
            </div>

            <div class="card-body">
                <div class="row  m-1">
                    @if (count($users) > 0)
                        <span>Who are same departments....</span>
                    @else
                        <span>There is no staff in these department except you.</span>
                    @endif
                    @foreach ($users as $key => $user)
                        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 m-2">
                            {{ ++$key }}. <span>{{ $user->name ?? '' }} ( {{ $user->phone }} )</span>
                        </div>
                    @endforeach
                </div>

                <div class="row">
                    <h5 class="required my-3" for="permissions">{{ trans('cruds.role.fields.permissions') }}</h5>
                    @foreach ($permissions as $key => $permission)
                        @php
                            $type_arr = explode('_', $permission->title);
                            // array_pop($type_arr);
                            $id = $permission->id;
                            $type = ucwords(join(' ', $type_arr));
                        @endphp
                        <div class="col-xl-2 col-lg-2 col-md-2 col-sm-12 col-12 m-2">
                            <div class="text-nowrap">
                                <label class="text-nowarp" for="permission{{ $id }}">{{ $type }}</label>
                            </div>
                        </div>
                    @endforeach
                    @if (count($permissions) == 0)
                        <span>There is no permission for your department.</span>
                    @endif
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-12 mb-1">
        <div class="card">
            <div class="card-header">
                {{ trans('global.change_infomation') }}
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

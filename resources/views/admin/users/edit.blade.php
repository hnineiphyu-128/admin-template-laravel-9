@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.edit') }} {{ trans('cruds.user.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.users.update", [$user->id]) }}" enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <div class="row">
                <div class="col-xl-4 col-lg-4 col-md-4 col-sm-12 col-12">
                    <div class="form-group my-2">
                        <label class="required" for="name">{{ trans('cruds.user.fields.name') }}</label>
                        <input class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}" type="text" name="name" id="name" value="{{ old('name', $user->name) }}" required>
                        @if($errors->has('name'))
                            <div class="invalid-feedback">
                                {{ $errors->first('name') }}
                            </div>
                        @endif
                        <span class="help-block">{{ trans('cruds.user.fields.name_helper') }}</span>
                    </div>
                </div>
                <div class="col-xl-4 col-lg-4 col-md-4 col-sm-12 col-12">
                    <div class="form-group my-2">
                        <label for="phone">{{ trans('cruds.user.fields.phone') }}</label>
                        <input class="form-control {{ $errors->has('phone') ? 'is-invalid' : '' }}" type="text" name="phone" id="phone" value="{{ old('phone', $user->phone) }}">
                        @if($errors->has('phone'))
                            <div class="invalid-feedback">
                                {{ $errors->first('phone') }}
                            </div>
                        @endif
                        <span class="help-block">{{ trans('cruds.user.fields.phone_helper') }}</span>
                    </div>
                </div>
                {{-- <div class="col-xl-4 col-lg-4 col-md-4 col-sm-12 col-12">
                    <div class="form-group my-2">
                        <label class="required" for="email">{{ trans('cruds.user.fields.email') }}</label>
                        <input class="form-control {{ $errors->has('email') ? 'is-invalid' : '' }}" type="email" name="email" id="email" value="{{ old('email', $user->email) }}" required>
                        @if($errors->has('email'))
                            <div class="invalid-feedback">
                                {{ $errors->first('email') }}
                            </div>
                        @endif
                        <span class="help-block">{{ trans('cruds.user.fields.email_helper') }}</span>
                    </div>
                </div> --}}
                <div class="col-xl-4 col-lg-4 col-md-4 col-sm-12 col-12">
                    <div class="form-group my-2">
                        <label class="required" for="password">{{ trans('cruds.user.fields.password') }}</label>
                        <input class="form-control {{ $errors->has('password') ? 'is-invalid' : '' }}" type="password" name="password" id="password">
                        @if($errors->has('password'))
                            <div class="invalid-feedback">
                                {{ $errors->first('password') }}
                            </div>
                        @endif
                        <span class="help-block">{{ trans('cruds.user.fields.password_helper') }}</span>
                    </div>
                </div>
                {{-- role column --}}
                <div class="col-12 mt-3">
                    <div class="form-group mx-2mt-3">
                        <label class="mb-3">{{ trans('cruds.user.fields.roles') }}</label>
                        <div class="row">
                            @foreach ($roles as $role)
                                <div class="col-md-4 col-6 mb-2">
                                    <div class="form-check">
                                        <input type="checkbox" name="roles[]" id="{{ $role->title }}"  value="{{ $role->id }}"class="form-check-input"
                                        @if (\App\Helpers\helper::hasRole($role->id, $user->roles))
                                            checked
                                        @endif
                                        onclick="filterParent({{ $role->id }})">
                                        <label for="{{ $role->title }}" class="form-check-label"><span style="font-size: 0.9rem; font-weight:bold">{{ $role->title }}</span>
                                        </label>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                    <div class="form-group my-2">
                        <button class="btn btn-success" type="submit">
                            {{ trans('global.save') }}
                        </button>
                        <a onclick=history.back() class="btn btn-secondary text-white">{{ trans('global.cancel') }}</a>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>



@endsection

@section('scripts')
@parent
<script>
    function toggleParent() {
        if($('#app_id').val()) {
            $('#parent_id').attr('disabled', false);
        } else {
            $('#parent_id').attr('disabled', true);
        }
    }
    function filterParent(role_id) {
        if (role_id == 1 || role_id == 2) {
            $('#app_id').attr('disabled', true);
            reset();
        } else {
            $('#app_id').attr('disabled', false);
        }
        var app_id = $('#app_id').val() ?? null;
        $.ajax({
            type: "get",
            url: "/admin/users/getparentusersbyroleid?role_id=" + role_id + "&app_id=" + app_id,
            success: function(res) {
                var parents = res;
                if (parents) {
                    var text = '';
                    var i = 1;
                    $('#parent_id option').remove();
                    let html = `<option value=""> {{ trans('global.pleaseSelect') }} </option>`;
                    parents.forEach((item,i)=>{

                        html += `
                                    <option value="${item.id}"> ${item.name} </option>
                                `;
                    })
                    $('#parent_id').append(html);
                } else {
                    $('#app_id').attr('disabled', true);
                    reset();
                }
            }
        });

        function reset(){
            $('#parent_id').attr('disabled', true);
            $('#parent_id').val('');
            $('#parent_id').html(`<option value=""> {{ trans('global.pleaseSelect') }} </option>`);
            $('#app_id').val('');
        }
    }
</script>
@endsection

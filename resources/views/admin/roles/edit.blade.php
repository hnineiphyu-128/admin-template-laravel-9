@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.edit') }} {{ trans('cruds.role.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.roles.update", [$role->id]) }}" enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <div class="row">
                <div class="col-xl-4 col-lg-4 col-md-4 col-sm-12 col-12">
                    <div class="form-group my-2">
                        <label class="required" for="title">{{ trans('cruds.role.fields.title') }}</label>
                        <input class="form-control {{ $errors->has('title') ? 'is-invalid' : '' }}" type="text" name="title" id="title" value="{{ old('title', $role->title) }}" required>
                        @if($errors->has('title'))
                            <div class="invalid-feedback">
                                {{ $errors->first('title') }}
                            </div>
                        @endif
                        <span class="help-block">{{ trans('cruds.role.fields.title_helper') }}</span>
                    </div>
                </div>
            </div>

            <div class="row form-group my-4">
                <div class="d-flex justify-content-start">
                    <label class="required my-3 me-3" for="permissions">{{ trans('cruds.role.fields.permissions') }}</label>
                    <div class="form-group my-2">
                        <div class="form-group my-2">
                            <input class="select_all" type="checkbox" name="select_all" id="select_all">
                            <label class="" for="select_all">{{ trans('global.select_all') }}</label>
                        </div>
                    </div>
                </div>
                @foreach ($permissions as $title => $permissions_array)
                    @foreach ($permissions_array as $key => $permission)
                        @php
                            $type_arr = explode('_', $permission->title);
                            // array_pop($type_arr);
                            $type = ucwords(join(' ', $type_arr));
                        @endphp
                        <div class="col-xl-3 col-lg-3 col-md-3 col-sm-12 col-12 my-1">
                            <div class="form-group my-2">
                                <input class="cursor-pointer permissions" type="checkbox" name="permissions[]" id="permission{{ $permission->id }}" value="{{ $permission->id }}"
                                {{ (in_array($permission->id, old('permissions', [])) || $role->permissions->contains($permission->id)) ? 'checked' : '' }}
                                onclick="clickPermission({{ $permission->id }})">
                                <label class="cursor-pointer" for="permission{{ $permission->id }}">{{ $type }}</label>
                                <span class="help-block">{{ trans('cruds.role.fields.permissions_helper') }}</span>
                            </div>
                        </div>
                    @endforeach
                    <div class="col-12"><hr style="border: 1px solid #11111123;"></div>
                @endforeach
            </div>
            {{-- <div class="row">
                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                    <div class="form-group my-2">
                        <label class="required" for="permissions">{{ trans('cruds.role.fields.permissions') }}</label>
                        <select class="form-control select2 {{ $errors->has('permissions') ? 'is-invalid' : '' }}" name="permissions[]" id="permissions" multiple required>
                            @foreach($permissions as $id => $permission)
                                <option value="{{ $id }}" {{ (in_array($id, old('permissions', [])) || $role->permissions->contains($id)) ? 'selected' : '' }}>{{ $permission }}</option>
                            @endforeach
                        </select>
                        @if($errors->has('permissions'))
                            <div class="invalid-feedback">
                                {{ $errors->first('permissions') }}
                            </div>
                        @endif
                        <span class="help-block">{{ trans('cruds.role.fields.permissions_helper') }}</span>
                    </div>
                </div>
            </div> --}}
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
<script>
    const checkAllCheckbox = $('.select_all');
    const otherCheckboxes = $('.permissions');
    let checkboxStates=[];
    otherCheckboxes.each(function(){
        checkboxStates.push(this.checked);
    });

    checkAllCheckbox.prop('checked', checkboxStates.every(Boolean));

    checkAllCheckbox.on('click',function(){
        otherCheckboxes.prop('checked',this.checked);
        checkboxStates=otherCheckboxes.map(function(){
            return this.checked;
        }).get();
    });
    otherCheckboxes.on('click', function () {
        checkboxStates = otherCheckboxes.map(function () {
            return this.checked;
        }).get();
        checkAllCheckbox.prop('checked', checkboxStates.every(Boolean));
    });
</script>
@endsection


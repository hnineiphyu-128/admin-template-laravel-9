@extends('layouts.admin')
@section('styles')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.4.0/min/dropzone.min.css">

<style>
    .dz-image img{
        width: 120px !important;
        height: 120px !important;
    }
    /* sweet alert */
    .swal-button--confirm,
    .swal-button--confirm:hover{
        background-color: #FF0000 !important;
    }
</style>
@endsection
@section('content')
    @include('admin.common.success-message')
    @include('admin.common.error-message')
    <div class="row g-0">
        {{-- profile image --}}
        <div class="col-md-5 col-sm-12 col-12 my-2 mx-0 mx-sm-0 mx-md-2">
            <div class="card">
                <div class="card-header">
                    {{ trans('global.change_infomation') }}
                </div>

                <div class="card-body">
                    <form method="POST" action="{{ route('profile.password.updateProfileImage') }}">
                        @csrf
                        <div class="row">
                            <div class="col-md-12 col-12">
                                <div class="form-group my-2">
                                    <label class="required" for="profile_image">{{ trans('cruds.user.fields.profile_image') }}</label>
                                    <div class="needsclick dropzone {{ $errors->has('profile_image') ? 'is-invalid' : '' }}" id="profileImageDropzone">
                                    </div>
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
        {{-- profile information --}}
        <div class="col-md-6 col-sm-12 col-12 my-2 mx-0 mx-sm-0 mx-md-2">
            <div class="card">
                <div class="card-header">
                    {{ trans('global.change_infomation') }}
                </div>

                <div class="card-body">
                    <form method="POST" action="{{ route('profile.password.updateProfile') }}">
                        @csrf
                        <div class="row">
                            <div class="col-md-12 col-12">
                                <div class="form-group my-2">
                                    <label class="required" for="name">{{ trans('cruds.user.fields.name') }}</label>
                                    <input class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}"
                                        type="text" name="name" id="name"
                                        value="{{ old('name', auth()->user()->name) }}" required>
                                    @if ($errors->has('name'))
                                        <div class="invalid-feedback">
                                            {{ $errors->first('name') }}
                                        </div>
                                    @endif
                                </div>
                            </div>
                            <div class="col-md-12 col-12">
                                <div class="form-group my-2">
                                    <label class="required" for="title">{{ trans('cruds.user.fields.phone') }}</label>
                                    <input class="form-control {{ $errors->has('phone') ? 'is-invalid' : '' }}"
                                        type="text" name="phone" id="phone"
                                        value="{{ old('phone', auth()->user()->phone) }}" required>
                                    @if ($errors->has('phone'))
                                        <div class="invalid-feedback">
                                            {{ $errors->first('phone') }}
                                        </div>
                                    @endif
                                </div>
                            </div>
                            <div class="col-md-12 col-12">
                                <div class="form-group my-2">
                                    <label class="" for="title">{{ trans('cruds.user.fields.email') }}</label>
                                    <input class="form-control {{ $errors->has('email') ? 'is-invalid' : '' }}"
                                        type="text" name="email" id="email"
                                        value="{{ old('email', auth()->user()->email) }}">
                                    @if ($errors->has('email'))
                                        <div class="invalid-feedback">
                                            {{ $errors->first('email') }}
                                        </div>
                                    @endif
                                </div>
                            </div>
                            {{-- <div class="col-md-12 col-12">
                                <div class="form-group my-2">
                                    <label class="" for="address">{{ trans('cruds.user.fields.address') }}</label>
                                        <textarea class="form-control {{ $errors->has('address') ? 'is-invalid' : '' }}" name="address" id="address" cols="30" rows="2">{{ old('address', auth()->user()->address) }}</textarea>
                                    @if ($errors->has('address'))
                                        <div class="invalid-feedback">
                                            {{ $errors->first('address') }}
                                        </div>
                                    @endif
                                </div>
                            </div> --}}
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
        {{-- change password --}}
        <div class="col-md-12 col-sm-12 col-12 my-2">
            <div class="card">
                <div class="card-header">
                    {{ trans('global.change_password') }}
                </div>

                <div class="card-body">
                    <form method="POST" action="{{ route('profile.password.update') }}">
                        @csrf
                        <div class="row">
                            <div class="col-md-6 col-12">
                                <div class="form-group my-2">
                                    <label class="required" for="title">New
                                        {{ trans('cruds.user.fields.password') }}</label>
                                    <input class="form-control {{ $errors->has('password') ? 'is-invalid' : '' }}"
                                        type="password" name="password" id="password" required>
                                    @if ($errors->has('password'))
                                        <div class="invalid-feedback">
                                            {{ $errors->first('password') }}
                                        </div>
                                    @endif
                                </div>
                            </div>
                            <div class="col-md-6 col-12">
                                <div class="form-group my-2">
                                    <label class="required" for="title">Repeat New
                                        {{ trans('cruds.user.fields.password') }}</label>
                                    <input class="form-control" type="password" name="password_confirmation"
                                        id="password_confirmation" required>
                                </div>
                            </div>
                            <div class="col-md-6 col-12">
                                <div class="form-group my-2">
                                    <label class="required" for="old_password">Old
                                        {{ trans('cruds.user.fields.password') }}</label>
                                    <input class="form-control {{ $errors->has('old_password') ? 'is-invalid' : '' }}"
                                        type="password" name="old_password" id="old_password">
                                    @if ($errors->has('old_password'))
                                        <div class="invalid-feedback">
                                            {{ $errors->first('old_password') }}
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
        {{-- permission lists --}}
        <div class="col-md-12 col-sm-12 col-12 my-2">
            @if (session()->has('error'))
                <div class="col-md-12">
                    <div class="alert alert-danger my-3 alert-dismissible fade show" role="alert">
                        <h6 class="alert-heading fw-bold mb-1">{{ session()->get('error') }}</h6>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                </div>
            @endif
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
                                {{ ++$key }}. <span>{{ $user->name ?? '' }} ( {{ $user->email }} )</span>
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
                                    <label class="text-nowarp"
                                        for="permission{{ $id }}">{{ $type }}</label>
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
    </div>
@endsection
@section('scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.4.0/dropzone.js"></script>
<script>
    // profile image
    profileImageDocumentMap = [];
    var profileImageDropzone = new Dropzone("#profileImageDropzone", {
        url: '{{ route('admin.users.storeMedia') }}',
        maxFilesize: 2, // MB
        addRemoveLinks: true,
        maxFiles: 1,
        headers: {
        'X-CSRF-TOKEN': "{{ csrf_token() }}"
        },
        success: function (file, response) {
            $('form').append('<input type="hidden" name="profile_image" value="' + response.name + '">')
            profileImageDocumentMap[file.name] = response.name
        },
        removedfile: function (file) {
            swal({
                title: "Are you sure you want to remove this image?",
                text: "If you remove this, it will be delete from data.",
                icon: "warning",
                type: "warning",
                buttons: ["Cancel","Remove!"],
                confirmButtonColor: '#FF0000',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
            }).then((willDelete) => {
                if (willDelete) {
                    file.previewElement.remove()
                    var name = ''
                    if (typeof file.file_name !== 'undefined') {
                        name = file.file_name
                    } else {
                        name = profileImageDocumentMap[file.name]
                    }
                    $('form').find('input[name="profile_image"][value="' + name + '"]').remove()
                    removeMedia(file.name, 'profile_image')
                }
            });
        },
        init: function () {
        }

    });
    // Loop through imagePaths and add images to Dropzone
    var imagePath = {!! json_encode(\App\Helpers\common::getImageSrc(auth()->user()->profile_image)) !!};
    if (imagePath) {
        var imageName = {!! json_encode(\App\Models\User::getImageName(auth()->user()->profile_image)) !!};
        var mockFile = { name: imageName, size: 5, accepted: true };
        profileImageDropzone.emit("addedfile", mockFile);
        profileImageDropzone.emit("thumbnail", mockFile, imagePath);
        profileImageDropzone.emit("complete", mockFile);
    }

    function removeMedia(file_name, type) {
        $.ajax({
            type: 'POST',
            url: '{{ route('admin.users.removeMedia') }}',
            data: {'file_name' : file_name, 'type' : type, 'model_id': {!! auth()->user()->id !!} },
            headers: {
                'X-CSRF-TOKEN': "{{ csrf_token() }}"
            },
            success: function (data) {
                console.log(data);
            },
            error: function (data) {
                console.log(data);
            }
        });
    }
</script>
@endsection

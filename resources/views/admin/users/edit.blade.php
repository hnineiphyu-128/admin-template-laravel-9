@extends('layouts.admin')
@section('styles')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.4.0/min/dropzone.min.css">

    <style>
        .dz-image img {
            width: 120px !important;
            height: 120px !important;
        }

        /* sweet alert */
        .swal-button--confirm,
        .swal-button--confirm:hover {
            background-color: #FF0000 !important;
        }
    </style>
@endsection
@section('content')
    <div class="card">
        <div class="card-header">
            {{ trans('global.edit') }} {{ trans('cruds.user.title_singular') }}
        </div>

        <div class="card-body">
            <form method="POST" action="{{ route('admin.users.update', [$user->id]) }}" enctype="multipart/form-data">
                @method('PUT')
                @csrf
                <div class="row">
                    <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12 col-12">
                        <div class="row">
                            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                                <div class="form-group my-2">
                                    <label class="required" for="name">{{ trans('cruds.user.fields.name') }}</label>
                                    <input class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}"
                                        type="text" name="name" id="name" value="{{ old('name', $user->name) }}"
                                        required>
                                    @if ($errors->has('name'))
                                        <div class="invalid-feedback">
                                            {{ $errors->first('name') }}
                                        </div>
                                    @endif
                                    <span class="help-block">{{ trans('cruds.user.fields.name_helper') }}</span>
                                </div>
                            </div>
                            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                                <div class="form-group my-2">
                                    <label class="required" for="email">{{ trans('cruds.user.fields.email') }}</label>
                                    <input class="form-control {{ $errors->has('email') ? 'is-invalid' : '' }}"
                                        type="email" name="email" id="email"
                                        value="{{ old('email', $user->email) }}" required>
                                    @if ($errors->has('email'))
                                        <div class="invalid-feedback">
                                            {{ $errors->first('email') }}
                                        </div>
                                    @endif
                                    <span class="help-block">{{ trans('cruds.user.fields.email_helper') }}</span>
                                </div>
                            </div>
                            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                                <div class="form-group my-2">
                                    <label class="" for="phone">{{ trans('cruds.user.fields.phone') }}</label>
                                    <input class="form-control {{ $errors->has('phone') ? 'is-invalid' : '' }}"
                                        type="text" name="phone" id="phone"
                                        value="{{ old('phone', $user->phone) }}" >
                                    @if ($errors->has('phone'))
                                        <div class="invalid-feedback">
                                            {{ $errors->first('phone') }}
                                        </div>
                                    @endif
                                    <span class="help-block">{{ trans('cruds.user.fields.phone_helper') }}</span>
                                </div>
                            </div>
                            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                                <div class="form-group my-2">
                                    <label class="required"
                                        for="password">{{ trans('cruds.user.fields.password') }}</label>
                                    <input class="form-control {{ $errors->has('password') ? 'is-invalid' : '' }}"
                                        type="password" name="password" id="password">
                                    @if ($errors->has('password'))
                                        <div class="invalid-feedback">
                                            {{ $errors->first('password') }}
                                        </div>
                                    @endif
                                    <small
                                        class="help-block password-error text-danger @if ($errors->has('password')) d-none @endif"
                                        style="font-size: 85%;"></small>
                                    <span class="help-block">{{ trans('cruds.user.fields.password_helper') }}</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12 col-12">
                        <div class="row">
                            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                                <div class="form-group my-2">
                                    <label class=""
                                        for="profile_image">{{ trans('cruds.user.fields.profile_image') }}</label>
                                    <div class="needsclick dropzone {{ $errors->has('profile_image') ? 'is-invalid' : '' }}"
                                        id="profileImageDropzone">
                                    </div>
                                </div>
                            </div>
                            {{-- <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                                <div class="form-group my-2">
                                    <label class="" for="address">{{ trans('cruds.user.fields.address') }}</label>
                                    <textarea class="form-control {{ $errors->has('address') ? 'is-invalid' : '' }}" name="address" id="address"
                                        cols="30" rows="2">{{ old('address', $user->address) }}</textarea>
                                    @if ($errors->has('address'))
                                        <div class="invalid-feedback">
                                            {{ $errors->first('address') }}
                                        </div>
                                    @endif
                                </div>
                            </div> --}}
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
                                            <input type="checkbox" name="roles[]" id="{{ $role->title }}"
                                                value="{{ $role->id }}"class="form-check-input roles-{{ $role->id }}"
                                                @if (\App\Helpers\helper::hasRole($role->id, $user->roles)) checked @endif>
                                            <label for="{{ $role->title }}" class="form-check-label"><span
                                                    style="font-size: 0.9rem; font-weight:bold">{{ $role->title }}</span>
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
    <script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.4.0/dropzone.js"></script>
    <script>
        $('#password').on('keyup', function() {
            console.log($(this).val().length);
            if ($(this).val().length < 6) {
                $('.password-error').html('The password must be minimum 6 length!');
            } else {
                $('.password-error').html('');
            }
            if ($(this).val() == '') {
                $('.password-error').html('');
            }
        })

        // readonly cus admin user must has Admin role
        var user_id = {!! $user->id !!};
        if (user_id == 1 || user_id == 2) {
            $(`.roles-${user_id}`).on('click', function(e) {
                e.preventDefault(); // Prevent the default click behavior
            });
        }

        // profile image
        profileImageDocumentMap = [];
        var profileImageDropzone = new Dropzone("#profileImageDropzone", {
            url: '{{ route('admin.users.storeMedia') }}',
            maxFilesize: 2, // MB
            addRemoveLinks: true,
            headers: {
            'X-CSRF-TOKEN': "{{ csrf_token() }}"
            },
            success: function (file, response) {
                $(file.previewElement).find('.dz-error-message').text('You cannot upload any more files');
                for (let i = 0; i < profileImageDropzone.files.length; i++) {
                    const file = profileImageDropzone.files[i];
                    if (i >= 1) {
                        file.previewElement.classList.add('dz-error');
                    }
                }
                $('form').append('<input type="hidden" name="profile_image" value="' + response.name + '">')
                profileImageDocumentMap[file.name] = response.name
            },
            removedfile: function (file) {
                $(file.previewElement).find('.dz-error-message').text('You cannot upload any more files');
                for (let i = 0; i < profileImageDropzone.files.length; i++) {
                    const file = profileImageDropzone.files[i];
                    if (i >= 5) {
                        file.previewElement.classList.add('dz-error');
                    }
                }
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
        var imagePath = {!! json_encode(\App\Helpers\common::getImageSrc($user->profile_image)) !!};
        if (imagePath) {
            var imageName = {!! json_encode(\App\Models\User::getImageName($user->profile_image)) !!};
            var mockFile = {
                name: imageName,
                size: 5,
                accepted: true
            };
            profileImageDropzone.emit("addedfile", mockFile);
            profileImageDropzone.emit("thumbnail", mockFile, imagePath);
            profileImageDropzone.emit("complete", mockFile);
            profileImageDropzone.files.push(mockFile);
        }


        function removeMedia(file_name, type) {
            $.ajax({
                type: 'POST',
                url: '{{ route('admin.products.removeMedia') }}',
                data: {'file_name' : file_name, 'type' : type, 'product_id': {!! $product->id !!} },
                headers: {
                    'X-CSRF-TOKEN': "{{ csrf_token() }}"
                },
                success: function (data) {
                    var allPreviews = document.querySelectorAll(".dz-preview");
                    allPreviews.forEach(function(previewElement) {
                        previewElement.classList.remove("dz-error");
                    });
                },
                error: function (data) {
                    console.log(data);
                }
            });
        }
    </script>
@endsection

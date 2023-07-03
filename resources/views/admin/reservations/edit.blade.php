@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.edit') }} {{ trans('cruds.reservation.title_form') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.reservations.update", [$reservation->id]) }}" enctype="multipart/form-data" id="reservationForm">
            @method('PUT')
            @csrf
            <fieldset>
                <legend>{{ trans('cruds.reservation.fields.reservation_details') }}</legend>
                <div class="row">
                    <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
                        <div class="form-group my-2">
                            <label class="required" for="first_name">{{ trans('cruds.reservation.fields.first_name') }}</label> <span id="required">*</span>
                            <input class="form-control {{ $errors->has('first_name') ? 'is-invalid' : '' }}" type="text" name="first_name" id="first_name" value="{{ old('first_name', $reservation->first_name) }}" required>
                            <span class="first_name_err text-danger"></span>
                            @if($errors->has('first_name'))
                                <div class="text-danger">
                                    {{ $errors->first('first_name') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.reservation.fields.first_name_helper') }}</span>
                        </div>
                    </div>
                    <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
                        <div class="form-group my-2">
                            <label class="required" for="last_name">{{ trans('cruds.reservation.fields.last_name') }}</label> <span id="required">*</span>
                            <input class="form-control {{ $errors->has('last_name') ? 'is-invalid' : '' }}" type="text" name="last_name" id="last_name" value="{{ old('last_name', $reservation->last_name) }}" required>
                            <span class="last_name_err text-danger"></span>
                            @if($errors->has('last_name'))
                                <div class="text-danger">
                                    {{ $errors->first('last_name') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.reservation.fields.last_name_helper') }}</span>
                        </div>
                    </div>
                    <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
                        <div class="form-group my-2">
                            <label class="required" for="address">{{ trans('cruds.reservation.fields.address') }}</label> <span id="required">*</span>
                            <input class="form-control {{ $errors->has('address') ? 'is-invalid' : '' }}" type="text" name="address" id="address" value="{{ old('address', $reservation->address) }}" required>
                            <span class="address_err text-danger"></span>
                            @if($errors->has('address'))
                                <div class="text-danger">
                                    {{ $errors->first('address') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.reservation.fields.address_helper') }}</span>
                        </div>
                    </div>
                    <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
                        <div class="form-group my-2">
                            <label class="required" for="zip_code">{{ trans('cruds.reservation.fields.zip_code') }}</label> <span id="required">*</span>
                            <input class="form-control {{ $errors->has('zip_code') ? 'is-invalid' : '' }}" type="text" name="zip_code" id="zip_code" value="{{ old('zip_code', $reservation->zip_code) }}" required>
                            <span class="zip_code_err text-danger"></span>
                            @if($errors->has('zip_code'))
                                <div class="text-danger">
                                    {{ $errors->first('zip_code') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.reservation.fields.zip_code_helper') }}</span>
                        </div>
                    </div>
                    <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
                        <div class="form-group my-2">
                            <label class="required" for="city">{{ trans('cruds.reservation.fields.city') }}</label> <span id="required">*</span>
                            <input class="form-control {{ $errors->has('city') ? 'is-invalid' : '' }}" type="text" name="city" id="city" value="{{ old('city', $reservation->city) }}" required>
                            <span class="city_err text-danger"></span>
                            @if($errors->has('city'))
                                <div class="text-danger">
                                    {{ $errors->first('city') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.reservation.fields.city_helper') }}</span>
                        </div>
                    </div>
                    <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
                        <div class="form-group my-2">
                            <label class="required" for="state">{{ trans('cruds.reservation.fields.state') }}</label> <span id="required">*</span>
                            <input class="form-control {{ $errors->has('state') ? 'is-invalid' : '' }}" type="text" name="state" id="state" value="{{ old('state', $reservation->state) }}" required>
                            <span class="state_err text-danger"></span>
                            @if($errors->has('state'))
                                <div class="text-danger">
                                    {{ $errors->first('state') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.reservation.fields.state_helper') }}</span>
                        </div>
                    </div>
                    <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
                        <div class="form-group my-2">
                            <label class="required" for="email">{{ trans('cruds.reservation.fields.email') }}</label> <span id="required">*</span>
                            <input class="form-control {{ $errors->has('email') ? 'is-invalid' : '' }}" type="text" name="email" id="email" value="{{ old('email', $reservation->email) }}" required>
                            <span class="email_err text-danger"></span>
                            @if($errors->has('email'))
                                <div class="text-danger">
                                    {{ $errors->first('email') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.reservation.fields.email_helper') }}</span>
                        </div>
                    </div>
                    <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
                        <div class="form-group my-2">
                            <label class="required" for="phone">{{ trans('cruds.reservation.fields.phone') }}</label> <span id="required">*</span>
                            <input class="form-control {{ $errors->has('phone') ? 'is-invalid' : '' }}" type="text" name="phone" id="phone" value="{{ old('phone', $reservation->phone) }}" required>
                            <span class="phone_err text-danger"></span>
                            @if($errors->has('phone'))
                                <div class="text-danger">
                                    {{ $errors->first('phone') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.reservation.fields.phone_helper') }}</span>
                        </div>
                    </div>
                </div>
            </fieldset>
            <fieldset>
                <legend>{{ trans('cruds.reservation.fields.date') }}</legend>
                <div class="row">
                    <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
                        <div class="form-group my-2">
                            <label class="" for="check_in_date">{{ trans('cruds.reservation.fields.check_in_date') }}</label> <span id="required">*</span>
                            <input class="form-control {{ $errors->has('check_in_date') ? 'is-invalid' : '' }}" type="date" name="check_in_date" id="check_in_date" value="{{ \Carbon\Carbon::parse($reservation->check_in_date)->format('Y-m-d') }}">
                            <span class="check_in_date_err text-danger"></span>
                            @if($errors->has('check_in_date'))
                                <div class="text-danger">
                                    {{ $errors->first('check_in_date') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.reservation.fields.check_in_date_helper') }}</span>
                        </div>
                    </div>
                    <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
                        <div class="form-group my-2">
                            <label class="" for="check_out_date">{{ trans('cruds.reservation.fields.check_out_date') }}</label> <span id="required">*</span>
                            <input class="form-control {{ $errors->has('check_out_date') ? 'is-invalid' : '' }}" type="date" name="check_out_date" id="check_out_date" value="{{ \Carbon\Carbon::parse($reservation->check_out_date)->format('Y-m-d') }}">
                            <span class="check_out_date_err text-danger"></span>
                            @if($errors->has('check_out_date'))
                                <div class="text-danger">
                                    {{ $errors->first('check_out_date') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.reservation.fields.check_out_date_helper') }}</span>
                        </div>
                    </div>
                    <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
                        <div class="form-group my-2">
                            <label for="check_in_time">{{ trans('cruds.reservation.fields.check_in_time') }}</label>
                            <select class="form-control select2 {{ $errors->has('check_in_time') ? 'is-invalid' : '' }}"
                                name="check_in_time" id="check_in_time"  >
                                <option value>
                                    {{ trans('global.pleaseSelect') }}</option>
                                @foreach (App\Models\Reservation::TIME as $key => $label)
                                    <option value="{{ $key }}"
                                        {{ old('check_in_time', $reservation->check_in_time) === (string) $key ? 'selected' : '' }}>{{ $label }}
                                    </option>
                                @endforeach
                            </select>
                            @if ($errors->has('check_in_time'))
                                <div class="text-danger">
                                    {{ $errors->first('check_in_time') }}
                                </div>
                            @endif
                            <span
                                class="help-block check_in_time_error">{{ trans('cruds.reservation.fields.check_in_time_helper') }}</span>
                        </div>
                    </div>
                    <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
                        <div class="form-group my-2">
                            <label for="check_out_time">{{ trans('cruds.reservation.fields.check_out_time') }}</label>
                            <select class="form-control select2 {{ $errors->has('check_out_time') ? 'is-invalid' : '' }}"
                                name="check_out_time" id="check_out_time"  >
                                <option value>
                                    {{ trans('global.pleaseSelect') }}</option>
                                @foreach (App\Models\Reservation::TIME as $key => $label)
                                    <option value="{{ $key }}"
                                        {{ old('check_out_time', $reservation->check_out_time) === (string) $key ? 'selected' : '' }}>{{ $label }}
                                    </option>
                                @endforeach
                            </select>
                            @if ($errors->has('check_out_time'))
                                <div class="text-danger">
                                    {{ $errors->first('check_out_time') }}
                                </div>
                            @endif
                            <span
                                class="help-block check_out_time_error">{{ trans('cruds.reservation.fields.check_out_time_helper') }}</span>
                        </div>
                    </div>
                    <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
                        <div class="form-group my-2">
                            <label for="no_of_adults">{{ trans('cruds.reservation.fields.howmanyadults') }}</label>
                            <select class="form-control select2 {{ $errors->has('no_of_adults') ? 'is-invalid' : '' }}"
                                name="no_of_adults" id="no_of_adults"  >
                                <option value>
                                    {{ trans('cruds.reservation.fields.no_of_adults') }}</option>
                                    <option value="1"
                                        {{ old('no_of_adults', $reservation->no_of_adults) === 1 ? 'selected' : '' }}> 1
                                    </option>
                                    <option value="2"
                                        {{ old('no_of_adults', $reservation->no_of_adults) === 2 ? 'selected' : '' }}> 2
                                    </option>
                                    <option value="3"
                                        {{ old('no_of_adults', $reservation->no_of_adults) === 3 ? 'selected' : '' }}> 3
                                    </option>
                                    <option value="4"
                                        {{ old('no_of_adults', $reservation->no_of_adults) === 4 ? 'selected' : '' }}> 4
                                    </option>
                                    <option value="5"
                                        {{ old('no_of_adults', $reservation->no_of_adults) === 5 ? 'selected' : '' }}> 5
                                    </option>
                            </select>
                            @if ($errors->has('no_of_adults'))
                                <div class="text-danger">
                                    {{ $errors->first('no_of_adults') }}
                                </div>
                            @endif
                            <span
                                class="help-block no_of_adults_error">{{ trans('cruds.reservation.fields.no_of_adults_helper') }}</span>
                        </div>
                    </div>
                    <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
                        <div class="form-group my-2">
                            <label for="no_of_children">{{ trans('cruds.reservation.fields.howmanychildren') }}</label>
                            <select class="form-control select2 {{ $errors->has('no_of_children') ? 'is-invalid' : '' }}"
                                name="no_of_children" id="no_of_children"  >
                                <option value>
                                    {{ trans('cruds.reservation.fields.no_of_children') }}</option>
                                    <option value="0"
                                        {{ old('no_of_children', $reservation->no_of_children) === 0 ? 'selected' : '' }}> 0
                                    </option>
                                    <option value="1"
                                        {{ old('no_of_children', $reservation->no_of_children) === 1 ? 'selected' : '' }}> 1
                                    </option>
                                    <option value="2"
                                        {{ old('no_of_children', $reservation->no_of_children) === 2 ? 'selected' : '' }}> 2
                                    </option>
                                    <option value="3"
                                        {{ old('no_of_children', $reservation->no_of_children) === 3 ? 'selected' : '' }}> 3
                                    </option>
                                    <option value="4"
                                        {{ old('no_of_children', $reservation->no_of_children) === 4 ? 'selected' : '' }}> 4
                                    </option>
                                    <option value="5"
                                        {{ old('no_of_children', $reservation->no_of_children) === 5 ? 'selected' : '' }}> 5
                                    </option>
                            </select>
                            @if ($errors->has('no_of_children'))
                                <div class="text-danger">
                                    {{ $errors->first('no_of_children') }}
                                </div>
                            @endif
                            <span
                                class="help-block no_of_children_error">{{ trans('cruds.reservation.fields.no_of_children_helper') }}</span>
                        </div>
                    </div>
                    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                        <div class="form-group my-2">
                            <label class="" for="no_of_rooms">{{ trans('cruds.reservation.fields.no_of_rooms') }}</label>
                            <input class="form-control {{ $errors->has('no_of_rooms') ? 'is-invalid' : '' }}" type="number" name="no_of_rooms" id="no_of_rooms" value="{{ old('no_of_rooms', $reservation->no_of_rooms) }}">
                            @if($errors->has('no_of_rooms'))
                                <div class="text-danger">
                                    {{ $errors->first('no_of_rooms') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.reservation.fields.no_of_rooms_helper') }}</span>
                        </div>
                    </div>
                    <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
                        <div class="form-group my-2">
                            <label for="room_1_type">{{ trans('cruds.reservation.fields.room_1_type') }}</label>
                            <select class="form-control select2 {{ $errors->has('room_1_type') ? 'is-invalid' : '' }}"
                                name="room_1_type" id="room_1_type"  >
                                <option value>
                                    {{ trans('global.pleaseSelect') }}</option>
                                @foreach (App\Models\Reservation::ROOM as $key => $label)
                                    <option value="{{ $key }}"
                                        {{ old('room_1_type', $reservation->room_1_type) === (string) $key ? 'selected' : '' }}>{{ $label }}
                                    </option>
                                @endforeach
                            </select>
                            @if ($errors->has('room_1_type'))
                                <div class="text-danger">
                                    {{ $errors->first('room_1_type') }}
                                </div>
                            @endif
                            <span
                                class="help-block room_1_type_error">{{ trans('cruds.reservation.fields.room_1_type_helper') }}</span>
                        </div>
                    </div>
                    <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
                        <div class="form-group my-2">
                            <label for="room_2_type">{{ trans('cruds.reservation.fields.room_2_type') }}</label>
                            <select class="form-control select2 {{ $errors->has('room_2_type') ? 'is-invalid' : '' }}"
                                name="room_2_type" id="room_2_type"  >
                                <option value>
                                    {{ trans('global.pleaseSelect') }}</option>
                                @foreach (App\Models\Reservation::ROOM as $key => $label)
                                    <option value="{{ $key }}"
                                        {{ old('room_2_type', $reservation->room_2_type) === (string) $key ? 'selected' : '' }}>{{ $label }}
                                    </option>
                                @endforeach
                            </select>
                            @if ($errors->has('room_2_type'))
                                <div class="text-danger">
                                    {{ $errors->first('room_2_type') }}
                                </div>
                            @endif
                            <span
                                class="help-block room_2_type_error">{{ trans('cruds.reservation.fields.room_2_type_helper') }}</span>
                        </div>
                    </div>
                    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                        <div class="form-group my-2">
                            <label class="" for="instructions">{{ trans('cruds.reservation.fields.instructions') }}</label>
                            <textarea rows="4" class="form-control {{ $errors->has('instructions') ? 'is-invalid' : '' }}" name="instructions" id="instructions">{{ $reservation->instructions }}</textarea>
                            @if($errors->has('instructions'))
                                <div class="text-danger">
                                    {{ $errors->first('instructions') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.reservation.fields.instructions_helper') }}</span>
                        </div>
                    </div>
                </div>
            </fieldset>
            <div class="row">
                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                    <div class="form-group my-2">
                        <button class="btn btn-success" id="save" type="submit">
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
    <script>
        $(() => {
            //form submit validation
            $(document).on('click', '#save', function(e) {
                e.preventDefault();
                // $('#reservationForm').submit();
                validation();
            })

            function capitalize(string) {
                return string.charAt(0).toUpperCase() + string.slice(1);
            }
            //validation
            let validation = () => {
                let fields = [
                            'first_name', 
                            'last_name', 
                            'address', 
                            'zip_code',
                            'city',
                            'state',
                            'email',
                            'phone',
                            'check_in_date',
                            'check_out_date',
                        ];
                let err = [];

                fields.forEach((field) => {
                    if ($(`#${field}`).val() == null || $(`#${field}`).val() == '') {
                        $(`.${field}_err`).html(capitalize(field.replaceAll('_', ' ')) + ' field is required!' );
                        err.push(field);
                    } else {
                        $(`.${field}_err`).html('');
                        if (err.includes(field)) {
                            err.splice(err.indexOf(field), 1);
                        }
                    }
                })
                if (err.length == 0) {
                    $('#reservationForm').submit();
                } else {
                    alert('You need to fill require data!');
                }
            }
        })
    </script>
@endsection
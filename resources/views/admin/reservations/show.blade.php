@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.reservation.title') }}
    </div>

    <div class="card-body">
        <div class="form-group my-2">
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.reservation.fields.first_name') }}
                        </th>
                        <td>
                            {{ $reservation->first_name }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.reservation.fields.last_name') }}
                        </th>
                        <td>
                            {{ $reservation->last_name }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.reservation.fields.address') }}
                        </th>
                        <td>
                            {{ $reservation->address }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.reservation.fields.zip_code') }}
                        </th>
                        <td>
                            {{ $reservation->zip_code }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.reservation.fields.city') }}
                        </th>
                        <td>
                            {{ $reservation->city }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.reservation.fields.state') }}
                        </th>
                        <td>
                            {{ $reservation->state }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.reservation.fields.email') }}
                        </th>
                        <td>
                            {{ $reservation->email }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.reservation.fields.phone') }}
                        </th>
                        <td>
                            {{ $reservation->phone }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.reservation.fields.check_in_date') }}
                        </th>
                        <td>
                            {{ $reservation->check_in_date }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.reservation.fields.check_out_date') }}
                        </th>
                        <td>
                            {{ $reservation->check_out_date }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.reservation.fields.check_in_time') }}
                        </th>
                        <td>
                            {{ App\Models\Reservation::TIME[$reservation->check_in_time] ?? '-' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.reservation.fields.check_out_time') }}
                        </th>
                        <td>
                            {{ App\Models\Reservation::TIME[$reservation->check_out_time] ?? '-' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.reservation.fields.no_of_adults') }}
                        </th>
                        <td>
                            {{ $reservation->no_of_adults ?? '-' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.reservation.fields.no_of_children') }}
                        </th>
                        <td>
                            {{ $reservation->no_of_children ?? '-' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.reservation.fields.no_of_rooms') }}
                        </th>
                        <td>
                            {{ $reservation->no_of_rooms ?? '-' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.reservation.fields.room_1_type') }}
                        </th>
                        <td>
                            {{ App\Models\Reservation::ROOM[$reservation->room_1_type] ?? '-' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.reservation.fields.room_2_type') }}
                        </th>
                        <td>
                            {{ App\Models\Reservation::ROOM[$reservation->room_2_type] ?? '-' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.reservation.fields.instructions') }}
                        </th>
                        <td>
                            {{ $reservation->instructions ?? '-' }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group my-2">
                <a class="btn btn-secondary" href="{{ route('admin.reservations.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>



@endsection
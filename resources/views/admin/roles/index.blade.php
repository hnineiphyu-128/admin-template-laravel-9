@extends('layouts.admin')
@section('content')
<div class="card">
    <div class="custom-header">
        {{ trans('cruds.role.title_singular') }} {{ trans('global.list') }}
        @can('role_create')
            <div style="margin-bottom: 10px;" class="row">
                <div class="col-lg-12">
                    <a class="btn btn-success" href="{{ route('admin.roles.create') }}">
                        {{ trans('global.add') }} {{ trans('cruds.role.title_singular') }}
                    </a>
                </div>
            </div>
        @endcan
    </div>

    <div class="card-body">
        <div class="table-responsive">
            <table class=" table table-bordered datatable datatable-Role">
                <thead>
                    <tr>
                        <th width="10">
                            {{ trans('global.no') }}
                        </th>
                        <th>
                            {{ trans('cruds.role.fields.title') }}
                        </th>
                        <th>
                            {{ trans('cruds.role.fields.permissions') }}
                        </th>
                        <th>
                            &nbsp;
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($roles as $key => $role)
                        <tr data-entry-id="{{ $role->id }}">
                            <td>
                                {{ $loop->iteration ?? '' }}
                            </td>
                            <td>
                                {{ $role->title ?? '' }}
                            </td>
                            <td>
                                @foreach($role->permissions as $key => $item)
                                    <span class="badge bg-info my-1">{{ $item->title }}</span>
                                @endforeach
                            </td>
                            <td class="text-nowrap">
                                @can('role_show')
                                    <a class="p-0 glow"
                                        style="width: 26px;height: 36px;display: inline-block;line-height: 36px;color:grey;"
                                        href="{{ route('admin.roles.show', $role->id) }}">
                                        <span class="mdi mdi-eye-outline"></span>
                                    </a>
                                @endcan

                                @can('role_edit')
                                        <a class="p-0 glow"
                                            style="width: 26px;height: 36px;display: inline-block;line-height: 36px;color:grey;"
                                            href="{{ route('admin.roles.edit', $role->id) }}">
                                            <span class="mdi mdi-square-edit-outline"></span>
                                        </a>
                                    @endcan

                                    @can('role_delete')
                                        <form id="orderDelete-{{ $role->id }}"
                                            action="{{ route('admin.roles.destroy', $role->id) }}" method="POST"
                                            onsubmit="return confirm('{{ trans('global.areYouSure') }}');"
                                            style="display: inline-block;">
                                            <input type="hidden" name="_method" value="DELETE">
                                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                            <input type="hidden"
                                                style="width: 26px;height: 36px;display: inline-block;line-height: 36px;"
                                                class=" p-0 glow" value="{{ trans('global.delete') }}">
                                            <button
                                                style="width: 26px;height: 36px;display: inline-block;line-height: 36px;border:none;color:grey;background:none;"
                                                class="p-0 glow" type="submit">
                                                <span class="mdi mdi-delete"></span>
                                            </button>
                                        </form>
                                    @endcan
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>



@endsection
@section('scripts')
@parent
<script>
    $(function () {
  let dtButtons = $.extend(true, [], $.fn.dataTable.defaults.buttons)
@can('role_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('admin.roles.massDestroy') }}",
    className: 'btn-danger',
    action: function (e, dt, node, config) {
      var ids = $.map(dt.rows({ selected: true }).nodes(), function (entry) {
          return $(entry).data('entry-id')
      });

      if (ids.length === 0) {
        alert('{{ trans('global.datatables.zero_selected') }}')

        return
      }

      if (confirm('{{ trans('global.areYouSure') }}')) {
        $.ajax({
          headers: {'x-csrf-token': _token},
          method: 'POST',
          url: config.url,
          data: { ids: ids, _method: 'DELETE' }})
          .done(function () { location.reload() })
      }
    }
  }
  dtButtons.push(deleteButton)
@endcan

  $.extend(true, $.fn.dataTable.defaults, {
    orderCellsTop: true,
    // order: [[ 1, 'desc' ]],
    pageLength: 10,
  });
  let table = $('.datatable-Role:not(.ajaxTable)').DataTable({ buttons: dtButtons })
  $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
      $($.fn.dataTable.tables(true)).DataTable()
          .columns.adjust();
  });
  
})

</script>
@endsection
<!-- Start of Add addTownshipModal Modal -->
<div class="modal fade" id="addTownshipModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">
                    {{ trans('global.add') }} {{ trans('cruds.township.title_singular') }}
                </h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form class="addStockPriceForm" action="{{ route('admin.townships.storeTownship') }}" method="POST">
                @csrf
                <div class="modal-body">
                    <div class="mb-3">
                        <div class="form-group my-2">
                            <label class="required" for="name_en">{{ trans('cruds.township.fields.region') }}</label>
                            <select class="form-control "
                                name="region_id" id="region_id"  >
                                <option value>
                                    {{ trans('global.pleaseSelect') }}</option>
                                @foreach ($regions as $region)
                                    <option value="{{ $region->id }}"
                                        {{ old('region_id', '') ===  $region->id ? 'selected' : '' }}>{{ $region->name_en }} @if($region->name_mm) ( {{ $region->name_mm }} )@endif
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="mb-3">
                        <div class="form-group my-2">
                            <label class="required" for="name_en">{{ trans('cruds.township.fields.name_en') }}</label>
                            <input required type="text" class="form-control" name="name_en">
                        </div>
                    </div>
                    <div class="mb-3">
                        <div class="form-group my-2">
                            <label class="required" for="name_mm">{{ trans('cruds.township.fields.name_mm') }}</label>
                            <input required type="text" class="form-control" name="name_mm">
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">
                        {{ trans('global.add') }}
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- End of Add Category Modal -->

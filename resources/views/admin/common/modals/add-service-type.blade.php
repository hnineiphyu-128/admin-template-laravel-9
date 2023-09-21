<!-- Start of Add ServiceType Modal -->
<div class="modal fade" id="addServiceTypeModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">
                    {{ trans('global.add') }} {{ trans('cruds.serviceType.title_singular') }}
                </h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form class="addStockPriceForm" action="{{ route('admin.service-types.storeServiceType') }}" method="POST">
                @csrf
                <div class="modal-body">
                    <div class="mb-3">
                        <div class="form-group my-2">
                            <label class="required" for="name_en">{{ trans('cruds.serviceType.fields.name_en') }}</label>
                            <input required type="text" class="form-control" name="name_en">
                        </div>
                    </div>
                    <div class="mb-3">
                        <div class="form-group my-2">
                            <label class="required" for="name_mm">{{ trans('cruds.serviceType.fields.name_mm') }}</label>
                            <input required type="text" class="form-control" name="name_mm">
                        </div>
                    </div>
                    <div class="mb-3">
                        <div class="form-group my-2">
                            <label class="required" for="type">{{ trans('cruds.serviceType.fields.type') }}</label>
                            <select required class="form-control" name="type">
                                <option value>
                                    {{ trans('global.pleaseSelect') }}
                                </option>
                                @foreach (App\Models\ServiceType::SERVICE_TYPE as $key => $label)
                                    <option value="{{ $key }}"
                                        {{ old('type', '') === (string) $key ? 'selected' : '' }}>{{ $label }}
                                    </option>
                                @endforeach
                            </select>
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

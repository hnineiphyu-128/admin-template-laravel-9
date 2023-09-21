<!-- Start of Add Delivery Modal -->
<div class="modal fade" id="addDeliveryModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">
                    {{ trans('global.add') }} {{ trans('cruds.delivery.title_singular') }}
                </h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form class="addStockPriceForm" action="{{ route('admin.deliveries.storeDelivery') }}" method="POST">
                @csrf
                <div class="modal-body">
                    <div class="mb-3">
                        <div class="form-group my-2">
                            <label class="required" for="township_id">{{ trans('cruds.delivery.fields.township') }}</label>
                            <div class="d-flex">
                                <select required class="form-control" name="township_id">
                                    <option value>
                                        {{ trans('global.pleaseSelect') }}
                                    </option>
                                    @foreach ($townships as $township)
                                        <option value="{{ $township->id }}"
                                            {{ old('township_id', '') ===  $township->id ? 'selected' : '' }}>{{ $township->name_en }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                        </div>
                    </div>
                    <div class="mb-3">
                        <div class="form-group my-2">
                            <label class="required" for="fee">{{ trans('cruds.delivery.fields.fee') }}</label>
                            <input required type="text" class="form-control" name="fee">
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

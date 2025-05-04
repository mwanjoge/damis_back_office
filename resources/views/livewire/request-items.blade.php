<div class="mt-5">
    <div class="card pt-4">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h5 class="mb-0">Requested Items</h5>
            <button type="button" wire:click="addInput" id="add-request-item" class="btn btn-secondary btn-sm">Add
                Requested Item</button>
        </div>
        <div class="card-body">
            <div id="request-items-list">
            @foreach($inputs as $key => $value)
                <div class="request-item-row row g-2 mb-2 align-items-end">

                    <div class="col">
                       
                                <label class="form-label form-label-sm">Service Provider</label>
                                <select name="request_items[0][service_provider_id]" 
                                    class="form-select form-select-sm" required>
                                    <option value="">Select Provider</option>
                                    @foreach($providers as $provider)
                                        <option value="{{ $provider->id }}">{{ $provider->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col">
                                <label class="form-label form-label-sm">Service</label>
                                <select name="request_items[0][service_id]" 
                                    class="form-select form-select-sm" required>
                                    <option value="">Select Service</option>
                                    @foreach($services as $service)
                                        <option value="{{ $service->id }}">{{ $service->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col">
                                <label class="form-label form-label-sm">Price</label>
                                <div class="input-group input-group-sm">
                                    <span class="input-group-text">TZS</span>
                                    <input type="number" name="request_items[0][price]" 
                                        class="form-control form-control-sm" step="0.01" required>
                                </div>
                            </div>
                            <div class="col">
                                <label class="form-label form-label-sm">Certificate Holder</label>
                                <input type="text" name="request_items[0][certificate_holder_name]" 
                                    class="form-control form-control-sm" required>

                            </div>
                            <div class="col">
                                <label class="form-label form-label-sm">Index Number</label>
                                <input type="text" name="request_items[0][certificate_index_number]" 
                                    class="form-control form-control-sm">

                            </div>
                            <div class="col">
                                <label class="form-label form-label-sm">Attachment</label>
                                <div class="input-group input-group-sm">
                                    <input type="file" name="request_items[0][attachment]"  
                                        class="form-control form-control-sm" placeholder="Attachment">

                                </div>

                            </div>
                            <div class="col-auto">
                                <button type="button" wire:click="removeInput({{ $key }})" class="btn btn-danger btn-sm remove-item">
                                    <i class="bx bx-trash"></i>
                                </button>
                            </div>
                        @endforeach
                </div>
            </div>
        </div>
    </div>

</div>
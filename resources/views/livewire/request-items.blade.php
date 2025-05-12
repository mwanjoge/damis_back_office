<div class="mt-5">
    <div class="card pt-4">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h5 class="mb-0">Requested Items</h5>
            <button type="button" wire:click="addInput" id="add-request-item" class="btn btn-secondary btn-sm">Add
                Requested Item</button>
        </div>
        <div class="card-body">
            <div id="request-items-list" name="request_items">
                <!-- <select wire:model="test" wire:change="getService">
                    <option value="test1">Test</option>
                    <option value="test2">Test 2</option>
                </select> -->
            @foreach($inputs as $key => $input)
                <div class="request-item-row row g-2 mb-2 align-items-end">
                    <div class="col">
                                <label for="choices-single-default" class="form-label text-muted">Service Provider</label>
                        <select wire:model="inputs.{{ $key }}.service_provider_id" wire:model.live wire:change="getServices({{ $key }})" class="form-control" id="choices-single-default" data-choices name="request_items[{{ $key }}][service_provider_id]" required>
                            <option value="">Select Provider</option>
                            @foreach($providers as $provider)
                                <option value="{{ $provider->id }}">{{ $provider->name }}</option>
                            @endforeach
                        </select>
                        @error("inputs.$key.service_provider_id")
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="col">
                        <label class="form-label form-label-sm">Service</label>
                        <select wire:model="inputs.{{ $key }}.service_id" class="form-select form-select-sm choices-select" name="request_items[{{ $key }}][service_id]" required>
                            <option value="">Select Service</option>
                            @foreach($servicesInputs[$key] ?? [] as $service)
                                <option value="{{ $service->id }}">{{ $service->name }}</option>
                            @endforeach
                        </select>
                        @error("inputs.$key.service_id")
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="col">
                        <label class="form-label form-label-sm" >Price</label>
                        <div class="input-group input-group-sm">
                            <span class="input-group-text">TZS</span>
                            <input type="number" wire:model="inputs.{{ $key }}.price" name="request_items[{{ $key }}][price]" class="form-control form-control-sm  choices-select" step="0.01" required>
                        </div>
                        @error("inputs.$key.price")
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="col">
                        <label class="form-label form-label-sm">Certificate Holder</label>
                        <input type="text" wire:model="inputs.{{ $key }}.certificate_holder_name" name="request_items[{{ $key }}][certificate_holder_name]" class="form-control form-control-sm" required>
                        @error("inputs.$key.certificate_holder_name")
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="col">
                        <label class="form-label form-label-sm">Index Number</label>
                        <input type="text" wire:model="inputs.{{ $key }}.certificate_index_number" name="request_items[{{ $key }}][certificate_index_number]" class="form-control form-control-sm">
                        @error("inputs.$key.certificate_index_number")
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="col">
                        <label class="form-label form-label-sm">Attachment</label>
                        <div class="input-group input-group-sm">
                            <input type="file" wire:model="inputs.{{ $key }}.attachment" name="requested_items[{{ $key }}][attachment]" class="form-control form-control-sm" placeholder="Attachment">
                        </div>
                        @error("inputs.$key.attachment")
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="col-auto">
                        <button type="button" wire:click="removeInput({{ $key }})" class="btn btn-danger btn-sm remove-item">
                            <i class="bx bx-trash"></i>
                        </button>
                    </div>
                </div>
            @endforeach
            </div>
        </div>
    </div>
</div>
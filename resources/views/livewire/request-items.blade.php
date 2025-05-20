<div class="mt-5">
    <div class="card">
        <div class="card-header">
            <div class=" d-flex justify-content-between align-items-center container-fluid">
                    <h3 class="card-title me-auto">Requested Items</h3>
                    <button type="button" wire:click="addInput" id="add-request-item"
                        class="btn btn-primary ms-auto">
                        <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24"
                            viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                            stroke-linecap="round" stroke-linejoin="round">
                            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                            <path d="M12 5l0 14" />
                            <path d="M5 12l14 0" />
                        </svg>
                        Add Item
                    </button>
            </div>
        </div>
        <div class="card-body">
            <div id="request-items-list" name="request_items">
                @foreach ($inputs as $key => $input)
                    <div class="request-item-row card card-sm mb-3">
                        <div class="card-body">
                            <div class="row g-3 align-items-center">
                                <div class="col-md-2">
                                    <div class="form-label">Service Provider</div>
                                    <select wire:model.live="inputs.{{ $key }}.service_provider_id"
                                        wire:change="getServices({{ $key }})" class="form-select"
                                        name="request_items[{{ $key }}][service_provider_id]" required>
                                        <option value="">Select Provider</option>
                                        @foreach ($providers as $provider)
                                            <option value="{{ $provider->id }}">{{ $provider->name }}</option>
                                        @endforeach
                                    </select>
                                    @error("inputs.$key.service_provider_id")
                                        <div class="invalid-feedback d-block">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-md-2">
                                    <div class="form-label">Service</div>
                                    <select wire:model.live="inputs.{{ $key }}.service_id" class="form-select"
                                        name="request_items[{{ $key }}][service_id]" required>
                                        <option value="">Select Service</option>
                                        @foreach ($servicesInputs[$key] ?? [] as $service)
                                            <option value="{{ $service->id }}">{{ $service->name }}</option>
                                        @endforeach
                                    </select>
                                    @error("inputs.$key.service_id")
                                        <div class="invalid-feedback d-block">{{ $message }}</div>
                                    @enderror
                                </div>
                                {{-- <div class="col-md-2">
                                <div class="form-label">Price</div>
                                <div class="input-group">
                                    <span class="input-group-text">TZS</span>
                                    <input type="number" wire:model="inputs.{{ $key }}.price" name="request_items[{{ $key }}][price]" class="form-control" step="0.01" readonly required>
                                </div>
                                @error("inputs.$key.price")
                                    <div class="invalid-feedback d-block">{{ $message }}</div>
                                @enderror
                            </div> --}}
                                <div class="col-md-2">
                                    <div class="form-label">Certificate Holder</div>
                                    <input type="text"
                                        wire:model="inputs.{{ $key }}.certificate_holder_name"
                                        name="request_items[{{ $key }}][certificate_holder_name]"
                                        class="form-control" required>
                                    @error("inputs.$key.certificate_holder_name")
                                        <div class="invalid-feedback d-block">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-md-2">
                                    <div class="form-label">Index Number</div>
                                    <input type="text"
                                        wire:model="inputs.{{ $key }}.certificate_index_number"
                                        name="request_items[{{ $key }}][certificate_index_number]"
                                        class="form-control">
                                    @error("inputs.$key.certificate_index_number")
                                        <div class="invalid-feedback d-block">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-md-2">
                                    <div class="form-label">Attachment</div>
                                    <input type="file" wire:model="inputs.{{ $key }}.attachment"
                                        name="request_items[{{ $key }}][attachment]" class="form-control"
                                        placeholder="Attachment">
                                    @error("inputs.$key.attachment")
                                        <div class="invalid-feedback d-block">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-auto ms-auto">
                                    <button type="button" wire:click="removeInput({{ $key }})"
                                        class="btn btn-danger btn-icon" title="Remove item">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24"
                                            height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"
                                            fill="none" stroke-linecap="round" stroke-linejoin="round">
                                            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                            <path d="M4 7l16 0" />
                                            <path d="M10 11l0 6" />
                                            <path d="M14 11l0 6" />
                                            <path d="M5 7l1 12a2 2 0 0 0 2 2h8a2 2 0 0 0 2 -2l1 -12" />
                                            <path d="M9 7v-3a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v3" />
                                        </svg>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</div>

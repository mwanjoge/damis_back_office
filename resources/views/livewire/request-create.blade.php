<div class="container">
    <form wire:submit.prevent="submit">
        <div class="row g-4">
            <div class="col-md-6">
                <div class="mb-3">
                    <label>Account</label>
                    <input type="text" wire:model="account_id" class="form-control" required>
                    @error('account_id') <span class="text-danger">{{ $message }}</span> @enderror
                </div>
                <div class="mb-3">
                    <label>Embassy</label>
                    <input type="text" wire:model="embassy_id" class="form-control" required>
                    @error('embassy_id') <span class="text-danger">{{ $message }}</span> @enderror
                </div>
                <div class="mb-3">
                    <label>Member</label>
                    <input type="text" wire:model="member_id" class="form-control" required>
                    @error('member_id') <span class="text-danger">{{ $message }}</span> @enderror
                </div>
                <div class="mb-3">
                    <label>Country</label>
                    <input type="text" wire:model="country_id" class="form-control" required>
                    @error('country_id') <span class="text-danger">{{ $message }}</span> @enderror
                </div>
                <div class="mb-3">
                    <label>Type</label>
                    <select wire:model="type" class="form-control" required>
                        <option value="Diaspora">Diaspora</option>
                        <option value="Domestic">Domestic</option>
                    </select>
                </div>
                <div class="mb-3">
                    <label>Status</label>
                    <select wire:model="status" class="form-control" required>
                        <option value="Pending">Pending</option>
                        <option value="In Progress">In Progress</option>
                        <option value="Completed">Completed</option>
                        <option value="Cancelled">Cancelled</option>
                    </select>
                </div>
                <div class="mb-3">
                    <label>Sent Status</label>
                    <select wire:model="sent_status" class="form-control" required>
                        <option value="sent">Sent</option>
                        <option value="failed">Failed</option>
                    </select>
                </div>
                <div class="form-check mb-3">
                    <input type="checkbox" wire:model="is_approved" class="form-check-input" id="isApproved">
                    <label class="form-check-label" for="isApproved">Is Approved</label>
                </div>
                <div class="form-check mb-3">
                    <input type="checkbox" wire:model="is_paid" class="form-check-input" id="isPaid">
                    <label class="form-check-label" for="isPaid">Is Paid</label>
                </div>
                <div class="mb-3">
                    <label>Total Cost</label>
                    <input type="number" wire:model="total_cost" class="form-control" readonly>
                </div>
            </div>
            <div class="col-md-6">
                <h4>Requested Items</h4>
                @foreach($request_items as $index => $item)
                    <div class="card mb-2 p-2">
                        <div class="row g-2">
                            <div class="col">
                                <label>Service</label>
                                <select wire:model="request_items.{{ $index }}.service_id" class="form-control" required>
                                    <option value="">Select Service</option>
                                    @foreach($services as $service)
                                        <option value="{{ $service->id }}">{{ $service->name }}</option>
                                    @endforeach
                                </select>
                                @error('request_items.'.$index.'.service_id') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>
                            <div class="col">
                                <label>Service Provider</label>
                                <select wire:model="request_items.{{ $index }}.service_provider_id" class="form-control" required>
                                    <option value="">Select Provider</option>
                                    @foreach($serviceProviders as $provider)
                                        <option value="{{ $provider->id }}">{{ $provider->name }}</option>
                                    @endforeach
                                </select>
                                @error('request_items.'.$index.'.service_provider_id') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>
                            <div class="col">
                                <label>Amount</label>
                                <input type="number" wire:model="request_items.{{ $index }}.amount" class="form-control" step="0.01" required>
                                @error('request_items.'.$index.'.amount') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>
                            <div class="col">
                                <label>Certificate Holder Name</label>
                                <input type="text" wire:model="request_items.{{ $index }}.certificate_holder_name" class="form-control" required>
                                @error('request_items.'.$index.'.certificate_holder_name') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>
                            <div class="col">
                                <label>Certificate Index Number</label>
                                <input type="text" wire:model="request_items.{{ $index }}.certificate_index_number" class="form-control">
                            </div>
                            <div class="col">
                                <label>Attachment</label>
                                <input type="text" wire:model="request_items.{{ $index }}.attachment" class="form-control">
                            </div>
                            <div class="col-auto d-flex align-items-end">
                                <button type="button" class="btn btn-danger" wire:click="removeRequestItem({{ $index }})" @if(count($request_items) == 1) disabled @endif>Remove</button>
                            </div>
                        </div>
                    </div>
                @endforeach
                <button type="button" class="btn btn-secondary mb-3" wire:click="addRequestItem">Add Requested Item</button>
            </div>
        </div>
        <div class="mt-3">
            <button type="submit" class="btn btn-primary">Submit</button>
        </div>
    </form>
</div>
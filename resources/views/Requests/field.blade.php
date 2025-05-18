<div class="mb-3">
    <label for="account_id" class="form-label">Account</label>
    <select name="account_id" id="account_id" class="form-control" required>
        @foreach ($accounts as $account)
            <option value="{{ $account->id }}"
                {{ old('account_id', $request->account_id ?? '') == $account->id ? 'selected' : '' }}>
                {{ $account->name ?? $account->id }}
            </option>
        @endforeach
    </select>
</div>
<div class="mb-3">
    <label for="embassy_id" class="form-label">Embassy</label>
    <select name="embassy_id" id="embassy_id" class="form-control" required>
        @foreach ($embassies as $embassy)
            <option value="{{ $embassy->id }}"
                {{ old('embassy_id', $request->embassy_id ?? '') == $embassy->id ? 'selected' : '' }}>
                {{ $embassy->name ?? $embassy->id }}
            </option>
        @endforeach
    </select>
</div>
<div class="mb-3">
    <label for="service_id" class="form-label">Service</label>
    <select name="service_id" id="service_id" class="form-control" required>
        @foreach ($services as $service)
            <option value="{{ $service->id }}"
                {{ old('service_id', $request->service_id ?? '') == $service->id ? 'selected' : '' }}>
                {{ $service->name ?? $service->id }}
            </option>
        @endforeach
    </select>
</div>
<div class="mb-3">
    <label for="service_provider_id" class="form-label">Service Provider</label>
    <select name="service_provider_id" id="service_provider_id" class="form-control" required>
        @foreach ($serviceProviders as $provider)
            <option value="{{ $provider->id }}"
                {{ old('service_provider_id', $request->service_provider_id ?? '') == $provider->id ? 'selected' : '' }}>
                {{ $provider->name ?? $provider->id }}
            </option>
        @endforeach
    </select>
</div>
<div class="mb-3">
    <label for="member_id" class="form-label">Member</label>
    <select name="member_id" id="member_id" class="form-control" required>
        @foreach ($members as $member)
            <option value="{{ $member->id }}"
                {{ old('member_id', $request->member_id ?? '') == $member->id ? 'selected' : '' }}>
                {{ $member->name ?? $member->id }}
            </option>
        @endforeach
    </select>
</div>
<div class="mb-3">
    <label for="country_id" class="form-label">Country</label>
    <select name="country_id" id="country_id" class="form-control" required>
        @foreach ($countries as $country)
            <option value="{{ $country->id }}"
                {{ old('country_id', $request->country_id ?? '') == $country->id ? 'selected' : '' }}>
                {{ $country->name ?? $country->id }}
            </option>
        @endforeach
    </select>
</div>
<div class="mb-3">
    <label for="type" class="form-label">Type</label>
    <select name="type" id="type" class="form-control" required>
        <option value="Diaspora" {{ old('type', $request->type ?? '') == 'Diaspora' ? 'selected' : '' }}>Diaspora
        </option>
        <option value="Domestic" {{ old('type', $request->type ?? '') == 'Domestic' ? 'selected' : '' }}>Domestic
        </option>
    </select>
</div>
<div class="mb-3">
    <label for="status" class="form-label">Status</label>
    <select name="status" id="status" class="form-control" required>
        <option value="Pending" {{ old('status', $request->status ?? '') == 'Pending' ? 'selected' : '' }}>Pending
        </option>
        <option value="In Progress" {{ old('status', $request->status ?? '') == 'In Progress' ? 'selected' : '' }}>In
            Progress</option>
        <option value="Completed" {{ old('status', $request->status ?? '') == 'Completed' ? 'selected' : '' }}>
            Completed</option>
        <option value="Cancelled" {{ old('status', $request->status ?? '') == 'Cancelled' ? 'selected' : '' }}>
            Cancelled</option>
    </select>
</div>
<div class="mb-3">
    <label for="tracking_number" class="form-label">Tracking Number</label>
    <input type="text" name="tracking_number" id="tracking_number" class="form-control"
        value="{{ old('tracking_number', $request->tracking_number ?? '') }}" required>
</div>
<div class="mb-3">
    <label for="is_approved" class="form-label">Is Approved</label>
    <input type="checkbox" name="is_approved" id="is_approved" value="1"
        {{ old('is_approved', $request->is_approved ?? false) ? 'checked' : '' }}>
</div>
<div class="mb-3">
    <label for="is_paid" class="form-label">Is Paid</label>
    <input type="checkbox" name="is_paid" id="is_paid" value="1"
        {{ old('is_paid', $request->is_paid ?? false) ? 'checked' : '' }}>
</div>
<div class="mb-3">
    <label for="total_cost" class="form-label">Total Cost</label>
    <input type="number" step="0.01" name="total_cost" id="total_cost" class="form-control"
        value="{{ old('total_cost', $request->total_cost ?? 0) }}" required>
</div>
<div class="mb-3">
    <label for="sent_status" class="form-label">Sent Status</label>
    <select name="sent_status" id="sent_status" class="form-control" required>
        <option value="sent" {{ old('sent_status', $request->sent_status ?? '') == 'sent' ? 'selected' : '' }}>Sent
        </option>
        <option value="failed" {{ old('sent_status', $request->sent_status ?? '') == 'failed' ? 'selected' : '' }}>
            Failed</option>
    </select>
</div>

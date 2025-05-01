<div class="container mt-4">
    <h2>Request Details</h2>
    <table class="table table-bordered">
        <tbody>
            <tr><th>ID</th><td>{{ $request->id }}</td></tr>
            <tr><th>Account</th><td>{{ $request->account_id }}</td></tr>
            <tr><th>Embassy</th><td>{{ $request->embassy_id }}</td></tr>
            <tr><th>Service</th><td>{{ $request->service_id }}</td></tr>
            <tr><th>Service Provider</th><td>{{ $request->service_provider_id }}</td></tr>
            <tr><th>Member</th><td>{{ $request->member_id }}</td></tr>
            <tr><th>Country</th><td>{{ $request->country_id }}</td></tr>
            <tr><th>Tracking Number</th><td>{{ $request->tracking_number }}</td></tr>
            <tr><th>Status</th><td>{{ $request->status }}</td></tr>
            <tr><th>Type</th><td>{{ $request->type }}</td></tr>
            <tr><th>Total Cost</th><td>{{ $request->total_cost }}</td></tr>
            <tr><th>Is Approved (Admin)</th><td>{{ $request->is_approved ? 'Yes' : 'No' }}</td></tr>
            <tr><th>Is Paid (User)</th><td>{{ $request->is_paid ? 'Yes' : 'No' }}</td></tr>
            <tr><th>Sent Status</th><td>{{ $request->sent_status }}</td></tr>
            <tr><th>Created At</th><td>{{ $request->created_at }}</td></tr>
            <tr><th>Updated At</th><td>{{ $request->updated_at }}</td></tr>
        </tbody>
    </table>
    @if(!$request->is_approved)
        <button wire:click="approve" class="btn btn-success">Approve</button>
    @endif
    <a href="{{ route('requests.index') }}" class="btn btn-secondary ms-2">Back</a>
    @if(session()->has('success'))
        <div class="alert alert-success mt-2">{{ session('success') }}</div>
    @endif
</div>
@extends('layouts.master')
@section('title', 'Show Request')
@section('content')
<div class="row mt-4">
    <div class="col-lg-5 mb-3">
        <div class="card h-100">
            <div class="card-header">
                <h4>Request Details</h4>
            </div>
            <div class="card-body">
                <h5>Tracking Number: {{ $request->tracking_number }}</h5>
                <table class="table table-bordered">
                    <tbody>
                        <tr><th>Account</th><td>{{ optional($request->account)->name ?? $request->account_id }}</td></tr>
                        <tr><th>Embassy</th><td>{{ optional($request->embassy)->name ?? $request->embassy_id }}</td></tr>
                        <tr><th>Member</th><td>{{ optional($request->member)->name ?? $request->member_id }}</td></tr>
                        <tr><th>Country</th><td>{{ optional($request->country)->name ?? $request->country_id }}</td></tr>
                        <tr><th>Type</th><td>{{ $request->type }}</td></tr>
                        <tr><th>Total Cost</th><td>{{ $request->total_cost }}</td></tr>
                        <tr><th>Is Approved (Admin)</th><td>{{ $request->is_approved ? 'Yes' : 'No' }}</td></tr>
                        <tr><th>Is Paid (User)</th><td>{{ $request->is_paid ? 'Yes' : 'No' }}</td></tr>
           
                    </tbody>
                </table>
            
                <a href="{{ route('requests.index') }}" class="btn btn-secondary btn-sm">Back</a>
                @if(session()->has('success'))
                    <div class="alert alert-success mt-2">{{ session('success') }}</div>
                @endif
            </div>
        </div>
    </div>
    <div class="col-lg-7 d-flex flex-column gap-3">
        <div class="card">
            <div class="card-header">
                <h6 class="mb-0">Request Invoice</h6>
            </div>
            <div class="card-body">
                <div>
                    <strong>Invoice Number:</strong> {{ $request->invoice_number ?? '-' }}<br>
                    <strong>Invoice Date:</strong> {{ $request->invoice_date ?? '-' }}<br>
                    <strong>Amount:</strong> {{ $request->total_cost }}<br>
                    <strong>Status:</strong> {{ $request->invoice_status ?? '-' }}
                </div>
            </div>
        </div>
        <div class="card">
            <div class="card-header">
                <h6 class="mb-0">Request Payment</h6>
            </div>
            <div class="card-body">
                <div>
                    <strong>Payment Reference:</strong> {{ $request->payment_reference ?? '-' }}<br>
                    <strong>Payment Date:</strong> {{ $request->payment_date ?? '-' }}<br>
                    <strong>Paid Amount:</strong> {{ $request->paid_amount ?? '-' }}<br>
                    <strong>Payment Status:</strong> {{ $request->payment_status ?? ($request->is_paid ? 'Paid' : 'Not Paid') }}
                </div>
            </div>
        </div>
        <div class="card">
            <div class="card-header">
                <h6 class="mb-0">Request Items</h6>
            </div>
            <div class="card-body">
                <table class="table table-sm table-bordered mb-0">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Service</th>
                            <th>Service Provider</th>
                            <th>Price</th>
                            <th>Certificate Holder</th>
                            <th>Index Number</th>
                            <th>Attachment</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($request->items ?? [] as $i => $item)
                        <tr>
                            <td>{{ $i+1 }}</td>
                            <td>{{ optional($item->service)->name ?? $item->service_id }}</td>
                            <td>{{ optional($item->serviceProvider)->name ?? $item->service_provider_id }}</td>
                            <td>{{ $item->price ?? $item->amount }}</td>
                            <td>{{ $item->certificate_holder_name }}</td>
                            <td>{{ $item->certificate_index_number }}</td>
                            <td>
                                @if($item->attachment)
                                    <a href="{{ asset('storage/'.$item->attachment) }}" target="_blank">View</a>
                                @else
                                    -
                                @endif
                            </td>
                        </tr>
                        @endforeach
                        @if(empty($request->items) || count($request->items) == 0)
                        <tr>
                            <td colspan="7" class="text-center text-muted">No items found.</td>
                        </tr>
                        @endif
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
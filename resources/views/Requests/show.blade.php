@extends('layouts.tabler.app')
@include('requests.request_review_modal')
@section('title', 'Show Request')
@section('content')
    @php
    $breadcrumbs = [
        ['name' => 'Home', 'url' => route('home')],
        ['name' => 'Requests', 'url' => route('requests.index')],
        ['name' => 'Request Details', 'url' => url()->current()]
    ];
    @endphp

    {{-- @include('layouts.breadcrumb') --}}

    <div class="page-header d-print-none mb-4">
        <div class="container-xl">
            <div class="row g-2 align-items-center">
                <div class="col">
                    <h2 class="page-title">Request Details</h2>
                    <div class="text-muted mt-1">Tracking Number: {{ $request->tracking_number }}</div>
                </div>
                <div class="col-auto ms-auto">
                    <a href="{{ route('requests.index') }}" class="btn btn-secondary">
                        <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-arrow-left" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                            <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                            <path d="M5 12l14 0"></path>
                            <path d="M5 12l6 6"></path>
                            <path d="M5 12l6 -6"></path>
                        </svg>
                        Back to Requests
                    </a>
                </div>
            </div>
        </div>
    </div>

    <div class="row g-4">
        <!-- Left column: Request Details -->
        <div class="col-lg-5">
            <div class="card h-100">
                <div class="card-header">
                    <h4>Request Details</h4>
                </div>
                <div class="card-body">
                    <h5>Tracking Number: {{ $request->tracking_number }}</h5>
                    <table class="table table-bordered">
                        <tbody>
                            <tr>
                                <th>Account</th>
                                <td>{{ optional($request->account)->name ?? $request->account_id }}</td>
                            </tr>
                            <tr>
                                <th>Embassy</th>
                                <td>{{ optional($request->embassy)->name ?? $request->embassy_id }}</td>
                            </tr>
                            <tr>
                                <th>Member</th>
                                <td>{{ optional($request->member)->name ?? $request->member_id }}</td>
                            </tr>
                            <tr>
                                <th>Country</th>
                                <td>{{ optional($request->country)->name ?? $request->country_id }}</td>
                            </tr>
                            <tr>
                                <th>Type</th>
                                <td>{{ $request->type }}</td>
                            </tr>
                            <tr>
                                <th>Total Cost</th>
                                <td>{{ $request->total_cost }}</td>
                            </tr>
                            <tr>
                                <th>Is Approved (Admin)</th>
                                <td>{{ $request->is_approved ? 'Yes' : 'No' }}</td>
                            </tr>
                            <tr>
                                <th>Is Paid (User)</th>
                                <td>{{ $request->is_paid ? 'Yes' : 'No' }}</td>
                            </tr>
                        </tbody>
                    </table>
                    @if (session()->has('success'))
                        <div class="alert alert-success mt-2">{{ session('success') }}</div>
                    @endif
                </div>
            </div>
        </div>
        <!-- Right column: Invoice, Payment, Items -->
        <div class="col-lg-7 d-flex flex-column gap-4">
            <div class="card">
                <div class="card-header">
                    <h6 class="mb-0">Invoice Details</h6>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-8">
                            <strong>Invoice No:</strong> {{ $request->invoice?->ref_no ?? '-' }}<br>
                            <strong>Date:</strong> {{ $request->invoice?->invoice_date?->format('d M, Y') ?? '-' }}<br>
                            <strong>Payment Status:</strong> <span
                                class="badge bg-{{ $request->invoice?->status == 'paid' ? 'success' : 'warning' }}-subtle text-{{ $request->invoice?->status == 'paid' ? 'success' : 'warning' }} fs-11">{{ ucfirst($request->invoice?->status ?? 'Pending') }}</span><br>
                            <strong>Total Amount:</strong> {{ number_format($request->total_cost, 2) }}
                            {{ $request->invoice?->currency ?? 'USD' }}
                        </div>
                        <div class="col-4 text-start">

                            <div class="mt-2 text-start">
                                <strong class="fw-bold">Applicant:</strong> {{ $request->member->name ?? '-' }}<br>
                                <strong class="fw-bold">Email:</strong> {{ $request->member->email ?? '-' }}<br>
                                <strong class="fw-bold">Phone:</strong> {{ $request->member->phone ?? '-' }}

                            </div>
                        </div>
                    </div>
                    <div class="table-responsive mt-4">
                        <table class="table table-borderless text-center table-nowrap align-middle mb-0">
                            <thead class="table-active">
                                <tr>
                                    <th>#</th>
                                    <th>Service</th>
                                    <th>Certificate Holder</th>
                                    <th>Price</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($request->requestItems as $index => $item)
                                    <tr>
                                        <td>{{ $index + 1 }}</td>
                                        <td class="text-start">{{ $item->service->name ?? '-' }}</td>
                                        <td>{{ $item->certificate_holder_name }}</td>
                                        <td>{{ number_format($item->price, 2) }}</td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="4" class="text-muted text-center">No items found.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                    <div class="border-top border-top-dashed mt-3 pt-2">
                        <table class="table table-borderless table-nowrap align-middle mb-0 ms-auto" style="width:250px">
                            <tbody>
                                <tr>
                                    <td>Total</td>
                                    <td class="text-end">{{ number_format($request->total_cost, 2) }}
                                        {{ $request->invoice?->currency ?? 'USD' }}</td>
                                </tr>
                                <tr>
                                    <td>Paid</td>
                                    <td class="text-end">{{ number_format($request->invoice?->paid_amount ?? 0, 2) }}</td>
                                </tr>
                                <tr>
                                    <td>Balance</td>
                                    <td class="text-end">{{ number_format($request->invoice?->balance ?? 0, 2) }}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="mt-4">
                        <h6 class="text-muted text-uppercase fw-semibold mb-3">Payment Details:</h6>
                        <p class="text-muted mb-1">Payment Method: <span
                                class="fw-medium">{{ $request->invoice?->payment_method ?? '-' }}</span></p>
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
                        <strong>Payment Status:</strong>
                        {{ $request->payment_status ?? ($request->is_paid ? 'Paid' : 'Not Paid') }}
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-12">
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
                                <th>Status</th>
                                <th>Attachment</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($request->requestItems ?? [] as $i => $item)
                                @php
                                    $status = strtolower($item->is_approved);
                                @endphp

                                <tr>
                                    <td>{{ $i + 1 }}</td>
                                    <td>{{ optional($item->service)->name ?? $item->service_id }}</td>
                                    <td>{{ optional($item->service->serviceProvider)->name ?? $item->service_provider_id }}
                                    </td>
                                    <td>{{ $item->price ?? $item->service->amount }}</td>
                                    <td>{{ $item->certificate_holder_name }}</td>
                                    <td>{{ $item->certificate_index_number }}</td>

                                    <td>
                                        @if ($status == 0)
                                            <span class="badge bg-warning-subtle text-warning fs-11">REJECTED</span>
                                        @elseif ($status == 1)
                                            <span class="badge bg-success-subtle text-success fs-11">APPROVED</span>
                                        @else
                                            <span class="badge bg-secondary-subtle text-secondary fs-11">PENDING</span>
                                        @endif
                                    </td>
                                    <td>
                                        @if ($item->attachment)
                                            <button type="button" class="btn btn-sm btn-outline-primary"
                                                onclick="previewDocument('{{ asset('storage/' . $item->attachment) }}', '{{ $item->certificate_holder_name }}', '{{ $item->certificate_index_number }}', '{{ $item->id }}', '{{ $item->service->name }}', '{{ $item->service->serviceProvider->name }}')">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-eye" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                                    <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                                    <path d="M10 12a2 2 0 1 0 4 0a2 2 0 0 0 -4 0"></path>
                                                    <path d="M21 12c-2.4 4 -5.4 6 -9 6c-3.6 0 -6.6 -2 -9 -6c2.4 -4 5.4 -6 9 -6c3.6 0 6.6 2 9 6"></path>
                                                </svg>
                                                View
                                            </button>
                                        @else
                                            <span class="text-muted">-</span>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                            @if (empty($request->requestItems) || count($request->requestItems) == 0)
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

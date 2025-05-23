@extends('layouts.tabler.app')


@section('content')
    @php
        $breadcrumbs = [['name' => 'Home', 'url' => route('home')], ['name' => 'Settings', 'url' => route('settings')]];
    @endphp

    <div class="profile-foreground position-relative mx-n4 mt-n4">
        <div class="profile-wid-bg ">
            <img src="{{ URL::asset('build/images/profile-bg.jpg') }}" alt="" class="profile-wid-img" />
        </div>
    </div>

    <div class="pt-4 mb-4 pb-lg-4 profile-wrapper">
        <div class="row g-4">
            <div class="col-auto">
                {{-- <div
                    class="avatar-lg bg-primary p-2 d-flex text-black align-items-center justify-content-center rounded-circle fs-4 fw-bold">
                    {{ strtoupper(substr($embassy->name, 0, 1)) }}
                </div> --}}
            </div>
            <div class="col">
                <div class="p-2">
                    <h3 class="text-black mb-1">{{ $embassy->name }}</h3>
                    <p class="text-black text-opacity-75">{{ $embassy->id == 1 ? 'Ministry' : ucfirst($embassy->type) }}</p>
                    <div class="hstack text-black-50 gap-2">
                        {{-- <div><i class="ri-map-pin-user-line me-1 text-black"></i>{{ $embassy->country->name ?? 'N/A' }}
                        </div> --}}
                        {{-- <div><i class="ri-phone-line text-black me-1"></i>{{ $embassy->phone ?? 'N/A' }}</div> --}}
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Profile Details -->
    <div class="row">
        <!-- Left Column: Embassy Details & Accredited Countries -->
        <div class="col-xl-5 d-flex flex-column gap-3">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title mb-3">Embassy Details</h5>
                    <table class="table table-borderless mb-0">
                        <tbody>
                            <tr>
                                <th>Name:</th>
                                <td>{{ $embassy->name }}</td>
                            </tr>
                            <tr>
                                <th>Type:</th>
                                <td>{{ ucfirst($embassy->type) }}</td>
                            </tr>
                            <tr>
                                <th>Status:</th>
                                <td>
                                    <span class="badge bg-{{ $embassy->is_active ? 'success-subtle text-success' : 'secondary-subtle text-secondary' }}">
                                        {{ $embassy->is_active ? 'Active' : 'Inactive' }}
                                    </span>
                                </td>
                            </tr>
                            <tr>
                                <th>Email:</th>
                                <td>{{ $embassy->email ?? 'N/A' }}</td>
                            </tr>
                            <tr>
                                <th>Address:</th>
                                <td>{{ $embassy->countries->first()?->name ?? 'N/A' }}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title mb-3">Accredited Countries</h5>
                    @if ($embassy->countries->isEmpty())
                        <p class="text-muted">No accredited countries listed.</p>
                    @else
                        <ul class="list-group list-group-flush">
                            @foreach ($embassy->countries as $country)
                                <li class="list-group-item">
                                    {{ $country->name }}
                                    <span class="float-end">
                                        <a class="btn btn-danger btn-sm"><i class="bx bxs-trash"
                                                wire:click="removeCountry({{ $country->id }})"></i>
                                        </a>
                                    </span>
                                </li>
                            @endforeach
                        </ul>
                    @endif
                </div>
            </div>
        </div>
        <!-- Right Column: Services Fees -->
        <div class="col-xl-7">
            <div class="card h-95">
                <div class="card-body">
                    <div class="d-flex align-items-center justify-content-between mb-3">

                        <h5 class="card-title mb-3">Services Fees</h5>
                        @include('embassies._generate_bills_modal')
                        <a class="btn btn-success btn-sm d-flex justify-content-center" href="javascript:void(0)" title="Generate Bills"
                            data-bs-toggle="modal" data-bs-target="#generateBillsModal{{ $embassy->country_id }}">
                            <p class="mb-0">Generate Bills</p>
                        </a>
                    </div>
                    @if ($embassy->billableItems == null)
                        <p class="text-muted">No service fees</p>
                    @else
                        <table class="table table-bordered table-striped table-sm datatable">
                            <thead>
                                <tr>
                                    <th>Service</th>
                                    <th>Service Provider</th>
                                    <th>Price</th>
                                    <th>Currency</th>
                                    <th>Country</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($embassy->billableItems as $bill)
                                    <tr>
                                        <td>{{ $bill->billable->name }}</td>
                                        <td>{{ $bill->billable->serviceProvider->name }}</td>
                                        <td class="text-end">{{ $bill->price }}</td>
                                        <td>{{ $bill->currency }}</td>
                                        <td>{{ $bill->country->name }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection

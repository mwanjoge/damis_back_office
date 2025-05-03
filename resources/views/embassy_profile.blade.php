@extends('layouts.master')

@section('content')
@include("modal.alert")
    <div class="profile-foreground position-relative mx-n4 mt-n4">
        <div class="profile-wid-bg">
            <img src="{{ URL::asset('build/images/profile-bg.jpg') }}" alt="" class="profile-wid-img" />
        </div>
    </div>

    <div class="pt-4 mb-4 pb-lg-4 profile-wrapper">
        <div class="row g-4">
            <div class="col-auto">
                <div
                    class="avatar-lg bg-primary text-white d-flex align-items-center justify-content-center rounded-circle fs-4 fw-bold">
                    {{ strtoupper(substr($embassy->name, 0, 1)) }}
                </div>
            </div>
            <div class="col">
                <div class="p-2">
                    <h3 class="text-white mb-1">{{ $embassy->name }}</h3>
                    <p class="text-white text-opacity-75">{{ ucfirst($embassy->type) }}</p>
                    <div class="hstack text-white-50 gap-2">
                        <div><i class="ri-map-pin-user-line me-1"></i>{{ $embassy->address ?? 'N/A' }}</div>
                        <div><i class="ri-phone-line me-1"></i>{{ $embassy->phone ?? 'N/A' }}</div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Profile Details -->
    <div class="row">
        <div class="col-xl-5">
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
                                    <span class="badge bg-{{ $embassy->is_active ? 'success' : 'secondary' }}">
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
                                <td>{{ $embassy->address ?? 'N/A' }}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <!-- Accredited Countries -->
        <div class="col-xl-7">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title mb-3">Accredited Countries</h5>
                    @if ($embassy->countries->isEmpty())
                        <p class="text-muted">No accredited countries listed.</p>
                    @else
                        <ul class="list-group list-group-flush">
                            @foreach ($embassy->countries as $country)
                                <li class="list-group-item">
                                    @include('embassies._generate_bills_modal')
                                    {{ $country->name }}
                                    {{-- <form method="POST" action="{{ route('embassy.destroy', [$embassy->id, $country->id]) }}">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-outline-danger"><i class="bx bxs-trash"></i></button>
                                    </form> --}}
                                    <span class="float-end">
                                        <a class="btn btn-success"><i class="bx bxs-trash text-danger" wire:click="removeCountry({{ $country->id }})"></i></a>
                                        <a class="btn btn-success" href="javascript:void(0)" title="Generate Bills" data-bs-toggle="modal" data-bs-target="#generateBillsModal{{ $country->id }}">
                                            <i class="bx bx-money"></i>
                                        </a>
                                    </span>

                                </li>
                            @endforeach
                        </ul>
                    @endif
                </div>
            </div>
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title mb-3">Services Fees</h5>
                    @if ($embassy->billableItems == null)
                        <p class="text-muted">No service fees</p>
                    @else
                        <table class="table table-bordered table-striped table-sm">
                            <thead>
                                <tr>
                                    <th>Service</th>
                                    <th>Service Provider</th>
                                    <th>Price</th>
                                    <th>Currency</th>
                                </tr>
                            @foreach ($embassy->billableItems as $bill)
                                <tr>
                                    <td>{{ $bill->billable->name }}</td>
                                    <td>{{ $bill->billable->serviceProvider->name }}</td>
                                    <td class="text-end">{{ $bill->price }}</td>
                                    <td>{{ $bill->currency }}</td>
                                </tr>
                            @endforeach
                        </table>
                       
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection
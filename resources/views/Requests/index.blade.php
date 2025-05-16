@extends('layouts.tabler.app')
@section('title', 'Requests')
@section('content')
    @php
    $breadcrumbs = [
        ['name' => 'Home', 'url' => route('home')],
        ['name' => 'Requests', 'url' => route('requests.index')]
    ];
    @endphp

    {{-- @include('layouts.breadcrumb') --}}

    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="mb-0">Requests</h2>
        <a href="{{ route('requests.create') }}" class="btn btn-primary">Create Request</a>
    </div>
    <div class="row g-4">
        <div class="col-md-3">
            @livewire('request-summary-bar', ['summary' => $summary])
        </div>
        <div class="col-md-9">
            <div class="card h-100 mb-5">
                <div class="card-body">
                    @livewire('request-table', ['requests' => $requests])
                </div>
            </div>
        </div>
    </div>
@endsection

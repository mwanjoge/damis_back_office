@extends('layouts.tabler.app')
@section('title', 'Requests')
@section('content')
<<<<<<< HEAD
<div class="row">
        <div class="col-xxl-5">
            <div class="d-flex flex-column h-100">
                <div class="row h-100">
                    <div class="col">
                        <div class="d-flex justify-content-between align-items-center mb-4">
                            <h2 class="mb-0">Requests</h2>
                            <a href="{{ route('requests.create') }}" class="btn btn-primary mt-5">Create Request</a>
                        </div>
                    </div>
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
=======
    @php
    $breadcrumbs = [
        ['name' => 'Home', 'url' => route('home')],
        ['name' => 'Requests', 'url' => route('requests.index')]
    ];
    @endphp

    @include('layouts.breadcrumb')

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
>>>>>>> 701fd51ddf4f8694b3c941a2466a9f682904f9d3
                </div>
            </div>
        </div>
    </div>
@endsection

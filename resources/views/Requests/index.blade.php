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

    <div class="page-header d-print-none mb-4">
        <div class="container-xl">
            <div class="row g-2 align-items-center">
                <div class="col">
                    <h2 class="page-title">Requests</h2>
                </div>
                <div class="col-auto ms-auto">
                    <a href="{{ route('requests.create') }}" class="btn btn-primary">
                        <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M12 5l0 14" /><path d="M5 12l14 0" /></svg>
                        Create Request
                    </a>
                </div>
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
    </div>
@endsection

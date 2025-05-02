@extends('layouts.master')
@section('title', '')
@section('content')
<div class="d-flex justify-content-between align-items-center mb-3">
    <h2 class="mb-0">Requests</h2>
    <a href="{{ route('requests.create') }}" class="btn btn-primary">Create Request</a>
</div>
<div class="row">
    <div class="col-md-3 mb-8">
        <div class="col">
            @livewire('request-summary-bar', ['summary' => $summary])
        </div>
    </div>
    <div class="col-md-9">
        @livewire('request-table', ['requests' => $requests])
    </div>
</div>
@endsection
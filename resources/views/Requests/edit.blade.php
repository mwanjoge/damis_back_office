@extends('layouts.layouts-horizontal')
@section('title', 'Edit Request')
@section('content')
    @php
    $breadcrumbs = [
        ['name' => 'Home', 'url' => route('home')],
        ['name' => 'Requests', 'url' => route('requests.index')],
        ['name' => 'Edit Request', 'url' => url()->current()]
    ];
    @endphp

    @include('layouts.breadcrumb')

    <div class="container">
        <h1>Edit Request</h1>
        <form action="{{ route('request.update', $request) }}" method="POST">
            @csrf
            @method('PUT')
            @include('request.fields')
            <button type="submit" class="btn btn-primary">Update</button>
        </form>
    </div>
@endsection

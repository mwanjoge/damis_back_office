@extends('layouts.layouts-horizontal')
@section('title', 'Edit Request')
@section('content')
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
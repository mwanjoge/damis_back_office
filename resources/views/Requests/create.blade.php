@extends('layouts.master')
@section('title', 'Create Request')
@section('content')
    <div class="container">
        <h1>Create Request</h1>
        <form action="{{ route('request.store') }}" method="POST">
            @csrf
            @include('request.fields')
            <button type="submit" class="btn btn-primary">Save</button>
        </form>
    </div>
@endsection
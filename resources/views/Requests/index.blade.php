@extends('layouts.master')
@section('title', 'Requests')
@section('content')
    <div class="container">
        <h1>Requests</h1>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Tracking Number</th>
                    <th>Status</th>
                    <th>Type</th>
                    <th>Total Cost</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($requests as $request)
                    <tr>
                        <td>{{ $request->id }}</td>
                        <td>{{ $request->tracking_number }}</td>
                        <td>{{ $request->status }}</td>
                        <td>{{ $request->type }}</td>
                        <td>{{ $request->total_cost }}</td>
                        <td>
                            <a href="{{ route('requests.show', $request) }}" class="btn btn-info btn-sm">Show</a>
                         </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
@extends('layouts.master')
@section('title', 'Show Employee')
@section('content')
<div class="row mt-4">
    <div class="col-lg-8 mx-auto">
        <div class="card">
            <div class="card-header">
                <h4>Employee Details</h4>
            </div>
            <div class="card-body">
                <table class="table table-bordered">
                    <tbody>
                        <tr><th>Full Name</th><td>{{ $employee->first_name }} {{ $employee->middle_name ? $employee->middle_name . ' ' : '' }}{{ $employee->last_name }}</td></tr>
                        <tr><th>Account</th><td>{{ optional($employee->account)->name ?? $employee->account_id }}</td></tr>
                        <tr><th>Department</th><td>{{ optional($employee->department)->name ?? $employee->depertment_id }}</td></tr>
                        <tr><th>Designation</th><td>{{ optional($employee->designation)->name ?? $employee->designation_id }}</td></tr>
                        <tr><th>Email</th><td>{{ $employee->email }}</td></tr>
                        <tr><th>Status</th><td><span class="badge {{ $employee->is_active ? 'bg-success' : 'bg-danger' }}">{{ $employee->is_active ? 'Active' : 'Inactive' }}</span></td></tr>
                        <tr><th>Created At</th><td>{{ $employee->created_at }}</td></tr>
                        <tr><th>Updated At</th><td>{{ $employee->updated_at }}</td></tr>
                    </tbody>
                </table>
                </div>
        </div>
    </div>
</div>
@endsection

@extends('layouts.tabler.app')
@section('title', 'Show Employee')
@section('content')
<div class="row mt-4">
    <div class="col-lg-8">
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
    <div class="col-lg-4">
        <div class="card">
            <div class="card-header">
                <h4>Authentication Details</h4>
            </div>
            <div class="card-body">
                <table class="table table-bordered">
                    <tbody>
                        <tr><th>Username</th><td>{{ $employee->user->username }}</td></tr>
                        <tr><th>Email</th><td>{{ $employee->user->email }}</td></tr>
                        <tr><th>Phone</th><td>{{ $employee->user->phone }}</td></tr>
                        <tr><th>Role</th><td>{{ optional($employee->user->roles)->name ?? 'No role assigned' }}</td></tr>
                        <tr><th>Status</th><td><span class="badge {{ $employee->user->is_active ? 'bg-success' : 'bg-danger' }}">{{ $employee->user->is_active ? 'Active' : 'Inactive' }}</span></td></tr>         
                    </tbody>
                </table>
            </div>
        </div>

        <div class="card mt-2">
            <div class="card-header">
                <h4>Permissions</h4>
            </div>
            <div class="card-body">
                <div class="row">
                    @if ($employee->user->getPermissionsViaRoles()->isEmpty())
                        <div class="col-12">
                            <i class="bx bx-x"></i>
                            <span class="text-muted">No permissions assigned</span>
                        </div>
                    @else
                        @foreach ($employee->user->getPermissionsViaRoles() as $permission)
                            <div class="col-6">
                                <i class="bx bx-check"></i>
                                {{ str_replace('_', ' ', $permission->name) }}
                            </div>
                        @endforeach
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

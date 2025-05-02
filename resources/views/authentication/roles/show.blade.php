@extends('layouts.master')

@section('title')
    Role Permissions - {{ ucfirst($role->name) }}
@endsection

@section('content')
    <div class="container my-5">
        <a href="{{ route('roles.index') }}" class="btn btn-secondary mb-4">← Back to Roles</a>

        <h4 class="mb-3 text-primary">Manage Permissions for <strong>{{ ucfirst($role->name) }}</strong></h4>

        <form action="#" method="POST" class="p-4 border rounded bg-white shadow-sm">
            @csrf
            @method('PUT')

            @foreach ($groupedPermissions as $group => $permissions)
                <div class="mb-4 p-3">
                    <h5 class="text-secondary">{{ $group }} Permissions</h5>
                    <div class="row mx-3">
                        @foreach ($permissions as $permission)
                            <div class="col-md-3 col-sm-6 mb-2">
                                <div class="form-check  rounded p-2">
                                    <input class="form-check-input" type="checkbox" name="permissions[]"
                                        value="{{ $permission->id }}" id="perm-{{ $role->id }}-{{ $permission->id }}"
                                        {{ in_array($permission->id, $role->permission_ids ?? []) ? 'checked' : '' }}>
                                    <label class="form-check-label text-capitalize"
                                        for="perm-{{ $role->id }}-{{ $permission->id }}">
                                        {{ str_replace('_', ' ', $permission->name) }}
                                    </label>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            @endforeach
            <div class="text-end">
                <button type="submit" class="btn btn-primary">Save Permissions</button>
            </div>

        </form>
    </div>
@endsection

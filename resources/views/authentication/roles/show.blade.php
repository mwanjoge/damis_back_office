@extends('layouts.tabler.app')
@include('modal.alert')
@section('title')
    Role Permissions - {{ ucfirst($role->name ?? 'Unknown') }}
@endsection

@section('content')
    <div class="container my-5">
        <a href="{{ route('roles.index') }}" class="btn btn-secondary mb-4">← Back to Roles</a>

        <h4 class="mb-3 text-primary">
            Manage Permissions for <strong>{{ ucfirst($role->name ?? 'Unknown') }}</strong>
        </h4>

        <form action="{{ route('roles.update-permissions', $role->id) }}" method="POST"
            class="p-4 border rounded bg-white shadow-sm">
            @csrf
            @method('PUT')

            <div class="mb-3 float-end">
                <input type="checkbox" id="select-all"> <label for="select-all">Select All Permissions</label>
            </div>

             <div class="row mx-1">
                @foreach ($groupedPermissions ?? [] as $group => $permissions)
                    <div class="col-md-4 mb-4 p-3">
                        <h5 class="text-secondary">{{ $group ?? 'General' }} Permissions</h5>
                        <div class=" column-cols-1 column-cols-md-3 column-cols-lg-4 column-cols-xl-5 mx-1">
                            @foreach ($permissions ?? [] as $permission)
                                <div class="col mb-2">
                                    <div class="form-check rounded p-2">
                                        <input class="form-check-input permission-checkbox" type="checkbox" name="permissions[]"
                                            value="{{ $permission->name }}"
                                            id="perm-{{ $role->name ?? '0' }}-{{ $permission->id }}"
                                            {{ $role->permissions->contains('name', $permission->name) ? 'checked' : '' }}>
                                        <label class="form-check-label text-capitalize"
                                            for="perm-{{ $role->id ?? '0' }}-{{ $permission->id }}">
                                            {{ str_replace('_', ' ', $permission->name ?? 'Unknown') }}
                                        </label>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endforeach
            </div>
            <div class="text-end">
                <button type="submit" class="btn btn-primary">Save Permissions</button>
            </div>
        </form>
    </div>

    <script>
        document.getElementById('select-all').addEventListener('change', function() {
            let checkboxes = document.querySelectorAll('.permission-checkbox');
            checkboxes.forEach(cb => cb.checked = this.checked);
        });
    </script>
@endsection

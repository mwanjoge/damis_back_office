{{-- @extends('layouts.master') --}}
@include('authentication.roles.role_modal')

{{-- @section('content') --}}
<div class="container">
    <div class="d-flex justify-content-end align-items-center">
        {{-- <h4 class="fw-bold">Roles</h4> --}}
        <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#roleModal"
            onclick="openRoleModal('create')">+ Create New Role</button>
    </div>

    <div class="card">
        <div class="card-body">
            <table class="table  table-striped">
                <thead class="">
                    <tr class="bg-light text-dark">
                        <th>#</th>
                        <th>Role Name</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($roles as $index => $role)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td class="text-capitalize">{{ $role->name }}</td>
                            <td>
                                <a href="{{ route('roles.show', $role->id) }}" class="btn btn-sm btn-primary">
                                    <i class="bx bx-show"></i>
                                </a>
                                <button class="btn btn-sm btn-warning" data-bs-toggle="modal"
                                    data-bs-target="#roleModal"
                                    onclick="openRoleModal('edit', {{ $role->id }}, '{{ $role->name }}')">
                                    <i class="bx bx-edit-alt"></i>
                                </button>
                                <a href="#" class="btn btn-sm btn-danger">
                                    <i class="bx bxs-trash"></i>
                                </a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

        </div>
    </div>
</div>
{{-- @endsection --}}


@push('scripts')
    <script>
        function openRoleModal(mode, id = null, name = '') {
            const modalTitle = document.getElementById('roleModalLabel');
            const form = document.getElementById('roleForm');
            const nameInput = document.getElementById('roleName');
            const methodInput = document.getElementById('_method_field');
            const roleIdInput = document.getElementById('roleId');

            if (mode === 'edit') {
                modalTitle.textContent = 'Edit Role';
                nameInput.value = name;
                form.action = `/roles/${id}`;
                methodInput.value = 'PUT';
                roleIdInput.value = id;
            } else {
                modalTitle.textContent = 'Create New Role';
                nameInput.value = '';
                form.action = '/roles';
                methodInput.value = 'POST';
                roleIdInput.value = '';
            }
        }
    </script>
@endpush

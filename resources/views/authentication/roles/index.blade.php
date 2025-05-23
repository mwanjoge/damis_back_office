{{-- @extends('layouts.master') --}}
@include('authentication.roles.role_modal')

{{-- @section('content') --}}
<div class="container">
    @include('modal.alert')
    <div class="d-flex justify-content-end align-items-center py-2">
        {{-- <h4 class="fw-bold">Roles</h4> --}}
        <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#roleModal"
            onclick="openRoleModal('create')">+ Create New Role</button>
    </div>

    <div class="table-responsive card-table">
        <table class="table table-sm table-striped">
                <thead>
                    <tr class="bg-light text-dark">
                        <th>#</th>
                        <th>Role Name</th>
                        <th>Permissions</th>
                        <th class="text-end" style="width: 180px;">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($roles as $index => $role)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td class="text-capitalize">{{ $role->name }}</td>
                            <td>{{ $role->permissions->count() }} permissions</td>
                            <td class="text-end">
                                <a href="{{ route('roles.show', encode([$role->id])) }}" class="btn btn-sm btn-primary">
                                    <i class="bx bx-show"></i>
                                </a>
                                <button class="btn btn-sm btn-warning" data-bs-toggle="modal"
                                    data-bs-target="#roleModal"
                                    onclick="openRoleModal('edit', {{ $role->id }}, '{{ addslashes($role->name) }}')">
                                    <i class="bx bx-edit-alt"></i>
                                </button>

                                  {{-- <form id="delete-form-{{ $service->id }}" method="POST"
                                action="{{ route('service.destroy', $service->id) }}" style="display: none;">
                                @csrf
                                @method('DELETE')
                            </form>
                            <button class="btn btn-danger btn-sm" onclick="confirmDelete({{ $service->id }})">
                                <i class="bx bx-trash-alt"></i>
                            </button> --}}

                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
    </div>
</div>
{{-- @endsection --}}


    <script>
        const createRoleUrl = "{{ route('roles.store') }}";
        const updateRoleUrlTemplate = "{{ route('roles.update', ['role' => '__ROLE_ID__']) }}";

        function openRoleModal(mode, id = null, name = '') {
            console.log('Editing Role:', id, name);

            const modalTitle = document.getElementById('roleModalLabel');
            const form = document.getElementById('roleForm');
            const nameInput = document.getElementById('roleName');
            const methodInput = document.getElementById('_method_field');
            const roleIdInput = document.getElementById('roleId');

            if (mode === 'edit') {
                modalTitle.textContent = 'Edit Role';
                nameInput.value = name;
                form.action = updateRoleUrlTemplate.replace('__ROLE_ID__', id);
                methodInput.value = 'PUT';
                roleIdInput.value = id;
            } else {
                modalTitle.textContent = 'Create New Role';
                nameInput.value = '';
                form.action = createRoleUrl;
                methodInput.value = 'POST';
                roleIdInput.value = '';
            }
        }
    </script>

{{-- @section('content') --}}
@include('modal.alert')
<div class="container">
    {{-- <div class="d-flex justify-content-end align-items-center">

        <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#userModal"
            onclick="openUserModal('create')">+ Add User</button>
    </div> --}}
    <div class="card">
        <div class="card-body">
            <table class="table table-hover">
                <thead class="bg-light text-dark">
                    <tr>
                        <th>#</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Phone</th>
                        <th>Role</th>
                        <th class="text-end" style="width: 180px;">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($users as $index => $user)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $user->name }}</td>
                            <td>{{ $user->email }}</td>
                            <td>{{ $user->phone }}</td>
                            <td class="text-capitalize">
                                @if ($user->roles->isEmpty())
                                    <span class="text-muted">No role assigned</span>
                                @else
                                    @foreach ($user->roles as $role)
                                        <span class="text-capitalize">{{ $role->name }}</span>
                                    @endforeach
                                @endif

                            </td>
                            <td class="text-end">
                                <button class="btn btn-sm btn-warning" data-bs-toggle="modal"
                                    data-bs-target="#userModal"
                                    onclick="openUserModal('edit', {{ $user->id }}, '{{ $user->name }}', {{ $user->role_id ?? 'null' }})">
                                    <i class="bx bx-lock-alt"></i>
                                </button>
                                {{-- <button class="btn btn-sm btn-danger"
                                    onclick="alert('Delete user ID: {{ $user->id }}')">
                                    <i class="bx bxs-trash"></i>
                                </button> --}}
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

</div>

@include('authentication.users.users_modal', ['roles' => $roles])

<script>
    function openUserModal(mode, id = '', name = '', roleId = '') {
        const modalTitle = document.getElementById('userModalLabel');
        const userIdField = document.getElementById('userId');
        const nameField = document.getElementById('userName');
        const roleSelect = document.getElementById('userRole');

        nameField.value = name;
        roleSelect.value = roleId || '';

        if (mode === 'edit') {
            modalTitle.innerText = 'Assign Role';
            userIdField.value = id;
        } else {
            modalTitle.innerText = 'Add New User';
            userIdField.value = '';
            nameField.value = '';
            roleSelect.value = '';
        }
    }
</script>

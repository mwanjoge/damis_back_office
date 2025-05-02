{{-- @section('content') --}}
 @php
        $roles = [(object) ['id' => 1, 'name' => 'admin'], (object) ['id' => 2, 'name' => 'editor']];

        $users = [
            (object) [
                'id' => 1,
                'name' => 'John Doe',
                'email' => 'john@example.com',
                'phone' => '0712345678',
                'role_id' => 1,
            ],
            (object) [
                'id' => 2,
                'name' => 'Jane Smith',
                'email' => 'jane@example.com',
                'phone' => '0789123456',
                'role_id' => 2,
            ],
        ];
    @endphp

    <div class="container">
        <div class="d-flex justify-content-end align-items-center">
           
            <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#userModal"
                onclick="openUserModal('create')">+ Add User</button>
        </div>
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
                                    {{ collect($roles)->firstWhere('id', $user->role_id)->name ?? '-' }}</td>
                                <td class="text-end">
                                    <button class="btn btn-sm btn-warning" data-bs-toggle="modal"
                                        data-bs-target="#userModal"
                                        onclick="openUserModal('edit', {{ $user->id }}, '{{ $user->name }}', '{{ $user->email }}', '{{ $user->phone }}', {{ $user->role_id ?? 'null' }})">
                                        <i class="bx bx-edit-alt"></i>
                                    </button>
                                    <button class="btn btn-sm btn-danger"
                                        onclick="alert('Delete user ID: {{ $user->id }}')">
                                        <i class="bx bxs-trash"></i>
                                    </button>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

    </div>

    {{-- Include the modal --}}
    @include('authentication.users.users_modal', ['roles' => $roles])
{{-- @endsection --}}

@push('scripts')
    <script>
        function openUserModal(mode, id = '', name = '', email = '', phone = '', roleId = '') {
            const modalTitle = document.getElementById('userModalLabel');
            const userIdField = document.getElementById('userId');
            const nameField = document.getElementById('userName');
            const emailField = document.getElementById('userEmail');
            const phoneField = document.getElementById('userPhone');
            const roleSelect = document.getElementById('userRole');

            nameField.value = name;
            emailField.value = email;
            phoneField.value = phone;
            roleSelect.value = roleId || '';

            if (mode === 'edit') {
                modalTitle.innerText = 'Edit User';
                userIdField.value = id;
            } else {
                modalTitle.innerText = 'Add New User';
                userIdField.value = '';
                nameField.value = '';
                emailField.value = '';
                phoneField.value = '';
                roleSelect.value = '';
            }
        }
    </script>
@endpush
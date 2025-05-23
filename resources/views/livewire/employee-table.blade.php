<div>
    @include('modal.alert')
    <div class="tab-pane" id="employee" role="tabpanel">
        <div class="text-end pb-4">
            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target=".employee-modal"
                onclick="openEmployeeModal()">
                New Employee
            </button>
        </div>

        <div class="table-responsive">
            <table class="table table-striped table-sm table-nowrap mb-0  datatable">
                <thead class="text-muted table-light">
                    <tr>
                        <th>#</th>
                        <th>First Name</th>
                        <th>Last Name</th>
                        <th>Email</th>
                        <th>Department</th>
                        <th>Designation</th>
                        <th>Status</th>
                        <th class="text-end" style="width: 220px;">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($employees as $employee)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $employee->first_name }}</td>
                            <td>{{ $employee->last_name }}</td>
                            <td>{{ $employee->email }}</td>
                            <td>{{ $employee->department->name ?? 'N/A' }}</td>
                            <td>{{ $employee->designation->name ?? 'N/A' }}</td>
                            <td><span
                                    class="badge {{ $employee->is_active ? 'bg-success-subtle text-success' : 'bg-danger-subtle text-danger' }}">{{ $employee->is_active ? 'Active' : 'Inactive' }}</span>
                            </td>
                            <td class="text-end">
                                <button class="btn btn-warning btn-sm" data-bs-toggle="modal"
                                    data-bs-target=".employee-modal"
                                    onclick="openEmployeeModal({{ json_encode($employee) }}, '{{ encode([$employee->id]) }}')">
                                    <i class="bx bx-pencil"></i>
                                </button>
                                <form id="delete-form-{{ $employee->id }}" method="POST"
                                    action="{{ route('employee.destroy', encode([$employee->id])) }}"
                                    style="display: none;">
                                    @csrf
                                    @method('DELETE')
                                </form>
                                <button class="btn btn-danger btn-sm" onclick="confirmDelete({{ $employee->id }})">
                                    <i class="bx bx-trash-alt"></i>
                                </button>
                                <a href="{{ route('employee.show', encode([$employee->id])) }}" class="btn btn-info btn-sm">
                                    <i class="bx bx-detail"></i>
                                </a>
                                <form method="POST" action="{{ route('employee.reset-password', $employee->id) }}"
                                    style="display:inline-block;"
                                    onsubmit="return confirm('Are you sure you want to reset the password to default?');">
                                    @csrf
                                    <button type="submit" class="btn btn-secondary btn-sm" title="Reset Password">
                                        <i class="bx bx-lock-open-alt"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
    <!-- Employee Modal -->
    <div wire:ignore.self class="modal fade employee-modal" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <form id="employeeForm" method="post" action="{{ route('employee.store') }}">
                    @csrf
                    <input type="hidden" name="_method" id="employeeMethod" value="POST">
                    <input type="hidden" name="id" id="employeeId">
                    <div class="modal-header text-center">
                        <h4 id="employeeModalTitle">Add New Employee</h4>
                    </div>
                    <div class="modal-body px-5">
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul class="mb-0">
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        <div class="mb-3">
                            <label class="form-label">First Name</label>
                            <input type="text" name="first_name" id="employeeFirstName" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Last Name</label>
                            <input type="text" name="last_name" id="employeeLastName" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Email</label>
                            <input type="email" name="email" id="employeeEmail" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Department</label>
                            <select name="department_id" id="employeeDepartmentId" data-choices class="form-select">
                                <option value="">Select Department</option>
                                @foreach ($departments as $department)
                                    <option value="{{ $department->id }}">{{ $department->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Designation</label>
                            <select name="designation_id" id="employeeDesignationId" data-choices class="form-select">
                                <option value="">Select Designation</option>
                                @foreach ($designations as $designation)
                                    <option value="{{ $designation->id }}">{{ $designation->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="hstack gap-2 justify-content-center mt-4">
                            <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Save Employee</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <script>
        function openEmployeeModal(data = {}, encodedId = '') {
            const isEdit = !!data.id;
            const form = document.getElementById('employeeForm');
            const methodInput = document.getElementById('employeeMethod');
            const storeUrl = "{{ route('employee.store') }}";
            const updateUrlTemplate = "{{ url('employee') }}/:id";

            document.getElementById('employeeModalTitle').innerText = isEdit ? 'Edit Employee' : 'Add New Employee';

            methodInput.value = isEdit ? 'PUT' : 'POST';
            form.action = isEdit ? updateUrlTemplate.replace(':id', encodedId) : storeUrl;

            // populate form fields
            document.getElementById('employeeId').value = data.id || '';
            document.getElementById('employeeFirstName').value = data.first_name || '';
            document.getElementById('employeeLastName').value = data.last_name || '';
            document.getElementById('employeeEmail').value = data.email || '';
            document.getElementById('employeeDepartmentId').value = data.department_id || '';
            document.getElementById('employeeDesignationId').value = data.designation_id || '';
            document.getElementById('employeeStatus').value = data.is_active ? '1' : '0';

            new bootstrap.Modal(document.querySelector('.employee-modal')).show();
        }

    </script>
</div>
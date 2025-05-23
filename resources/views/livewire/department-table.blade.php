@include('modal.alert')
                            <div>
                                <div class="tab-pane" id="department" role="tabpanel">
                                    <div class="text-end pb-4">
                                        <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                                            data-bs-target=".department-modal" onclick="openDepartmentModal()">
                                            New Department
                                        </button>
                                    </div>
                                    <div class="table-responsive table-card">
                                        <table class="table table-striped table-sm align-middle table-nowrap mb-0 datatable">
                                            <thead class="text-muted table-light">
                                                <tr>
                                                    <th class="text-start">#</th>
                                                    <th>Department</th>
                                                    <th class="text-end" style="width: 180px;">Actions</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @forelse ($departments as $department)
                                                    <tr>
                                                        <td class="text-start">{{ $loop->iteration }}</td>
                                                        <td>{{ $department->name }}</td>
                                                        <td class="text-end">
                                                            <button class="btn btn-warning btn-sm" data-bs-toggle="modal"
                                                                data-bs-target=".department-modal"
                                                                onclick="openDepartmentModal({{ json_encode($department) }}, '{{ encode([$department->id]) }}')">
                                                                <i class="bx bx-pencil"></i>
                                                            </button>
                                                            <form id="delete-form-{{ $department->id }}" method="POST"
                                                                action="{{ route('department.destroy', encode([$department->id])) }}"
                                                                style="display: none;">
                                                                @csrf
                                                                @method('DELETE')
                                                            </form>
                                                            <button class="btn btn-danger btn-sm"
                                                                onclick="confirmDelete({{ $department->id }})">
                                                                <i class="bx bx-trash-alt"></i>
                                                            </button>
                                                        </td>
                                                    </tr>
                                                @empty
                                                @endforelse
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                <!-- Department Modal -->
                                <div wire:ignore.self class="modal fade department-modal" tabindex="-1" role="dialog" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered">
                                        <div class="modal-content">
                                            <form id="departmentForm" method="post" action="{{ route('department.store') }}">
                                                @csrf
                                                <div class="modal-header text-center">
                                                    <h4 id="departmentModalTitle">Add New Department</h4>
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
                                                    <input type="hidden" name="_method" id="departmentMethod" value="POST">
                                                    <input type="hidden" name="id" id="departmentId">
                                                    <div class="mb-3">
                                                        <label class="form-label">Department Name</label>
                                                        <input type="text" name="name" id="departmentName" class="form-control" required>
                                                    </div>
                                                    <div class="hstack gap-2 justify-content-center mt-4">
                                                        <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                                                        <button type="submit" class="btn btn-primary">Save Department</button>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                                <script>
                                    function openDepartmentModal(data = {}, encodedId = '') {
                                        const isEdit = !!data.id;
                                        document.getElementById('departmentModalTitle').innerText = isEdit ? 'Edit Department' : 'Add New Department';
                                        document.getElementById('departmentId').value = data.id || '';
                                        document.getElementById('departmentName').value = data.name || '';

                                        const methodInput = document.getElementById('departmentMethod');
                                        const form = document.getElementById('departmentForm');
                                        const storeUrl = "{{ route('department.store') }}";
                                        const updateUrlTemplate = "{{ route('department.update', ['id' => ':id']) }}";

                                        if (isEdit) {
                                            methodInput.value = 'PUT';
                                            form.action = updateUrlTemplate.replace(':id', encodedId);
                                        } else {
                                            methodInput.value = 'POST';
                                            form.action = storeUrl;
                                        }

                                        new bootstrap.Modal(document.querySelector('.department-modal')).show();
                                    }

                                    function confirmDelete(id) {
                                        if (confirm('Are you sure you want to delete this department?')) {
                                            document.getElementById('delete-form-' + id).submit();
                                        }
                                    }
                                </script>
                            </div>

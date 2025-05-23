@include('modal.alert')
<div>

    <div class="tab-pane" id="designation" role="tabpanel">
        <div class="text-end pb-4">
            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target=".designation-modal"
                onclick="openDesignationModal()">
                New Designation
            </button>
        </div>

        <div class="table-responsive table-card">
            <table class="table table-sm table-striped table-centered align-middle datatable table-nowrap mb-0">
                <thead class="text-muted table-light">
                    <tr>
                        <th>#</th>
                        <th>Designation</th>
                        <th>Account</th>
                        <th class="text-end" style="width: 180px;">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($designations as $designation)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $designation->name }}</td>
                            <td>{{ $designation->account->name ?? 'N/A' }}</td>
                            <td class="text-end">
                                <button class="btn btn-warning btn-sm" data-bs-toggle="modal"
                                    data-bs-target=".designation-modal"
                                    onclick="openDesignationModal({{ $designation }},'{{ encode([$designation->id]) }}')">
                                    <i class="bx bx-pencil"></i>
                                </button>

                                <form method="POST" action="{{ route('designation.destroy', encode([$designation->id])) }}"
                                    style="display:inline-block;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm">
                                        <i class="bx bx-trash-alt"></i>
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

    <!-- Designation Modal -->
    <div wire:ignore.self class="modal fade designation-modal" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <form id="designationForm" method="post" action="{{ route('designation.store') }}">
                    @csrf
                    <input type="hidden" name="_method" id="designationMethod" value="POST">
                    <input type="hidden" name="id" id="designationId">
                    <div class="modal-header text-center">
                        <h4 id="designationModalTitle">Add New Designation</h4>
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
                            <label class="form-label">Designation Name</label>
                            <input type="text" name="name" id="designationName" class="form-control">
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Account</label>
                            <select name="account_id" id="designationAccountId" data-choices class="form-select " required>
                                <option value="">Select Account</option>
                                @foreach ($accounts as $account)
                                    <option value="{{ $account->id }}">{{ $account->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="hstack gap-2 justify-content-center mt-4">
                            <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Save Designation</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        function openDesignationModal(data = {},encodedId='') {
            const isEdit = !!data.id;
            document.getElementById('designationModalTitle').innerText = isEdit ? 'Edit Designation' : 'Add New Designation';
            document.getElementById('designationMethod').value = isEdit ? 'PUT' : 'POST';
            document.getElementById('designationId').value = data.id || '';
            document.getElementById('designationName').value = data.name || '';
            document.getElementById('designationAccountId').value = data.account_id || '';

            const form = document.getElementById('designationForm');
            const formActionBase = "{{ url('designation') }}";
            form.action = isEdit ? `${formActionBase}/${encodedId}` : formActionBase;

            new bootstrap.Modal(document.querySelector('.designation-modal')).show();
        }

    </script>
</div>

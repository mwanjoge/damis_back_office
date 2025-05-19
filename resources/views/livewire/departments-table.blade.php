@include('modal.alert')
<div>
    <div class="tab-pane px-4" id="embassy" role="tabpanel">
        <div class="text-end pb-4">
            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target=".mission-modal"
                onclick="openMissionModal()">
                New Mission
            </button>
        </div>

        <div class="table-responsive table-card">
            <table class="table table-borderless table-centered align-middle table-nowrap mb-0 datatable">
                <thead class="text-muted table-light">
                    <tr>
                        <th>#</th>
                        <th>Mission</th>
                        <th>Type</th>
                        <th>Status</th>
                        <th class="text-end" style="width: 180px;">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($embassies as $embassy)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $embassy->name }}</td>
                            <td>{{ ucfirst($embassy->type) }}</td>
                            <td>{{ $embassy->is_active ? 'Active' : 'Inactive' }}</td>
                            <td class="text-end">
                                <button class="btn btn-warning btn-sm" data-bs-toggle="modal"
                                    data-bs-target=".mission-modal"
                                    onclick="openMissionModal({{ json_encode($embassy) }})">
                                    <i class="bx bx-edit-alt"></i>
                                </button>

                                <form method="POST" action="{{ route('embassy.destroy', $embassy->id) }}"
                                    style="display:inline-block;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm">
                                        <i class="bx bxs-trash"></i>
                                    </button>
                                </form>
                                <a href="{{ route('embassies.show', $embassy->id) }}" class="btn btn-info btn-sm">
                                    <i class="bx bxs-show"></i>
                                </a>

                            </td>
                        </tr>
                    @empty
                        {{-- <tr>
                            <td colspan="5" class="text-center">No missions found.</td>
                        </tr> --}}
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>


    <script>
        function openMissionModal(data = {}) {
            const isEdit = !!data.id;
            document.getElementById('missionModalTitle').innerText =isEdit ? 'Edit Mission' : 'Add New Mission';
            document.getElementById('missionMethod').value = isEdit ? 'PUT' : 'POST';
            document.getElementById('missionId').value = data.id || '';
            document.getElementById('missionName').value = data.name || '';
            document.getElementById('missionType').value = data.type || 'Embassy';
            document.getElementById('missionStatus').value = data.is_active ? '1' : '0';

            const formActionBase = "{{ url('embassy') }}";
            document.getElementById('missionForm').action = data.id ? `${formActionBase}/${data.id}` : formActionBase;

            const countrySelect = document.querySelector('select[name="country_id[]"]');

            // Reset all to unselected
            Array.from(countrySelect.options).forEach(option => {
                option.selected = false;
            });

            // Mark existing country IDs as selected
            if (data.countries) {
                data.countries.forEach(id => {
                    const option = Array.from(countrySelect.options).find(opt => opt.value == id);
                    if (option) option.selected = true;
                });
            }

            if ($(countrySelect).hasClass('js-example-basic-multiple')) {
                $(countrySelect).trigger('change');
            }

            new bootstrap.Modal(document.querySelector('.mission-modal')).show();
        }


        function confirmDelete(id, type) {
            if (confirm(`Are you sure you want to delete this ${type}?`)) {
                console.log(`Deleting ${type} with ID: ${id}`);
            }
        }
    </script>
</div>

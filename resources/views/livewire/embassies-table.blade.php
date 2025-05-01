@include("modal.alert")

<div class="tab-pane px-4" id="embassy" role="tabpanel">
    <div class="text-end pb-4">
        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target=".mission-modal"
            onclick="openMissionModal()">
            New Mission
        </button>
    </div>

    <div class="table-responsive table-card">
        <table class="table table-borderless table-centered align-middle table-nowrap mb-0">
            <thead class="text-muted table-light">
                <tr>
                    <th>#</th>
                    <th>Mission</th>
                    <th>Type</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($embassies as $embassy)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $embassy->name }}</td>
                        <td>{{ ucfirst($embassy->type) }}</td>
                        <td>{{ $embassy->is_active ? 'Active' : 'Inactive' }}</td>
                        <td>
                            <button class="btn btn-warning btn-sm" data-bs-toggle="modal"
                                data-bs-target=".mission-modal"
                                onclick="openMissionModal('{{ $embassy->id }}', '{{ $embassy->name }}', '{{ $embassy->type }}', '{{ $embassy->is_active }}')">
                                <i class="bx bx-edit-alt"></i>
                            </button>

                            <button class="btn btn-danger btn-sm"
                                onclick="confirmDelete({{ $embassy->id }}, 'mission')">
                                <i class="bx bxs-trash"></i>
                            </button>
                            <button class="btn btn-info btn-sm">
                                <i class="bx bxs-show"></i>
                            </button>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="text-center">No missions found.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div wire:ignore.self class="modal fade mission-modal" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <form  id="missionForm" method="post" action="{{ route('embassy.store') }}">
                    @csrf
                    {{-- <input type="hidden" name="_method" id="missionMethod" value="POST">
                <input type="hidden" name="id" id="missionId"> --}}
                    <div class="modal-header text-center">
                        <h4 class="" id="missionModalTitle">Add New Mission</h4>
                    </div>
                    <div class="modal-body px-5">
                        <div class="mb-3">
                            <label class="form-label">Mission Name</label>
                            <input type="text" name="name" id="missionName" class="form-control" wire:model="name" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Type</label>
                            <select name="type" id="missionType" class="form-select" wire:model="type" required>
                                <option value="Embassy">Embassy</option>
                                <option value="Permanent Mission">Permanent Mission</option>
                                <option value="High Commission">High Commission</option>
                            </select>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Status</label>
                            <select name="is_active" id="missionStatus" class="form-select" wire:model="is_active"
                                required>
                                <option value="1">Active</option>
                                <option value="0">Inactive</option>
                            </select>
                        </div>

                        <p class="mt-4">Accredited Countries</p>
                        <select wire:model="states" name="country_id[]" class="js-example-basic-multiple" multiple>
                            @foreach (json_decode($countries) as $index => $country)
                                <option value="{{ $index }}">{{ $country }}</option>
                            @endforeach
                        </select>

                        <div class="hstack gap-2 justify-content-center mt-4">
                            <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Save Mission</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <script>
        function openMissionModal(id = '', name = '', type = 'embassy', is_active = 1) {
            document.getElementById('missionModalTitle').innerText = id ? 'Edit Mission' : 'Add New Mission';
            document.getElementById('missionMethod').value = id ? 'PUT' : 'POST';
            document.getElementById('missionId').value = id;
            document.getElementById('missionName').value = name;
            document.getElementById('missionType').value = type;
            document.getElementById('missionStatus').value = is_active;
        }
    
        function confirmDelete(id, type) {
            if (confirm(`Are you sure you want to delete this ${type}?`)) {
                // Perform the delete action
                // You can use AJAX or a form submission here
                console.log(`Deleting ${type} with ID: ${id}`);
            }
        }
    </script>
</div>

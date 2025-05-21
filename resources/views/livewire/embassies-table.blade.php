@include('modal.alert')
<div>
    <div class="tab-pane px-4" id="embassy" role="tabpanel">
        <div class="text-end pb-4">
            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target=".mission-modal"
                onclick="openMissionModal()">
                New Mission
            </button>
        </div>

        <div class="table-responsive table-card" wire:ignore>
            <table class="table table-borderless table-centered align-middle table-nowrap mb-0  datatable">
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
                                @php
                                    $embassyData = $embassy->only(['id', 'name', 'type', 'is_active']);
                                    $embassyData['countries'] = $embassy->countries->pluck('id')->toArray();
                                    $embassyData['location_id'] = $embassy->country_id;

                                @endphp

                                <button class="btn btn-warning btn-sm" data-bs-toggle="modal"
                                    data-bs-target=".mission-modal"
                                    onclick='openMissionModal(@json($embassyData))'>
                                    <i class="bx bx-pencil"></i>
                                </button>


                                <form method="POST" action="{{ route('embassy.destroy', $embassy->id) }}"
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
                        {{-- <tr>
                            <td colspan="5" class="text-center">No missions found.</td>
                        </tr> --}}
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <!-- Mission Modal -->
    <div wire:ignore.self class="modal fade mission-modal" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <form id="missionForm" method="post">
                    @csrf
                    <div class="modal-header text-center">
                        <h4 id="missionModalTitle">Add New Mission</h4>
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
                        <input type="hidden" name="_method" id="missionMethod">
                        <input type="hidden" name="id" id="missionId">

                        <div class="mb-3">
                            <label class="form-label">Mission Name</label>
                            <input type="text" name="name" id="missionName" class="form-control" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Type</label>
                            <select name="type" id="missionType" class="form-select" required>
                                <option value="Embassy">Embassy</option>
                                <option value="Permanent Mission">Permanent Mission</option>
                                <option value="High Commission">High Commission</option>
                            </select>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Mission Location</label>
                            <select name="location_id" data-choices class="form-select" id="missionLocation" required>
                                <option value="">Select Location</option>
                                @foreach ($countries as $id => $name)
                                    <option value="{{ $id }}">{{ $name }}</option>
                                @endforeach
                               >
                                <option value="">Select Location</option>
                                @foreach ($countries as $id => $name)
                                    <option value="{{ $id }}">{{ $name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Status</label>
                            <select name="is_active" id="missionStatus" class="form-select" required>
                                <option value="1">Active</option>
                                <option value="0">Inactive</option>
                            </select>
                        </div>
                        <div id="accreditedCountriesWrapper" class="mb-3 w-100">
                            <p class="mt-4">Accredited Countries</p>
                            <select name="country_id[]" class=" select2" multiple
                                wire:model="states" >
                                @foreach ($countries as $id => $name)
                                    <option value="{{ $id }}">{{ $name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="hstack gap-2 justify-content-center mt-4">
                            <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Save</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        function openMissionModal(data = {}) {
            document.getElementById('missionModalTitle').innerText = data.id ? 'Edit Mission' : 'Add New Mission';
            document.getElementById('missionMethod').value = data.id ? 'PUT' : 'POST';
            document.getElementById('missionId').value = data.id || '';
            document.getElementById('missionName').value = data.name || '';
            document.getElementById('missionType').value = data.type || 'Embassy';
            document.getElementById('missionStatus').value = data.is_active ? '1' : '0';


            const formActionBase = "{{ url('embassy') }}";
            document.getElementById('missionForm').action = data.id ? `${formActionBase}/${data.id}` : formActionBase;

            // Pre-select mission location
            const locationSelect = document.querySelector('select[name="location_id"]');
            locationSelect.value = data.country_id || '';

            const countrySelect = document.querySelector('select[name="country_id[]"]');

            // Show/hide Accredited Countries field
            const accreditedCountriesWrapper = document.getElementById('accreditedCountriesWrapper');
            if (data.id) {
                accreditedCountriesWrapper.style.display = 'block'; // hide when editing
            } else {
                accreditedCountriesWrapper.style.display = 'block'; // show when adding
            }

            // Reset selection
            Array.from(countrySelect.options).forEach(option => {
                option.selected = false;
            });

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

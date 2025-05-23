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
            <table class="table table-sm table-centered table-nowrap mb-0 datatable">
                <thead class="text-muted table-light">
                <tr>
                    <th>#</th>
                    <th>Mission</th>
                    <th>Type</th>
                    <th>Status</th>
                    <th class="text-end">Actions</th>
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
                                $encodedId = encode([$embassy->id]);
                                $embassyData = $embassy->only(['id', 'name', 'type', 'is_active']);
                                $embassyData['countries'] = $embassy->countries->pluck('id')->toArray();
                                $embassyData['country_id'] = $embassy->country_id;
                                $embassyData['encoded_id'] = $encodedId;
                            @endphp

                            <button class="btn btn-warning btn-sm"
                                    onclick='openMissionModal(@json($embassyData))'>
                                <i class="bx bx-pencil"></i>
                            </button>
                            <form id="delete-form-{{ $embassy->id }}" method="POST"
                                  action="{{ route('embassy.destroy', $encodedId) }}" style="display: none;">
                                @csrf
                                @method('DELETE')
                            </form>
                            <button class="btn btn-danger btn-sm" onclick="confirmDelete({{ $embassy->id }})">
                                <i class="bx bx-trash-alt"></i>
                            </button>
                        </td>
                    </tr>
                @empty
                    {{-- No data --}}
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
                            <select name="location_id" id="missionLocation" class="form-select" data-choices required>
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
                            <label class="form-label mt-4">Accredited Countries</label>
                            <select name="country_id[]" class="form-select select2 js-example-basic-multiple" multiple>
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

    <!-- JavaScript -->
    <script>
        function openMissionModal(data = {}) {
            const formActionBase = "{{ url('embassy') }}";
            const isEdit = !!data.id;
            const encodedId = data.encoded_id || data.id || '';

            document.getElementById('missionModalTitle').innerText = isEdit ? 'Edit Mission' : 'Add New Mission';
            document.getElementById('missionMethod').value = isEdit ? 'PUT' : 'POST';
            document.getElementById('missionId').value = data.id || '';
            document.getElementById('missionName').value = data.name || '';
            document.getElementById('missionType').value = data.type || 'Embassy';
            document.getElementById('missionStatus').value = data.is_active ? '1' : '0';

            const missionForm = document.getElementById('missionForm');
            missionForm.action = isEdit ? `${formActionBase}/${encodedId}` : formActionBase;

            // Mission location via Choices.js
            const locationSelect = document.getElementById('missionLocation');
            if (locationSelect && locationSelect.choicesInstance) {
                locationSelect.choicesInstance.setChoiceByValue(data.country_id?.toString() || '');
            } else {
                locationSelect.value = data.country_id || '';
            }

            // Accredited Countries via Select2
            const countrySelect = $('.js-example-basic-multiple');
            if (!countrySelect.hasClass("select2-hidden-accessible")) {
                countrySelect.select2({
                    placeholder: "Select countries"
                });
            }

            const countryIds = data.countries || [];
            countrySelect.val(countryIds.map(String)).trigger('change');

            new bootstrap.Modal(document.querySelector('.mission-modal')).show();
        }

        document.addEventListener('DOMContentLoaded', () => {
            // Init Choices.js
            const missionLocation = document.getElementById('missionLocation');
            if (missionLocation && !missionLocation.choicesInstance) {
                const instance = new Choices(missionLocation, {
                    shouldSort: false
                });
                missionLocation.choicesInstance = instance;
            }

            // Init Select2
            const select2El = $('.js-example-basic-multiple');
            if (!select2El.hasClass('select2-hidden-accessible')) {
                select2El.select2({
                    placeholder: "Select countries"
                });
            }
        });
    </script>
    <style>
        .select2-container {
            width: 100% !important;
        }

        .select2-selection {
            width: 100% !important;
        }

        .select2-selection__rendered {
            white-space: normal !important;
        }
    </style>
</div>

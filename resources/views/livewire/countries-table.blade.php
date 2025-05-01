<div class="tab-pane px-4" id="embassy" role="tabpanel">
    <div class="text-end pb-4">
        <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target=".country-modal" wire:click="openForm">
            New Country
        </button>
    </div>

    <div class="table-responsive table-card">
        <table class="table table-borderless table-centered align-middle table-nowrap mb-0">
            <thead class="text-muted table-light pt-3">
                <tr>
                    <th>#</th>
                    <th>Country</th>
                    <th>Mission</th>
                    <th>Code</th>
                    <th>Phone Code</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($countries as $country)
                    <tr>
                        <td>{{$loop->iteration}}</td>
                        <td>{{ $country->name }}</td>
                        <td>{{ $country->embassy?->name}}</td>
                        <td>{{ $country->code }}</td>
                        <td>{{ $country->phone_code }}</td>
                        <td>
                            <button class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target=".country-modal"
                                wire:click="openForm({{ $country->id }})">
                                <i class="bx bx-edit-alt"></i>
                            </button>
                            <button class="btn btn-danger btn-sm" wire:click="delete({{ $country->id }})">
                                <i class="bx bxs-trash"></i>
                            </button>

                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <!-- Country Modal -->
    <div  class="modal fade country-modal" tabindex="-1" aria-hidden="true" wire:ignore.self>
        <div class="modal-dialog modal-dialog-centered">
            <form method="post" action="{{ route('country.store') }}" class="modal-content">
                @csrf
                <div class="modal-body justify-content-center p-5">
                    <div class="mt-4 text-start">
                        <h4 class="mb-3 text-center">{{ $editingId ? 'Edit Country' : 'Add New Country' }}</h4>

                        <div class="mb-3">
                            <label class="form-label">Country Name</label>
                            <input type="text" class="form-control"  wire:model="name" name="name" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Country Code</label>
                            <input type="text" class="form-control"  wire:model="code" name="code">
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Phone Code</label>
                            <input type="text" class="form-control"  wire:model="phone_code" name="phone_code">
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Select Mission</label>
                            <select class="form-select" wire:model="embassy_id" name="embassy_id">
                                <option value="">Select Mission</option>
                                @foreach ($embassies as $embassy)
                                    <option value="{{ $embassy['id'] }}">{{ $embassy['name'] }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="hstack gap-2 justify-content-center mt-4">
                            <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Save</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <!-- Include SweetAlert2 -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

</div>

@push('scripts')
<script>
    window.addEventListener('close-modal', () => {
        $('.country-modal').modal('hide');
    });
</script>
@endpush

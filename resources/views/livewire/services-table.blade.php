<div id="services" role="tabpanel">
    <div class="text-end pb-4">
        <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target=".service-modal" wire:click="openForm">
            New Service
        </button>
    </div>

    <div class="table-responsive table-card">
        <table class="table table-borderless table-centered align-middle table-nowrap mb-0">
            <thead class="text-muted table-light">
                <tr>
                    <th>#</th>
                    <th>Service Provider</th>
                    <th>Service</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($services as $service)
                    <tr>
                        <td>{{ $service->id }}</td>
                        <td>{{ $service->serviceProvider->name ?? 'N/A' }}</td>
                        <td>{{ $service->name }}</td>
                        <td>
                            <button class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target=".service-modal" wire:click="openForm({{ $service->id }})">
                                <i class="bx bx-edit-alt"></i>
                            </button>
                            <button class="btn btn-danger btn-sm" wire:click="delete({{ $service->id }})">
                                <i class="bx bxs-trash"></i>
                            </button>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <!-- Shared Modal -->
    <div class="modal fade service-modal" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-body text-center p-5">
                    <h4 class="mb-3">{{ $editingId ? 'Edit' : 'New' }} Service</h4>
                    <form wire:submit.prevent="save">
                        <div class="mb-3">
                            <input type="text" class="form-control" wire:model="name" placeholder="Service Name" required>
                        </div>
                        <div class="mb-3">
                            <label>Service Provider</label>
                            <select wire:model="selectedProvider" class="form-select" required>
                                <option value="">-- Select --</option>
                                @foreach ($serviceProviders as $provider)
                                    <option value="{{ $provider->id }}">{{ $provider->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="hstack gap-2 justify-content-center mt-4">
                            <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Save Changes</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    window.addEventListener('close-modal', () => {
        let modal = bootstrap.Modal.getInstance(document.querySelector('.service-modal'));
        if (modal) modal.hide();
    });
</script>

@include('modal.alert')
<div id="services" role="tabpanel">
    <div class="text-end pb-4">
        <button type="button" class="btn btn-primary" wire:click="openForm">
            New Service
        </button>
    </div>

    <div class="table-responsive table-card">
        <table class="table table-borderless table-centered align-middle table-nowrap mb-0">
            <thead class="text-muted table-light">
                <tr>
                    <th>#</th>
                    <th>Service</th>
                    <th>Service Provider</th>
                    <th class="text-end" style="width: 180px;">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($services as $service)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $service->name }}</td>
                        <td>{{ $service->serviceProvider->name ?? 'N/A' }}</td>
                        <td class="text-end">
                            <button type="button" class="btn btn-warning btn-sm" wire:click="openForm({{ $service->id }})">
                                <i class="bx bx-edit-alt"></i>
                            </button>

                            <button type="button" class="btn btn-danger btn-sm delete-btn" data-id="{{ $service->id }}">
                                <i class="bx bxs-trash"></i>
                            </button>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <!-- Modal -->
    <div wire:ignore.self class="modal fade services-modal" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-body text-start p-5">
                    <h4 class="mb-3 text-center">{{ $editingId ? 'Edit' : 'New' }} Service</h4>

                    <form wire:submit.prevent="save">
                        <div class="mb-3">
                            <label class="form-label">Service Name</label>
                            <input type="text" class="form-control" wire:model="name" placeholder="Service Name" required>
                            @error('name') 
                                <span class="text-danger">{{ $message }}</span> 
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Service Provider</label>
                            <select wire:model="selectedProvider" class="form-select" required>
                                <option value="">-- Select --</option>
                                @foreach ($serviceProviders as $provider)
                                    <option value="{{ $provider->id }}">{{ $provider->name }}</option>
                                @endforeach
                            </select>
                            @error('selectedProvider') 
                                <span class="text-danger">{{ $message }}</span> 
                            @enderror
                        </div>

                        <div class="hstack gap-2 justify-content-center mt-4">
                            <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">{{ $editingId ? 'Update' : 'Save' }}</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const servicesModal = new bootstrap.Modal(document.querySelector('.services-modal'));
        
        // Handle modal close
        window.addEventListener('close-modal', () => {
            servicesModal.hide();
        });

        // Handle delete confirmation
        document.addEventListener('click', function(e) {
            const deleteBtn = e.target.closest('.delete-btn');
            if (deleteBtn) {
                e.preventDefault();
                const serviceId = deleteBtn.dataset.id;
                
                Swal.fire({
                    title: 'Are you sure?',
                    text: "You won't be able to revert this!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, delete it!'
                }).then((result) => {
                    if (result.isConfirmed) {
                        @this.deleteConfirm(serviceId);
                    }
                });
            }
        });

        // Handle Livewire events for alerts
        Livewire.on('showAlert', data => {
            Swal.fire({
                icon: data.type,
                title: data.type === 'success' ? 'Success!' : 'Error!',
                text: data.message,
                showConfirmButton: data.type === 'error',
                timer: data.type === 'success' ? 1500 : null
            });
        });
    });
</script>

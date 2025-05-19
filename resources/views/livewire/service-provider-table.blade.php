@include('modal.alert')
<div class="tab-pane px-4" id="service_provider" role="tabpanel">
    <div class="text-end pb-4">
        <button class="btn btn-primary" wire:click="openForm">
            New Service Provider
        </button>
    </div>

    <div class="table-responsive table-card">
        <table class="table table-borderless table-centered align-middle table-nowrap mb-0 datatable">
            <thead class="text-muted table-light">
                <tr>
                    <th>#</th>
                    <th>Service Provider</th>
                    <th class="text-end" style="width: 180px;">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($serviceProviders as $provider)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $provider['name'] }}</td>

                        <td class="text-end">
                            <button class="btn btn-warning btn-sm" wire:click="openForm('{{ $provider['id'] }}')">
                                <i class="bx bx-pencil"></i>
                            </button>

                            <button type="button" class="btn btn-danger btn-sm delete-btn" data-id="{{ $provider['id'] }}">
                                <i class="bx bx-trash-alt"></i>
                            </button>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <!-- Modal -->
    <div wire:ignore.self class="modal fade service-provider-modal" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-body p-5">
                    <h4 class="mb-3 text-center">{{ $editingId ? 'Edit' : 'New' }} Service Provider</h4>

                    <form wire:submit.prevent="save">
                        <div class="mb-3">
                            <label class="form-label">Name</label>
                            <input type="text" class="form-control" wire:model="name" required>
                            @error('name')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Services</label>
                            <div wire:ignore>
                                <select class="form-control" multiple wire:model="selectedServices" data-choices>
                                    @foreach ($services as $service)
                                        <option value="{{ $service->id }}">{{ $service->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            @error('selectedServices')
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
        const elements = document.querySelectorAll('[data-choices]');
        elements.forEach(el => {
            new Choices(el, {
                removeItemButton: true,
                searchEnabled: true,
                itemSelectText: '',
            });
        });

        // Handle delete confirmation
        document.addEventListener('click', function(e) {
            const deleteBtn = e.target.closest('.delete-btn');
            if (deleteBtn) {
                e.preventDefault();
                const providerId = deleteBtn.dataset.id;

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
                        @this.deleteConfirm(providerId);
                    }
                });
            }
        });

        // Handle Livewire events
        Livewire.on('showAlert', data => {
            Swal.fire({
                icon: data.type,
                title: data.type === 'success' ? 'Success!' : 'Error!',
                text: data.message,
                showConfirmButton: data.type === 'error',
                timer: data.type === 'success' ? 1500 : null
            });
        });

        // Close modal
        Livewire.on('close-modal', () => {
            bootstrap.Modal.getInstance(document.querySelector('.service-provider-modal')).hide();
        });
    });
</script>
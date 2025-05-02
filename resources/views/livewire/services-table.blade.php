@include("modal.alert")
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
                    <th>Service</th>
                    <th>Service Provider</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($services as $service)
                    <tr>
                        <td>{{ $loop ->iteration }}</td>
                        <td>{{ $service->name }}</td>
                        <td>{{ $service->serviceProvider->name ?? 'N/A' }}</td>                    
                        <td>
                            <button class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target=".service-modal"
                            onclick="openServiceModal({{ $service->id }}, '{{ $service->name }}', {{ $service->service_provider_id ?? 'null' }})">
                            <i class="bx bx-edit-alt"></i>
                        </button>
                        
                        <!-- Delete with confirmation -->
                        <form method="POST" action="{{ route('service.destroy', $service->id) }}" onsubmit="return confirm('Are you sure you want to delete this service?')" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm">
                                <i class="bx bxs-trash"></i>
                            </button>
                        </form>
                        
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <!-- Shared Modal -->
    <div wire:ignore.self class="modal fade service-modal" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-body text-start p-5">
                    <h4 class="mb-3 text-center">{{ $editingId ? 'Edit' : 'New' }} Service</h4>
                    <form action="{{ route('service.store') }}" method="post">
                        @csrf
                        <div class="mb-3">
                            <label class="form-label">Service Name</label>
                            <input type="text" class="form-control" wire:model="name" name="name" placeholder="Service Name" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Service Provider</label>
                            <select wire:model="selectedProvider" name="service_provider_id" class="form-select" required>
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

    function openServiceModal(id = '', name = '', providerId = '') {
        // Set modal title
        document.querySelector('.service-modal h4').innerText = id ? 'Edit Service' : 'New Service';

        // Update form action and method
        const form = document.querySelector('.service-modal form');
        const methodField = form.querySelector('input[name="_method"]');

        if (id) {
            form.action = `/service/${id}`;
            if (!methodField) {
                const methodInput = document.createElement('input');
                methodInput.type = 'hidden';
                methodInput.name = '_method';
                methodInput.value = 'PUT';
                form.appendChild(methodInput);
            } else {
                methodField.value = 'PUT';
            }
        } else {
            form.action = `/service`;
            if (methodField) methodField.remove();
        }

        // Populate fields
        form.querySelector('input[name="name"]').value = name || '';
        form.querySelector('select[name="service_provider_id"]').value = providerId || '';

        // Show the modal
        const modal = new bootstrap.Modal(document.querySelector('.service-modal'));
        modal.show();
    }

</script>

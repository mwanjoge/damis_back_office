@include("modal.alert")
<div class="px-4" id="service-provider" role="tabpanel">
    <div class="justify-content-end text-end align-content-start pb-4">
        <!-- New Service Provider Button -->
        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target=".service-provider-modal" wire:click="openForm">
            New Service Provider
        </button>
    </div>

    <div class="table-responsive table-card">
        <table class="table table-borderless table-centered align-middle table-nowrap mb-0">
            <thead class="text-muted table-light">
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Service Provider</th>
                    <th scope="col">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($serviceProviders as $serviceProvider)
                    <tr>
                        <td>{{ $loop ->iteration }}</td>
                        <td>{{ $serviceProvider['name'] }}</td>
                        <td>
                            <!-- Edit Button -->
                            <button class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#editServiceProviderModal{{ $serviceProvider['id'] }}" wire:click="openForm({{ $serviceProvider['id'] }})">
                                <i class="bx bx-edit-alt"></i>
                            </button>

                            <!-- Delete Button -->
                            <button class="btn btn-danger btn-sm" wire:click="delete({{ $serviceProvider['id'] }})">
                                <i class="bx bxs-trash"></i>
                            </button>
                        </td>
                    </tr>

                    <!-- Edit Modal -->
                    <div wire:ignore.self class="modal fade" id="editServiceProviderModal{{ $serviceProvider['id'] }}" tabindex="-1" aria-labelledby="editServiceProviderModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title">Edit Service Provider</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <form action="{{ route('service_provider.store') }}" method="post">
                                        @csrf
                                        <div class="mb-3">
                                            <label class="form-label">Service Provider Name</label>
                                            <input type="text" class="form-control" wire:model="name" name="name" required>
                                        </div>
                                        <p class="mt-4">Select Services</p>
                                        <select wire:model="selectedServices" name="service_id[]" class="js-example-basic-multiple" multiple>
                                            @foreach ($services as $service)
                                                <option value="{{ $service['id'] }}">{{ $service['name'] }}</option>
                                            @endforeach
                                        </select>

                                        <div class="hstack gap-2 justify-content-center mt-4">
                                            <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                                            <button type="submit" class="btn btn-primary">Save Changes</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </tbody>
        </table>
    </div>

    <script>
        // SweetAlert for Delete Confirmation
        Livewire.on('confirmDelete', providerId => {
            Swal.fire({
                title: "Are you sure?",
                text: "This service provider will be deleted permanently!",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#d33",
                cancelButtonColor: "#3085d6",
                confirmButtonText: "Yes, delete it!"
            }).then((result) => {
                if (result.isConfirmed) {
                    Livewire.emit('delete', providerId);  // Trigger Livewire delete
                }
            });
        });
    </script>

<div class="card">
    <div wire:ignore.self class="card-body modal fade service-provider-modal" tabindex="-1" role="dialog" aria-labelledby="serviceProviderModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-body p-3">
                    <div class="mt-4">
                        <h4 class="mb-3 text-center">{{ $editingId ? 'Edit' : 'New' }} Service Provider</h4>
                        <form action="{{ route('service_provider.store') }}" method="post">
                            @csrf
                            <div class="col-md-12 justify-content-center">
                                <label class="form-label">Service Provider Name</label>
                                <input type="text" class="form-control" wire:model="name" name="name" required>
                            </div>
                          
                            
                            @livewire('service-field-container')
                           
                            <div class="hstack gap-2 justify-content-center mt-4">
                                <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-primary">Save</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

</div>

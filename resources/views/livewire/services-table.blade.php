@include('modal.alert')

<div id="services" role="tabpanel">
    <div class="text-end pb-4">
        <button type="button" class="btn btn-primary" id="new-service-btn" data-bs-toggle="modal"
            data-bs-target=".services-modal">
            New Service
        </button>
    </div>

    <div class="table-responsive table-card">
        <table class="table table-borderless table-centered align-middle table-nowrap mb-0 datatable">
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
                            <button type="button" class="btn btn-warning btn-sm edit-btn" data-bs-toggle="modal"
                                data-bs-target=".services-modal" data-id="{{ $service->id }}"
                                data-name="{{ $service->name }}"
                                data-provider="{{ $service->serviceProvider->id ?? '' }}">
                                <i class="bx bx-pencil"></i>
                            </button>

                            <form method="post" action="{{ route('service.destroy', $service->id) }}" style="display: inline-block;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm">
                                    <i class="bx bx-trash-alt"></i>
                                </button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <!-- Modal -->
    <div class="modal fade services-modal" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-body text-start p-5">
                    <h4 class="mb-3 text-center" id="modal-title">New Service</h4>

                    <form id="service-form" method="post">
                        @csrf
                        <div class="mb-3">
                            <label class="form-label">Service Name</label>
                            <input type="text" class="form-control" id="service-name" placeholder="Service Name"
                                name='name' required>
                            <span class="text-danger" id="name-error"></span>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Service Provider</label>
                            <select id="service-provider" class="form-select" name="service_provider_id" required>
                                <option value="">-- Select --</option>
                                @foreach ($serviceProviders as $provider)
                                    <option value="{{ $provider->id }}">{{ $provider->name }}</option>
                                @endforeach
                            </select>
                            <span class="text-danger" id="provider-error"></span>
                        </div>

                        <div class="hstack gap-2 justify-content-center mt-4">
                            <button type="button" class="btn btn-light" data-bs-dismiss="modal"
                                id="close-modal-btn">Close</button>
                            <button type="submit" class="btn btn-primary">Save</button>
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
        const form = document.getElementById('service-form');
        const modalTitle = document.getElementById('modal-title');
        const serviceNameInput = document.getElementById('service-name');
        const serviceProviderSelect = document.getElementById('service-provider');
        const closeModalBtn = document.getElementById('close-modal-btn');

        const formActionBase = "{{ url('service') }}";

        // Handle new service button
        document.getElementById('new-service-btn').addEventListener('click', function() {
            modalTitle.innerText = 'New Service';
            form.action = formActionBase;
            form.method = 'POST';
            serviceNameInput.value = '';
            serviceProviderSelect.value = '';
            servicesModal.show();
        });

        // Handle edit button click
        document.querySelectorAll('.edit-btn').forEach(button => {
            button.addEventListener('click', function() {
                const serviceId = button.getAttribute('data-id');
                const serviceName = button.getAttribute('data-name');
                const serviceProviderId = button.getAttribute('data-provider');

                modalTitle.innerText = 'Edit Service';
                serviceNameInput.value = serviceName;
                serviceProviderSelect.value = serviceProviderId || '';
                form.action = `${formActionBase}/${serviceId}`;
                form.method =
                'POST'; // HTML forms only support GET or POST. Use hidden _method for PUT.

                // Add hidden _method field for PUT request
                let methodInput = form.querySelector('input[name="_method"]');
                if (!methodInput) {
                    methodInput = document.createElement('input');
                    methodInput.type = 'hidden';
                    methodInput.name = '_method';
                    form.appendChild(methodInput);
                }
                methodInput.value = 'PUT';

                servicesModal.show();
            });
        });

        // Handle modal close
        closeModalBtn.addEventListener('click', function() {
            servicesModal.hide();
        });

        // Handle delete confirmation
        // document.addEventListener('click', function(e) {
        //     const deleteBtn = e.target.closest('.delete-btn');
        //     if (deleteBtn) {
        //         e.preventDefault();
        //         const serviceId = deleteBtn.dataset.id;

        //         Swal.fire({
        //             title: 'Are you sure?',
        //             text: "You won't be able to revert this!",
        //             icon: 'warning',
        //             showCancelButton: true,
        //             confirmButtonColor: '#3085d6',
        //             cancelButtonColor: '#d33',
        //             confirmButtonText: 'Yes, delete it!'
        //         }).then((result) => {
        //             if (result.isConfirmed) {
        //                 window.location.href = `{{ route('service.destroy', ':id') }}`.replace(
        //                     ':id', serviceId);
        //                 // Send delete request
        //                 fetch(`${formActionBase}/${serviceId}`, {
        //                         method: 'DELETE',
        //                         headers: {
        //                             'X-CSRF-TOKEN': document.querySelector(
        //                                 'meta[name="csrf-token"]').content,
        //                             'Accept': 'application/json',
        //                             'Content-Type': 'application/json'
        //                         },
        //                     })
        //                     .then(response => {
        //                         if (response.ok) {
        //                             Swal.fire('Deleted!', 'Service has been deleted.',
        //                                 'success').then(() => {
        //                                 location
        //                             .reload(); // or use AJAX to update the table
        //                             });
        //                         } else {
        //                             Swal.fire('Error!', 'Failed to delete the service.',
        //                                 'error');
        //                         }
        //                     });

        //             }
        //         });
        //     }
        // });
    });
</script>

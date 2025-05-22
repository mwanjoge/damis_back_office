@include('modal.alert')
<div class="tab-pane px-4" id="service_provider" role="tabpanel">
    <div class="text-end pb-4">
        <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target=".service-provider-modal"
            wire:click="openForm">
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
                            {{-- <button class="btn btn-warning btn-sm" data-bs-toggle="modal"
                                data-bs-target=".service-provider-modal" wire:click="openForm('{{ $provider['id'] }}')">
                                <i class="bx bx-pencil"></i>
                            </button> --}}
                            <button type="button" class="btn btn-warning btn-sm edit-btn"
                                data-provider='@json($provider)'>
                                <i class="bx bx-pencil"></i>
                            </button>

                            <form id="delete-form-{{ $provider['id'] }}" method="POST"
                                action="{{ route('service_provider.destroy', $provider['id']) }}"
                                style="display: none;">
                                @csrf
                                @method('DELETE')
                            </form>
                            <button class="btn btn-danger btn-sm" onclick="confirmDelete({{ $provider['id'] }})">
                                <i class="bx bx-trash-alt"></i>
                            </button>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <!-- Modal -->
    <div class="modal fade service-provider-modal" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                <div class="modal-body p-5">
                    <h4 class="mb-3 text-center">{{ $editingId ? 'Edit' : 'New' }} Service Provider</h4>

                    <form id="service-provider-form" method="POST" action="{{ route('service_provider.store') }}">
                        @csrf
                        <input type="hidden" name="editing_id" id="editing-id">
                        <!-- _method will be injected via JS if it's an edit -->

                        <div class="mb-3">
                            <label class="form-label">Name</label>
                            <input type="text" class="form-control" name="name" id="provider-name" required>
                        </div>
                        <!-- Livewire field shown only on CREATE -->
                        <div class="mb-3" id="livewire-service-field">
                            @livewire('service-field-container')
                        </div>

                        <!-- Multiselect field shown only on EDIT -->
                        <div class="mb-3 d-none" id="edit-service-select">
                            <label class="form-label">Services</label>
                            <select class="form-control" name="services[]" id="provider-services" multiple data-choices>
                                @foreach ($services as $service)
                                    <option value="{{ $service->id }}">{{ $service->name }}</option>
                                @endforeach
                            </select>
                        </div>


                        <div class="hstack gap-2 justify-content-center mt-4">
                            <button type="button" class="btn btn-light" data-bs-dismiss="modal"
                                id="close-modal-btn">Close</button>
                            <button type="submit" class="btn btn-primary" id="submit-btn">Save</button>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {

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
        const modal = new bootstrap.Modal(document.querySelector('.service-provider-modal'));
        const form = document.getElementById('service-provider-form');
        const nameInput = document.getElementById('provider-name');
        const serviceSelect = document.getElementById('provider-services');
        const editingIdInput = document.getElementById('editing-id');
        const submitBtn = document.getElementById('submit-btn');
        const baseAction = "{{ url('service_provider') }}";

        const livewireField = document.getElementById('livewire-service-field');
        const selectField = document.getElementById('edit-service-select');

        let choicesInstance = new Choices(serviceSelect, {
            removeItemButton: true,
            shouldSort: false
        });

        // Create mode
        document.querySelector('[data-bs-target=".service-provider-modal"]').addEventListener('click',
            function() {
                form.action = baseAction;
                nameInput.value = '';
                editingIdInput.value = '';
                choicesInstance.removeActiveItems();
                removeMethodInput();
                submitBtn.textContent = 'Save';

                // Toggle field visibility
                livewireField.classList.remove('d-none');
                selectField.classList.add('d-none');

                modal.show();
            });

        // Edit mode
        document.querySelectorAll('.edit-btn').forEach(btn => {
            btn.addEventListener('click', function() {
                const provider = JSON.parse(btn.getAttribute('data-provider'));
                form.action = `${baseAction}/${provider.id}`;
                nameInput.value = provider.name;
                editingIdInput.value = provider.id;
                submitBtn.textContent = 'Update';

                choicesInstance.removeActiveItems();
                provider.services.forEach(serviceId => {
                    choicesInstance.setChoiceByValue(String(serviceId));
                });

                addMethodInput('PUT');

                // Toggle field visibility
                livewireField.classList.add('d-none');
                selectField.classList.remove('d-none');

                modal.show();
            });
        });

        function addMethodInput(method) {
            removeMethodInput();
            const input = document.createElement('input');
            input.type = 'hidden';
            input.name = '_method';
            input.value = method;
            form.appendChild(input);
        }

        function removeMethodInput() {
            const existing = form.querySelector('input[name="_method"]');
            if (existing) existing.remove();
        }
    });
</script>

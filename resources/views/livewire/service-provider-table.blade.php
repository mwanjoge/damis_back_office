@include('modal.alert')
<div>
    <div class="px-4" id="service-provider" role="tabpanel">
        <div class="text-end pb-4">
            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target=".service-provider-modal"
                onclick="openServiceProviderModal()">
                New Service Provider
            </button>
        </div>

        <div class="table-responsive table-card">
            <table class="table table-borderless table-centered align-middle table-nowrap mb-0">
                <thead class="text-muted table-light">
                    <tr>
                        <th>#</th>
                        <th>Service Provider</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($serviceProviders as $serviceProvider)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $serviceProvider['name'] }}</td>
                            <td>
                                <button class="btn btn-warning btn-sm" data-bs-toggle="modal"
                                    data-bs-target=".service-provider-modal"
                                    onclick="openServiceProviderModal({{ json_encode($serviceProvider) }})">
                                    <i class="bx bx-edit-alt"></i>
                                </button>

                                <form method="POST" action="{{ route('service_provider.destroy', $serviceProvider['id']) }}"
                                    style="display:inline-block;">
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
    </div>

    <div wire:ignore.self class="modal fade service-provider-modal" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <form id="serviceProviderForm" method="post">
                    @csrf
                    <input type="hidden" name="_method" id="spMethod">
                    <input type="hidden" name="id" id="spId">

                    <div class="modal-header text-center">
                        <h4 id="modalTitle">New Service Provider</h4>
                    </div>

                    <div class="modal-body px-5">
                        <div class="mb-3">
                            <label class="form-label">Service Provider Name</label>
                            <input type="text" name="name" id="spName" class="form-control" required>
                        </div>

                        <p class="mt-4">Services Provided</p>
                        <select name="services[]" class="js-example-basic-multiple" multiple></select>

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
        function openServiceProviderModal(data = {}) {
            document.getElementById('modalTitle').innerText = data.id ? 'Edit Service Provider' : 'New Service Provider';
            document.getElementById('spMethod').value = data.id ? 'PUT' : 'POST';
            document.getElementById('spId').value = data.id || '';
            document.getElementById('spName').value = data.name || '';

            const formBase = "{{ url('service_provider') }}";
            document.getElementById('serviceProviderForm').action = data.id ? `${formBase}/${data.id}` : formBase;

            const serviceSelect = document.querySelector('select[name="services[]"]');
            serviceSelect.innerHTML = '';

            if (data.services) {
                data.services.forEach(id => {
                    let option = document.createElement('option');
                    option.value = id;
                    option.selected = true;
                    serviceSelect.appendChild(option);
                });
            }

            if ($(serviceSelect).hasClass('js-example-basic-multiple')) {
                $(serviceSelect).trigger('change');
            }

            new bootstrap.Modal(document.querySelector('.service-provider-modal')).show();
        }

    </script>
</div>

@include("modal.alert")

<div class="px-4" id="service-provider" role="tabpanel">
    <div class="justify-content-end text-end align-content-start pb-4">
        <!-- New Service Provider Button -->
        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target=".service-provider-modal" onclick="openServiceProviderModal()">
            New Service Provider
        </button>
    </div>

    <div class="table-responsive table-card">
        <table class="table table-borderless table-centered align-middle table-nowrap mb-0">
            <thead class="text-muted table-light">
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Service Provider</th>
                    <th scope="col"  class="text-end" style="width: 180px;">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($serviceProviders as $serviceProvider)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $serviceProvider['name'] }}</td>
                        <td class="text-end">
                            <!-- Edit Button -->
                            <button class="btn btn-warning btn-sm"
                                data-bs-toggle="modal"
                                data-bs-target=".service-provider-modal"
                                onclick="openServiceProviderModal('{{ $serviceProvider['id'] }}', '{{ $serviceProvider['name'] }}', {{ json_encode($serviceProvider['services']) }})">
                                <i class="bx bx-edit-alt"></i>
                            </button>


                            <!-- Delete Button -->
                            <button class="btn btn-danger btn-sm" wire:click="delete({{ $serviceProvider['id'] }})">
                                <i class="bx bxs-trash"></i>
                            </button>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <!-- Reusable Modal for Add/Edit -->
    <div class="card">
        <div wire:ignore.self class="card-body modal fade service-provider-modal" tabindex="-1" role="dialog" aria-labelledby="serviceProviderModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-body p-3">
                        <div class="mt-4">
                            <h4 class="mb-3 text-center" id="modalTitle">New Service Provider</h4>
                            <form action="{{ route('service_provider.store') }}" method="post">
                                @csrf
                                <input type="hidden" id="sp_id" name="id">

                                <div class="col-md-12">
                                    <label class="form-label">Service Provider Name</label>
                                    <input type="text" class="form-control" id="sp_name" name="name">
                                </div>

                                <!-- Custom Field Component -->
                                <div >
                                    @livewire('service-field-container')
                                </div>

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

<!-- JavaScript for Dynamic Modal -->
<script>
    function openServiceProviderModal(id = '', name = '', selectedServices = []) {
        document.getElementById('sp_id').value = id || '';
        document.getElementById('sp_name').value = name || '';
        document.getElementById('modalTitle').innerText = id ? 'Edit Service Provider' : 'New Service Provider';

        // Optional: update selected services dynamically using Alpine/Livewire events
        // If you're using custom inputs for services, trigger a Livewire event or sync them manually
    }
</script>

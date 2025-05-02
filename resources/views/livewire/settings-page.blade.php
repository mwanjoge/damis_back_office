{{-- 
<div>
    @section('content')
        <div class="row">
            <div class="col-xxl-9">
                <div class="card mt-xxl-n5">
                    <div class="card-header">
                        <ul class="nav nav-tabs-custom rounded card-header-tabs border-bottom-0" role="tablist">

                            <li class="nav-item">
                                <a class="nav-link" data-bs-toggle="tab" href="#embassy" role="tab">
                                    <i class="far fa-user"></i>
                                    Mission
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link active" data-bs-toggle="tab" href="#countries" role="tab">
                                    <i class="fas fa-home"></i>
                                    Countries
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" data-bs-toggle="tab" href="#service-provider" role="tab">
                                    <i class="far fa-user"></i>
                                    Service Providers
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" data-bs-toggle="tab" href="#services" role="tab">
                                    <i class="far fa-user"></i>
                                    Services
                                </a>
                            </li>

                        </ul>
                    </div>
                </div>

                <div class="card-body px-4" style="background-color: white">
                    <div class="tab-content">
                        <div class="tab-pane active" id="countries" role="tabpanel">
                            <div class="justify-content-end text-end align-content-start pb-4">
                                <button type="button" class="btn btn-primary" 
                                data-bs-toggle="modal"
                                data-bs-target=".country-modal"
                                onclick="openCountryModal()">
                                New Country
                            </button>
                            
                            </div>

                            <div class="table-responsive table-card ">
                                <table class="table table-borderless table-centered align-middle table-nowrap mb-0">
                                    <thead class="text-muted table-light pt-3">
                                        <tr>
                                            <th scope="col">#</th>
                                            <th scope="col">Mission</th>
                                            <th scope="col">Country</th>
                                            <th scope="col">Code</th>
                                            <th scope="col">Phone Code</th>
                                            <th scope="col">Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($countries as $country)
                                            <tr>
                                                <td>{{ $country->id }}</td>
                                                <td>{{ $country->embassy_id }}</td>
                                                <td>{{ $country->name }}</td>
                                                <td>{{ $country->code }}</td>
                                                <td>{{ $country->phone_code }}</td>
                                           <td>
                                                    <!-- Edit Button -->
                                                    <button class="btn btn-warning btn-sm" data-bs-toggle="modal"
                                                    data-bs-target=".country-modal"
                                                    onclick="openCountryModal('{{ is_array($country) ? $country['id'] : '' }}', '{{ is_array($country) ? $country['name'] : '' }}', '{{ is_array($country) ? $country['embassy_id'] : '' }}')">
                                                    <i class="bx bx-edit-alt"></i>
                                                </button>

                                                    <!-- Delete Button -->
                                                    <button class="btn btn-danger btn-sm"
                                                        onclick="confirmDelete({{ is_array($country) ? $country['id'] : '' }})">
                                                        <i class="bx bxs-trash"></i>
                                                    </button>
                                                </td>
                                            </tr>

                                            <!-- Edit Modal -->
                                            <div class="modal fade" id="editCountryModal{{ $country['id'] }}" tabindex="-1"
                                                aria-labelledby="editModalLabel" aria-hidden="true">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title">Edit Country</h5>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                                aria-label="Close"></button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <form>
                                                                <div class="mb-3">
                                                                    <label class="form-label">Country Name</label>
                                                                    <input type="text" class="form-control"
                                                                        value="{{ $country['name'] }}">
                                                                </div>
                                                                <div class="mb-3">

                                                                    <label class="form-label">Embassy Name</label>

                                                                    <select class="form-select"
                                                                        aria-label="Default select example">
                                                                        <option selected
                                                                            value="{{ $country['embassy_id'] }}">
                                                                            {{ $country['embassy_id'] }}</option>
                                                                        @foreach ($embassies as $embassy)
                                                                            <option value="{{ $embassy['name'] }}">
                                                                                {{ $embassy['name'] }}</option>
                                                                        @endforeach
                                                                    </select>
                                                                </div>
                                                                <div class="mb-3">
                                                                    <label class="form-label">Code</label>
                                                                    <input type="text" class="form-control"
                                                                        value="{{ $country['code'] }}">
                                                                </div>
                                                                <div class="mb-3">
                                                                    <label class="form-label">Phone Code</label>
                                                                    <input type="text" class="form-control"
                                                                        value="{{ $country['phone_code'] }}">
                                                                </div>
                                                                <button type="submit" class="btn btn-primary">Save
                                                                    Changes</button>
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
                                function confirmDelete(countryId) {
                                    Swal.fire({
                                        title: "Are you sure?",
                                        text: "This country record will be deleted permanently!",
                                        icon: "warning",
                                        showCancelButton: true,
                                        confirmButtonColor: "#d33",
                                        cancelButtonColor: "#3085d6",
                                        confirmButtonText: "Yes, delete it!"
                                    }).then((result) => {
                                        if (result.isConfirmed) {
                                            Swal.fire("Deleted!", "The country record has been removed.", "success");
                                        }
                                    });
                                }
                            </script>

                        </div>
                        <!--end tab-pane-->


                        <div class="tab-pane px-4" id="embassy" role="tabpanel">
                            <div class="justify-content-end text-end align-content-start pb-4">
                                <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                                    data-bs-target=".mission-modal">New Mission</button>
                            </div>
                            <div class="table-responsive table-card">
                                <table class="table table-borderless table-centered align-middle table-nowrap mb-0">
                                    <thead class="text-muted table-light">
                                        <tr>
                                            <th scope="col">#</th>
                                            <th scope="col">Mission</th>
                                            <th scope="col">Type</th>
                                            <th scope="col">Status</th>
                                            <th scope="col">Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @if (!empty($embassies))
                                        @foreach ($embassies as $embassy)
                                            <tr>
                                                <td>{{ $embassy->id }}</td>
                                                <td>{{ $embassy->name }}</td>
                                                <td>{{ $embassy->type }}</td>
                                                <td>{{ $embassy->is_active ? 'Active' : 'Inactive' }}</td>
                                                <td>
                                                    <!-- Edit Button -->
                                                    <button class="btn btn-warning btn-sm" data-bs-toggle="modal"
                                                        data-bs-target="#editModal{{ $embassy['id'] }}">
                                                        <i class="bx bx-edit-alt"></i>
                                                    </button>

                                                    <!-- Delete Button -->
                                                    <button class="btn btn-danger btn-sm"
                                                        onclick="confirmDelete({{ $embassy['id'] }})">
                                                        <i class="bx bxs-trash"></i>
                                                    </button>


                                                    <!-- View Button -->
                                                    <button class="btn btn-info btn-sm" data-bs-toggle="modal"
                                                        data-bs-target="#viewMission{{ $embassy['id'] }}">
                                                        <i class="bx bx-show"></i>
                                                    </button>
                                                </td>
                                            </tr>

                                            <!-- Edit Modal -->
                                            <div class="modal fade" id="editModal{{ $embassy['id'] }}" tabindex="-1"
                                                aria-labelledby="editModalLabel" aria-hidden="true">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title">Edit Mission</h5>
                                                            <button type="button" class="btn-close"
                                                                data-bs-dismiss="modal" aria-label="Close"></button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <form>
                                                                <div class="mb-3">
                                                                    <label class="form-label">Embassy Name</label>
                                                                    <input type="text" class="form-control"
                                                                        value="{{ $embassy['name'] }}">

                                                                </div>
                                                                <div class="mb-3">
                                                                    <label class="form-label">Type</label>
                                                                    <select id="embassyTypeDropdown{{ $embassy['id'] }}"
                                                                        class="form-control" name="type">
                                                                        <option value="embassy"
                                                                            {{ $embassy['type'] == 'embassy' ? 'selected' : '' }}>
                                                                            Mission</option>
                                                                        <option value="permanent mission"
                                                                            {{ $embassy['type'] == 'permanent mission' ? 'selected' : '' }}>
                                                                            Permanent Mission</option>
                                                                        <option value="high commission"
                                                                            {{ $embassy['type'] == 'high commission' ? 'selected' : '' }}>
                                                                            High Commission</option>
                                                                    </select>
                                                                </div>


                                                                <div class="mb-3">
                                                                    <label class="form-label">Status</label>
                                                                    <select class="form-control">
                                                                        <option value="1"
                                                                            {{ $embassy['is_active'] ? 'selected' : '' }}>
                                                                            Active</option>
                                                                        <option value="0"
                                                                            {{ !$embassy['is_active'] ? 'selected' : '' }}>
                                                                            Inactive</option>
                                                                    </select>
                                                                </div>
                                                                <button type="submit" class="btn btn-primary">Save
                                                                    Changes</button>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                        @else
    <tr>
        <td colspan="4">No embassies found.</td>
    </tr>
@endif
                                    </tbody>
                                </table>

                            </div>

                            <script>
                                function confirmDelete(embassyId) {
                                    Swal.fire({
                                        title: "Are you sure?",
                                        text: "This embassy record will be deleted permanently!",
                                        icon: "warning",
                                        showCancelButton: true,
                                        confirmButtonColor: "#d33",
                                        cancelButtonColor: "#3085d6",
                                        confirmButtonText: "Yes, delete it!"
                                    }).then((result) => {
                                        if (result.isConfirmed) {
                                            // Perform the delete action (e.g., call Livewire method or send AJAX request)
                                            Swal.fire("Deleted!", "The embassy record has been removed.", "success");
                                        }
                                    });
                                }
                            </script>

                        </div>

                        <div class="tab-pane" id="service-provider" role="tabpanel">
                            <div class="justify-content-end text-end align-content-start pb-4">
                                <button type="button" class="btn btn-primary " data-bs-toggle="modal"
                                    data-bs-target=".service-provider-modal">New Service Provider</button>
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
                                                <td>{{ $serviceProvider['id'] }}</td>
                                                <td>{{ $serviceProvider['name'] }}</td>
                                                <td>
                                                    <!-- Edit Button -->
                                                    <button class="btn btn-warning btn-sm" data-bs-toggle="modal"
                                                        data-bs-target="#editServiceProviderModal{{ $serviceProvider['id'] }}">
                                                        <i class="bx bx-edit-alt"></i>
                                                    </button>

                                                    <!-- Delete Button -->
                                                    <button class="btn btn-danger btn-sm"
                                                        onclick="confirmDelete({{ $serviceProvider['id'] }})">
                                                        <i class="bx bxs-trash"></i>
                                                    </button>
                                                </td>
                                            </tr>

                                            <!-- Edit Modal -->
                                            <div class="modal fade"
                                                id="editServiceProviderModal{{ $serviceProvider['id'] }}" tabindex="-1"
                                                aria-labelledby="editModalLabel" aria-hidden="true">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title">Edit Service Provider</h5>
                                                            <button type="button" class="btn-close"
                                                                data-bs-dismiss="modal" aria-label="Close"></button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <form>
                                                                <div class="mb-3">
                                                                    <label class="form-label">Service Provider Name</label>
                                                                    <input type="text" class="form-control"
                                                                        value="{{ $serviceProvider['name'] }}">
                                                                </div>
                                                                <button type="submit" class="btn btn-primary">Save
                                                                    Changes</button>
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
                                function confirmDelete(providerId) {
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
                                            // Perform the delete action (e.g., call Livewire method or send AJAX request)
                                            Swal.fire("Deleted!", "The service provider has been removed.", "success");
                                        }
                                    });
                                }
                            </script>

                        </div>

                        <div class="tab-pane" id="services" role="tabpanel">
                            <div class="justify-content-end text-end align-content-start pb-4">
                                <button type="button" class="btn btn-primary " data-bs-toggle="modal"
                                    data-bs-target=".service-modal">New Service</button>
                            </div>
                            <div class="table-responsive table-card">
                                <table class="table table-borderless table-centered align-middle table-nowrap mb-0">
                                    <thead class="text-muted table-light">
                                        <tr>
                                            <th scope="col">#</th>
                                            <th scope="col">Service Provider</th>
                                            <th scope="col">Service</th>
                                            <th scope="col">Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($services as $service)
                                            <tr>
                                                <td>{{ $service['id'] }}</td>
                                                <td>{{ $service['service_provider'] }}</td>
                                                <td>{{ $service['name'] }}</td>
                                                <td>
                                                    <!-- Edit Button -->
                                                    <button class="btn btn-warning btn-sm" data-bs-toggle="modal"
                                                        data-bs-target="#editServiceModal{{ $service['id'] }}">
                                                        <i class="bx bx-edit-alt"></i>
                                                    </button>

                                                    <!-- Delete Button -->
                                                    <button class="btn btn-danger btn-sm"
                                                        onclick="confirmDelete({{ $service['id'] }})">
                                                        <i class="bx bxs-trash"></i>
                                                    </button>
                                                </td>
                                            </tr>

                                            <!-- Edit Modal -->
                                            <div class="modal fade" id="editServiceModal{{ $service['id'] }}"
                                                tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title">Edit Service</h5>
                                                            <button type="button" class="btn-close"
                                                                data-bs-dismiss="modal" aria-label="Close"></button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <form>
                                                                <div class="mb-3">
                                                                    <label class="form-label">Service Name</label>
                                                                    <input type="text" class="form-control"
                                                                        value="{{ $service['name'] }}">
                                                                </div>
                                                                <div class="mb-3">
                                                                    <label class="form-label">Service Provider</label>
                                                                    <select class="form-select"
                                                                        aria-label="Default select example">
                                                                        <option selected
                                                                            value="{{ $service['service_provider'] }}">
                                                                            {{ $service['service_provider'] }}</option>
                                                                        @foreach ($serviceProviders as $provider)
                                                                            <option value="{{ $provider['name'] }}">
                                                                                {{ $provider['name'] }}</option>
                                                                        @endforeach
                                                                    </select>
                                                                </div>
                                                                <button type="submit" class="btn btn-primary">Save
                                                                    Changes</button>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>


                                            <script>
                                                function confirmDelete(serviceId) {
                                                    Swal.fire({
                                                        title: "Are you sure?",
                                                        text: "This service will be deleted permanently!",
                                                        icon: "warning",
                                                        showCancelButton: true,
                                                        confirmButtonColor: "#d33",
                                                        cancelButtonColor: "#3085d6",
                                                        confirmButtonText: "Yes, delete it!"
                                                    }).then((result) => {
                                                        if (result.isConfirmed) {
                                                            // Perform the delete action (e.g., call Livewire method or send AJAX request)
                                                            Swal.fire("Deleted!", "The service has been removed.", "success");
                                                        }
                                                    });
                                                }
                                            </script>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- country modal --}}
        <div class="col-xxl-6">
            <div class="card">
                <div class="card-body">
                    <div class="live-preview">
                        <div>
                            <!-- Reusable Country Modal -->
                            <div class="modal fade country-modal" tabindex="-1" role="dialog" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered">
                                    <div class="modal-content">
                                        <div class="modal-body justify-content-center p-5">
                                            <div class="mt-4 text-center">
                                                <h4 class="mb-3" id="modalTitle">Add New Country</h4>
                                                <form id="countryForm" method="POST">
                                                    @csrf
                                                    <input type="hidden" name="_method" id="formMethod" value="POST">

                                                    <div class="col-md-12 justify-content-center">
                                                        <input type="text" class="form-control" name="name"
                                                            id="countryName" required>
                                                        <p class="mt-4">Select Mission</p>
                                                        <select class="form-select" name="embassy_id" id="embassySelect">
                                                            @if (!empty($embassies))
                                                            @foreach ($embassies as $mission)
                                                                <option value="{{ $mission['id'] }}">
                                                                    {{ $mission['name'] }}</option>
                                                            @endforeach
                                                            @endif
                                                        </select>
                                                    </div>

                                                    <div class="hstack gap-2 justify-content-center mt-4">
                                                        <button type="button" class="btn btn-light"
                                                            data-bs-dismiss="modal">Close</button>
                                                        <button type="submit" class="btn btn-primary"
                                                            id="submitBtn">Submit</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div><!-- /.modal -->
                    </div>
                </div>
            </div><!-- end card-body -->
        </div><!-- end card -->

        <script>
            function openCountryModal(id = null, name = '', embassyId = '') {
                const form = document.getElementById('countryForm');
                const methodInput = document.getElementById('formMethod');
                const modalTitle = document.getElementById('modalTitle');
                const nameInput = document.getElementById('countryName');
                const embassySelect = document.getElementById('embassySelect');
            
                if (id) {
                    // Edit Mode
                    form.action = `/countries/${id}`;
                    methodInput.value = 'PUT';
                    modalTitle.textContent = 'Edit Country';
                    nameInput.value = name;
                    embassySelect.value = embassyId;
                } else {
                    // Create Mode
                    form.action = `{{ route('country.store') }}`;
                    methodInput.value = 'POST';
                    modalTitle.textContent = 'Add New Country';
                    nameInput.value = '';
                    embassySelect.selectedIndex = 0;
                }
            }
            </script>
            
    </div>



    {{-- missions modal --}}

    <div class="col-xxl-6">
        <div class="card">
            <div class="">
                <div class="live-preview">
                    <div>
                        <div class="card-body modal fade mission-modal" tabindex="-1" role="dialog"
                            aria-labelledby="mySmallModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered" id="myModal">
                                <div class="modal-content">
                                    <div class="modal-body text-center p-5">

                                        <div class="mt-4">
                                            <h4 class="mb-3">Add New mission</h4>
                                            <form action="{{ route('embassy.store') }}" method="POST">
                                                @csrf
                                                <div class="col-md-12 justify-content-center">
                                                    <input type="text" class="form-control" name="name"
                                                        id="validationDefault03" required>
                                                </div>
                                                <div class="mb-3">
                                                    <label for="embassyTypeDropdown" class="form-label">Type</label>
                                                    <select id="embassyTypeDropdown" class="form-select" name="type"
                                                        required>
                                                        <option value="" disabled
                                                            {{ old('type') == '' ? 'selected' : '' }}>Select Embassy Type
                                                        </option>
                                                        <option value="embassy"
                                                            {{ old('type') == 'embassy' ? 'selected' : '' }}>Mission
                                                        </option>
                                                        <option value="permanent mission"
                                                            {{ old('type') == 'permanent mission' ? 'selected' : '' }}>
                                                            Permanent Mission</option>
                                                        <option value="high commission"
                                                            {{ old('type') == 'high commission' ? 'selected' : '' }}>High
                                                            Commission</option>
                                                    </select>
                                                </div>

                                                <div class="mb-3">
                                                    <label for="statusDropdown" class="form-label">Status</label>
                                                    <select id="statusDropdown" class="form-select" name="is_active"
                                                        required>
                                                        <option value="1"
                                                            {{ old('is_active') === '1' ? 'selected' : '' }}>Active
                                                        </option>
                                                        <option value="0"
                                                            {{ old('is_active') === '0' ? 'selected' : '' }}>Inactive
                                                        </option>
                                                    </select>
                                                </div>


                                                <p class="mt-4">Accredited Countries</p>
                                                <select wire:model="states" class="js-example-basic-multiple" multiple>
                                                    @foreach ($countries as $country)
                                                        <option value="{{ $country['id'] }}">{{ $country['name'] }}
                                                        </option>
                                                    @endforeach
                                                </select>

                                                <div class="hstack gap-2 justify-content-center">
                                                    <button type="button" class="btn btn-light"
                                                        data-bs-dismiss="modal">Close</button>
                                                    <button type="submit" class="btn btn-primary">SUBMIT</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div><!-- /.modal-content -->
                            </div><!-- /.modal-dialog -->
                        </div><!-- /.modal -->
                    </div>
                </div>
            </div><!-- end card-body -->
        </div><!-- end card -->
    </div>


    {{-- service provider modal --}}

    <div class="col-xxl-6">
        <livewire:settings-page />
        {{-- @include("livewire.service-provider-form") --}}
        {{-- <div class="card">
            <div class="">
                <div class="live-preview">
                    <div>
                        <div class=" card-body modal fade service-provider-modal" tabindex="-1" role="dialog"
                            aria-labelledby="mySmallModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered" id="serviceProviderModal">
                                <div class="modal-content">
                                    <div class="modal-body text-center p-5">
                                        <div class="mt-4">
                                            <h4 class="mb-3">New Service Provider</h4>
                                            <form action="">
                                                <div class="col-md-12 justify-content-center">
                                                    <input type="text" class="form-control" id="validationDefault03"
                                                        required>
                                                </div>
                                                <p class="mt-4">Services</p>
                                                <select wire:model="states" class="js-example-basic-multiple" multiple>
                                                    @foreach ($services as $service)
                                                        <option value="{{ $service['id'] }}">{{ $service['name'] }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </form>
                                            <div class="hstack gap-2 justify-content-center">
                                                <button type="button" class="btn btn-light"
                                                    data-bs-dismiss="modal">Close</button>
                                                <a href="javascript:void(0);" class="btn btn-primary">SUBMIT</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div> --}}
    </div>


    {{-- services modal --}}

    <div class="col-xxl-6">
        <div class="card">
            <div class="">
                <div class="live-preview">
                    <div>
                        <div class="card-body modal fade service-modal" tabindex="-1" role="dialog"
                            aria-labelledby="mySmallModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered" id="serviceModal">
                                <div class="modal-content">
                                    <div class="modal-body text-center p-5">

                                        <div class="mt-4">
                                            <h4 class="mb-3">New Service</h4>
                                            <div class="col-md-12 justify-content-center">
                                                <input type="text" class="form-control" id="validationDefault03"
                                                    required>
                                            </div>
                                            <p class="mt-4">Service Provider</p>
                                            <select wire:model="states" class="js-example-basic-multiple">
                                                @foreach ($serviceProviders as $serviceProvider)
                                                    <option value="{{ $serviceProvider['id'] }}">
                                                        {{ $serviceProvider['name'] }}</option>
                                                @endforeach
                                            </select>
                                            <div class="hstack gap-2 justify-content-center">
                                                <button type="button" class="btn btn-light"
                                                    data-bs-dismiss="modal">Close</button>
                                                <a href="javascript:void(0);" class="btn btn-danger">Try Again</a>
                                            </div>
                                        </div>
                                    </div>
                                </div><!-- /.modal-content -->
                            </div><!-- /.modal-dialog -->
                        </div><!-- /.modal -->
                    </div>
                </div>
            </div><!-- end card-body -->
        </div><!-- end card -->
    </div>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
@endsection
</div>
{{-- @section('script')
        <script src="{{ URL::asset('build/js/pages/profile-setting.init.js') }}"></script>
        <script src="{{ URL::asset('build/js/app.js') }}"></script>
    @endsection --}} --}}

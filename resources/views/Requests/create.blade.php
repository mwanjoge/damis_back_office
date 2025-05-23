@extends('layouts.tabler.app')
@section('title', 'Create Request')
@section('content')
    @php
        $breadcrumbs = [
            ['name' => 'Home', 'url' => route('home')],
            ['name' => 'Requests', 'url' => route('requests.index')],
            ['name' => 'Create Request', 'url' => route('requests.create')],
        ];
    @endphp

    {{-- @include('layouts.breadcrumb') --}}

    <form action="{{ route('requests.store') }}" method="POST" enctype="multipart/form-data" id="requestForm">
        @csrf
        @if ($errors->any())
            <div class="alert alert-danger alert-dismissible" role="alert">
                <div class="d-flex">
                    <div>
                        <svg xmlns="http://www.w3.org/2000/svg" class="icon alert-icon" width="24" height="24"
                            viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round"
                            stroke-linejoin="round">
                            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                            <path d="M12 9v2m0 4v.01" />
                            <path
                                d="M5 19h14a2 2 0 0 0 1.84 -2.75l-7.1 -12.25a2 2 0 0 0 -3.5 0l-7.1 12.25a2 2 0 0 0 1.75 2.75" />
                        </svg>
                    </div>
                    <div>
                        <h4 class="alert-title">Error</h4>
                        <ul class="mb-0">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                </div>
                <a class="btn-close" data-bs-dismiss="alert" aria-label="close"></a>
            </div>
        @endif
        @if (session('success'))
            <div class="alert alert-success alert-dismissible" role="alert">
                <div class="d-flex">
                    <div>
                        <svg xmlns="http://www.w3.org/2000/svg" class="icon alert-icon" width="24" height="24"
                            viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round"
                            stroke-linejoin="round">
                            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                            <path d="M5 12l5 5l10 -10" />
                        </svg>
                    </div>
                    <div>
                        {{ session('success') }}
                    </div>
                </div>
                <a class="btn-close" data-bs-dismiss="alert" aria-label="close"></a>
            </div>
        @endif
        @if (session('error'))
            <div class="alert alert-danger alert-dismissible" role="alert">
                <div class="d-flex">
                    <div>
                        <svg xmlns="http://www.w3.org/2000/svg" class="icon alert-icon" width="24" height="24"
                            viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round"
                            stroke-linejoin="round">
                            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                            <path d="M12 9v2m0 4v.01" />
                            <path
                                d="M5 19h14a2 2 0 0 0 1.84 -2.75l-7.1 -12.25a2 2 0 0 0 -3.5 0l-7.1 12.25a2 2 0 0 0 1.75 2.75" />
                        </svg>
                    </div>
                    <div>
                        {{ session('error') }}
                    </div>
                </div>
                <a class="btn-close" data-bs-dismiss="alert" aria-label="close"></a>
            </div>
        @endif

        <div class="page-header d-print-none mb-3">
            <div class="container-xl">
                <div class="row g-2 align-items-center">
                    <div class="col">
                        <h2 class="page-title">Create Request</h2>
                    </div>
                </div>
            </div>
        </div>

        <div class="card mb-4">
            <div class="card-header">
                <h3 class="card-title">Request details</h3>
            </div>
            <div class="card-body">
                <div class="row g-3">
                    <div class="col-md-6">
                        <div class="form-label">Select Current Location</div>
                        <select name="type" id="typeSelect" class="form-select @error('type') is-invalid @enderror"
                            required>
                            <option value="">Select Current Location</option>
                            <option value="Diaspora" {{ old('type') == 'Diaspora' ? 'selected' : '' }}>Diaspora</option>
                            <option value="Domestic" {{ old('type') == 'Domestic' ? 'selected' : '' }}>Domestic</option>
                        </select>
                        @error('type')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-6">
                        <div class="d-flex justify-content-between align-items-center">
                            <div class="form-label">Applicant Name</div>
                            <button type="button" class="btn btn-primary btn-icon btn-sm" data-bs-toggle="modal"
                                data-bs-target="#addMemberModal">
                                <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24"
                                    viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                                    stroke-linecap="round" stroke-linejoin="round">
                                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                    <path d="M12 5l0 14" />
                                    <path d="M5 12l14 0" />
                                </svg>
                                New Applicant
                            </button>
                        </div>
                        <select id="member_id" name="member_id" data-choices
                            class="form-select @error('member_id') is-invalid @enderror" required>
                            <option value="">Select Applicant</option>
                            @foreach ($members as $member)
                                <option value="{{ $member->id }}" data-type="{{ $member->type }}"
                                    {{ old('member_id') == $member->id ? 'selected' : '' }}>{{ $member->name }}</option>
                            @endforeach
                        </select>
                        @error('member_id')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-6">
                        <div class="form-label">Country</div>
                        <select id="countrySelect" name="country_id" data-choices
                            class="form-select @error('country_id') is-invalid @enderror">
                            <option value="">Select Country</option>
                            @foreach ($countries as $country)
                                <option value="{{ $country->id }}"
                                    {{ old('country_id') == $country->id ? 'selected' : '' }}>{{ $country->name }}
                                </option>
                            @endforeach
                        </select>
                        @error('country_id')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-6">
                        <input type="hidden" id="priceValue" name="price">
                        <div id="priceDisplay" class="mt-3" style="display: none;">
                            {{-- <div class="card card-sm"> --}}
                                <div class="card-body">
                                    <div class="d-flex align-items-center">
                                        <div class="avatar bg-azure-lt">
                                            <svg xmlns="http://www.w3.org/2000/svg"
                                                class="icon icon-tabler icon-tabler-coin" width="24" height="24"
                                                viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"
                                                fill="none" stroke-linecap="round" stroke-linejoin="round">
                                                <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                                <path d="M12 12m-9 0a9 9 0 1 0 18 0a9 9 0 1 0 -18 0"></path>
                                                <path
                                                    d="M14.8 9a2 2 0 0 0 -1.8 -1h-2a2 2 0 1 0 0 4h2a2 2 0 1 1 0 4h-2a2 2 0 0 1 -1.8 -1">
                                                </path>
                                                <path d="M12 7v10"></path>
                                            </svg>
                                        </div>
                                        <div class="mx-2">
                                            <div class="font-weight-medium">Price per service</div>
                                            <div class="text-muted" id="priceValueDisplay"></div>
                                        </div>
                                    </div>
                                </div>
                            {{-- </div> --}}
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div name="request_items">
            @livewire('request-items')
        </div>

        <div class="form-footer d-flex justify-content-end mt-4">
            <button type="submit" class="btn btn-primary" id="submitBtn">
                <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-device-floppy" width="24"
                    height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                    stroke-linecap="round" stroke-linejoin="round">
                    <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                    <path d="M6 4h10l4 4v10a2 2 0 0 1 -2 2h-12a2 2 0 0 1 -2 -2v-12a2 2 0 0 1 2 -2"></path>
                    <path d="M12 14m-2 0a2 2 0 1 0 4 0a2 2 0 1 0 -4 0"></path>
                    <path d="M14 4l0 4l-6 0l0 -4"></path>
                </svg>
                Submit Request
            </button>
        </div>
    </form>

    <!-- Member Modal -->
    <div>
        @livewire('add-member-modal')
    </div>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            // Initialize all elements with data-choices again to ensure they work
            if (typeof Choices !== 'undefined') {
                const choicesElements = document.querySelectorAll('[data-choices]');
                if (choicesElements.length > 0) {
                    choicesElements.forEach(function(element) {
                        new Choices(element, {
                            searchEnabled: true,
                            itemSelectText: '',
                            shouldSort: false
                        });
                    });
                }
            }

            const typeSelect = document.getElementById("typeSelect");
            const countrySelect = document.getElementById("countrySelect");
            const memberSelect = document.getElementById("member_id");
            const priceDisplay = document.getElementById("priceDisplay");
            const priceValue = document.getElementById("priceValue");
            const priceValueDisplay = document.getElementById("priceValueDisplay");
            const requestForm = document.getElementById("requestForm");
            const submitBtn = document.getElementById("submitBtn");

            // Get the parent div of the country select field
            const countryFieldDiv = countrySelect.closest('.col-md-6');

            // Add event listener with a small delay to ensure DOM is fully loaded
            setTimeout(() => {
                typeSelect.addEventListener("change", function() {
                    if (this.value === "Domestic") {
                        // Set Tanzania as the country (ID 172) and hide the field
                        countrySelect.value = "172";
                        countryFieldDiv.style.display = "none";
                    } else {
                        // Show the country field for Diaspora
                        countryFieldDiv.style.display = "block";
                    }
                    fetchPrice();
                });

                countrySelect.addEventListener("change", fetchPrice);
            }, 100);

            function fetchPrice() {
                const countryId = countrySelect.value;
                const memberId = memberSelect.value;
                const type = typeSelect.value;

                if (!countryId || !type) {
                    priceDisplay.style.display = 'none';
                    return;
                }

                // If domestic, ensure we're using Tanzania's country ID
                const queryCountryId = type === "Domestic" ? 172 : countryId;

                fetch(`/billable-price?country_id=${queryCountryId}`, {
                        headers: {
                            'X-Requested-With': 'XMLHttpRequest',
                            'Accept': 'application/json'
                        }
                    })
                    .then(response => {
                        if (!response.ok) throw new Error('Server error');
                        return response.json();
                    })
                    .then(data => {
                        if (data.success) {
                            priceValue.value = parseFloat(data.price.replace(/,/g, ''));
                            priceValueDisplay.textContent = `${data.price} ${data.currency}`;
                            priceDisplay.style.display = 'block';
                        } else {
                            priceValueDisplay.textContent = 'N/A';
                            priceDisplay.style.display = 'block';
                        }
                    })
                    .catch(error => {
                        console.error('Fetch error:', error);
                        priceValueDisplay.textContent = 'Error loading price';
                        priceDisplay.style.display = 'block';
                    });
            }

            // Set initial state based on the current value of typeSelect
            setTimeout(() => {
                if (typeSelect.value === "Domestic") {
                    countrySelect.value = 172;
                    countryFieldDiv.style.display = "none";
                }

                // Initial call to fetch price
                typeSelect.dispatchEvent(new Event("change"));
            }, 200);

            // Handle form submission with SweetAlert
            requestForm.addEventListener('submit', function(e) {
                e.preventDefault();

                // Show loading state
                submitBtn.disabled = true;
                submitBtn.innerHTML =
                    '<span class="spinner-border spinner-border-sm me-2" role="status" aria-hidden="true"></span> Submitting...';
                // Submit the form
                fetch(requestForm.action, {
                        method: 'POST',
                        body: new FormData(requestForm),
                        headers: {
                            'X-Requested-With': 'XMLHttpRequest',
                            'Accept': 'application/json'
                        }
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            Swal.fire({
                                icon: 'success',
                                title: 'Success',
                                text: data.message || 'Request submitted successfully!',
                                confirmButtonColor: '#206bc4',
                                confirmButtonText: 'OK'
                            }).then((result) => {
                                if (result.isConfirmed) {
                                    window.location.href = data.redirect || '/requests';
                                }
                            });
                        } else {
                            Swal.fire({
                                icon: 'error',
                                title: 'Error',
                                text: data.message ||
                                    'There was an error submitting your request. Please try again.',
                                confirmButtonColor: '#206bc4',
                                confirmButtonText: 'OK'
                            });
                            submitBtn.disabled = false;
                            submitBtn.innerHTML =
                                '<svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-device-floppy" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"></path><path d="M6 4h10l4 4v10a2 2 0 0 1 -2 2h-12a2 2 0 0 1 -2 -2v-12a2 2 0 0 1 2 -2"></path><path d="M12 14m-2 0a2 2 0 1 0 4 0a2 2 0 1 0 -4 0"></path><path d="M14 4l0 4l-6 0l0 -4"></path></svg> Submit Request';
                        }
                    })
                    .catch(error => {
                        console.error('Error:', error);
                        Swal.fire({
                            icon: 'error',
                            title: 'Error',
                            text: 'There was an error submitting your request. Please try again.',
                            confirmButtonColor: '#206bc4',
                            confirmButtonText: 'OK'
                        });
                        submitBtn.disabled = false;
                        submitBtn.innerHTML =
                            '<svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-device-floppy" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"></path><path d="M6 4h10l4 4v10a2 2 0 0 1 -2 2h-12a2 2 0 0 1 -2 -2v-12a2 2 0 0 1 2 -2"></path><path d="M12 14m-2 0a2 2 0 1 0 4 0a2 2 0 1 0 -4 0"></path><path d="M14 4l0 4l-6 0l0 -4"></path></svg> Submit Request';
                    });
            });
        });

        window.addEventListener('member-added', () => {
            // Close the modal
            const modal = document.getElementById('addMemberModal');
            if (modal && typeof bootstrap !== 'undefined') {
                const bootstrapModal = bootstrap.Modal.getInstance(modal);
                if (bootstrapModal) {
                    bootstrapModal.hide();
                }
            }

            // Show a success message
            if (typeof Swal !== 'undefined') {
                Swal.fire({
                    icon: 'success',
                    title: 'Success',
                    text: 'Member added successfully!',
                    confirmButtonColor: '#206bc4',
                    confirmButtonText: 'OK'
                });
            }
        });
    </script>
@endsection

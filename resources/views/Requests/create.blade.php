@extends('layouts.tabler.app')
@section('title', 'Create Request')
@section('content')
    @php
        $breadcrumbs = [
            ['name' => 'Home', 'url' => route('home')],
            ['name' => 'Requests', 'url' => route('requests.index')],
            ['name' => 'Create Request', 'url' => route('requests.create')]
        ];
    @endphp

    {{-- @include('layouts.breadcrumb') --}}

    <form action="{{ route('requests.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul class="mb-0">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <div class="mb-3 d-flex justify-content-between align-items-center">
            <h2 class="mb-0">Create Request</h2>
        </div>
        <div class="card mb-4">
            <div class="card-header">
                <h5 class="mb-0">Request details</h5>
            </div>
            <div class="card-body">

                <div class="row g-3">
                    <div class="col-md-6">
                        <label class="form-label">Type</label>

                        <select name="type" id="typeSelect" class="form-select @error('type') is-invalid @enderror"
                            required>
                            <option value="Diaspora" {{ old('type') == 'Diaspora' ? 'selected' : '' }}>Diaspora</option>
                            <option value="Domestic" {{ old('type') == 'Domestic' ? 'selected' : '' }}>Domestic</option>
                        </select>
                        @error('type')
                            <span class="invalid-feedback">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="col-md-6">
                        <div class="d-flex justify-content-between align-items-center mb-1">
                            <label class="form-label mb-0">Applicant Name</label>
                            <button type="button" class="btn btn-primary btn-sm px-4 py-0" data-bs-toggle="modal"
                                data-bs-target="#addMemberModal">
                                <i class="bx bx-plus"></i>New Applicant
                            </button>
                        </div>

                        <select id="member_id" name="member_id" data-choices class="form-control data-choices @error('member_id') is-invalid @enderror" required>
                            <option value="">Select Applicant</option>
                            @foreach ($members as $member)
                                <option value="{{ $member->id }}" data-type="{{ $member->type }}"
                                    {{ old('member_id') == $member->id ? 'selected' : '' }}>{{ $member->name }}</option>
                            @endforeach
                        </select>

                        @error('member_id')
                            <span class="invalid-feedback d-block">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="col-md-6">
                        <label class="form-label">Country</label>
                        <select id="countrySelect" name="country_id" data-choices
                            class="form-control  @error('country_id') is-invalid @enderror" required>
                            <option value="">Select Country</option>
                            @foreach ($countries as $country)
                                <option value="{{ $country->id }}"
                                    {{ old('country_id') == $country->id ? 'selected' : '' }}>{{ $country->name }}
                                </option>
                            @endforeach
                        </select>
                        @error('country_id')
                            <span class="invalid-feedback">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="col-md-6">

                        <input type="hidden" id="priceValue" name="price">
                        <div id="priceDisplay" class="mt-3 fw-bold" style="display: none;">
                            <div class="d-flex flex-column">
                                <label class="form-label fw-bold">Price per service:</label>
                                <span id="priceValueDisplay" style="font-weight: bold;"></span>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>

        <div name="request_items">
            @livewire('request-items')
        </div>

        <div class="mb-3 d-flex justify-content-end">
            <button type="submit" class="btn btn-primary btn-sm">Submit</button>
        </div>
    </form>

    <!-- Member Modal -->
    <div>
        @livewire('add-member-modal')
    </div>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const typeSelect = document.getElementById("typeSelect");
            const countrySelect = document.getElementById("countrySelect");
            const memberSelect = document.getElementById("member_id");
            const priceDisplay = document.getElementById("priceDisplay");
            const priceValue = document.getElementById("priceValue");
            const priceValueDisplay = document.getElementById("priceValueDisplay");

            typeSelect.addEventListener("change", function() {
                if (this.value === "Domestic") {
                    countrySelect.value = "174";
                    countrySelect.setAttribute("disabled", true);
                } else {
                    countrySelect.removeAttribute("disabled");
                }
                fetchPrice();
            });

            countrySelect.addEventListener("change", fetchPrice);

            function fetchPrice() {
                const countryId = countrySelect.value;
                const memberId = memberSelect.value;
                const type = typeSelect.value;

                if (!countryId || !type) {
                    priceDisplay.style.display = 'none';
                    return;
                }

                fetch(`/billable-price?country_id=${countryId}`)
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
                            priceValue.textContent = 'N/A';
                            priceDisplay.style.display = 'none';
                        }
                    })
                    .catch(error => {
                        console.error('Fetch error:', error);
                        priceValue.textContent = 'Error loading price';
                        priceDisplay.style.display = 'block';
                    });

            }

            // Initial call
            typeSelect.dispatchEvent(new Event("change"));
        });

        window.addEventListener('member-added', () => {
            // Close the modal
            const modal = document.getElementById('addMemberModal');
            const bootstrapModal = bootstrap.Modal.getInstance(modal);
            bootstrapModal.hide();

            // Optionally, show a success message
            Swal.fire({
                icon: 'success',
                title: 'Success',
                text: 'Member added successfully!',
                confirmButtonColor: '#3085d6',
                confirmButtonText: 'OK'
            });
        });
    </script>
@endsection

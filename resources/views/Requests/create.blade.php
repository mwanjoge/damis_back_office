@extends('layouts.master')
@section('title', 'Create Request')
@section('content')
<form action="{{ route('requests.store') }}" method="POST" enctype="multipart/form-data">
    @csrf
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
                    <label class="form-label">Embassy</label>
                    <select id="embassySelect" name="embassy_id" class="data-choices" required>
                       <option value="">Select Embassy</option>
                           @foreach($embassies as $embassy) 
                             <option value="{{ $embassy->id }}">{{ $embassy->name }}</option> 
                          @endforeach 
                    </select>
                </div>
                <div class="col-md-6">
                    <label class="form-label">Member</label>
                    <div class="input-group">
                    <select id="member_id" name="member_id" class="data-choices" required>      <option value="">Select Member</option>
                               @foreach($members as $member) 

                               <option value="{{ $member->id }}" data-type="{{ $member->type }}">{{ $member->name }}</option> 
                                @endforeach 
                        </select>
                        <button aria-atomic="" type="button" class="btn btn-outline-primary" data-bs-toggle="modal" data-bs-target="#addMemberModal">
                            <i class="bx bx-plus"></i>
                        </button>
                    </div>
                </div>
                <div class="col-md-6">
                    <label class="form-label">Country</label>
                    <select id="countrySelect" name="country_id" class="data-choices" required>
                        <option value="">Select Country</option>
                            @foreach($countries as $country) 
                                 <option value="{{ $country->id }}">{{ $country->name }}</option> 
                            @endforeach 
                    </select>
                </div>
                <div class="col-md-6">
                    <label class="form-label">Type</label>
                    <select name="type" class="form-select" required>
                        <option value="Diaspora">Diaspora</option>
                        <option value="Domestic">Domestic</option>
                    </select>
                </div>
            </div>
        </div>
    </div>

    <!-- <div class="card mb-4"> -->

      <!--   <div class="card-body">
            <div id="request-items-list">
                <div class="request-item-row row g-2 mb-2 align-items-end">
                  
                    <div class="col">
                        <label class="form-label form-label-sm">Service Provider</label>
                        <select name="request_items[0][service_provider_id]" class="form-select form-select-sm" required>
                            <option value="">Select Provider</option>
                            @foreach($serviceProviders as $provider)
                                <option value="{{ $provider->id }}">{{ $provider->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col">
                        <label class="form-label form-label-sm">Service</label>
                        <select name="request_items[0][service_id]" class="form-select form-select-sm" required>
                            <option value="">Select Service</option>
                            @foreach($services as $service)
                                <option value="{{ $service->id }}">{{ $service->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col">
                        <label class="form-label form-label-sm">Price</label>
                        <div class="input-group input-group-sm">
                            <span class="input-group-text">TZS</span>
                            <input type="number" name="request_items[0][price]" class="form-control form-control-sm" step="0.01" required>
                        </div>
                    </div>
                    <div class="col">
                        <label class="form-label form-label-sm">Certificate Holder</label>
                        <input type="text" name="request_items[0][certificate_holder_name]" class="form-control form-control-sm" required>
                    </div>
                    <div class="col">
                        <label class="form-label form-label-sm">Index Number</label>
                        <input type="text" name="request_items[0][certificate_index_number]" class="form-control form-control-sm">
                    </div>
                    <div class="col">
                        <label class="form-label form-label-sm">Attachment</label>
                        <div class="input-group input-group-sm">
                            <input type="file" name="request_items[0][attachment]" class="form-control form-control-sm" placeholder="Attachment">
    
                        </div>
                    </div>
                    <div class="col-auto">
                        <button type="button" class="btn btn-danger btn-sm remove-item">
                            <i class="bx bx-trash"></i>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div> -->

    <div>
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
    window.addEventListener('member-added', () => {
        // Close the modal
        const modal = document.getElementById('addMemberModal');
        const bootstrapModal = bootstrap.Modal.getInstance(modal);        bootstrapModal.hide();

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
<script>
    document.addEventListener('livewire:load', function () {
        Livewire.on('memberAdded', function (id, name) {
            let memberSelect = document.getElementById('member_id');
            // Add the new member as an option if not present
            let exists = Array.from(memberSelect.options).some(opt => opt.value == id);
            if (!exists) {
                let option = new Option(name, id, true, true);
                memberSelect.add(option);
            }
            // Select the new member
            memberSelect.value = id;
            // Trigger change event if needed
            memberSelect.dispatchEvent(new Event('change'));        });    });
</script>
@endsection

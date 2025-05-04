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
                                 <option value="{{ $member->id }}">{{ $member->name }}</option> 
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
<div class="modal fade" id="addMemberModal" tabindex="-1" aria-labelledby="addMemberModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <form id="memberForm" method="POST" action="{{ route('members.store') }}">
      @csrf
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="addMemberModalLabel">Add Member</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <div class="mb-3">
            <label for="member_name" class="form-label">Name</label>
            <input type="text" class="form-control" id="member_name" name="name" required>
          </div>
          <div class="mb-3">
            <label for="member_email" class="form-label">Email</label>
            <input type="email" class="form-control" id="member_email" name="email">
          </div>
          <div class="mb-3">
            <label for="member_phone" class="form-label">Phone</label>
            <input type="text" class="form-control" id="member_phone" name="phone">
          </div>
          
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary btn-sm">Save Member</button>
        </div>
      </div>
    </form>
  </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const addButton = document.getElementById('add-request-item');
        const requestItemsList = document.getElementById('request-items-list');
        const templateRow = document.getElementById('request-item-template');

        function initSelect2(container) {
            container.querySelectorAll('select').forEach(select => {
                $(select).select2({
                    theme: 'bootstrap-5',
                    width: '100%',
                    placeholder: 'Select an option'
                });
            });
        }

        // Init Select2 on static fields
        $('#embassySelect').select2({ theme: 'bootstrap-5', width: '100%', placeholder: 'Select Embassy' });
        $('#countrySelect').select2({ theme: 'bootstrap-5', width: '100%', placeholder: 'Select Country' });
        $('#member_id').select2({ theme: 'bootstrap-5', width: '100%', placeholder: 'Select Member' });

        // Init Select2 on the first visible row
        initSelect2(requestItemsList);

        // Add dynamic item row
        addButton.addEventListener('click', function () {
            const newRow = templateRow.cloneNode(true);
            newRow.classList.remove('d-none');
            newRow.removeAttribute('id');

            newRow.querySelectorAll('input, select').forEach(input => {
                if (input.type !== 'file') input.value = '';
            });

            requestItemsList.appendChild(newRow);
            initSelect2(newRow);
        });

        // Remove row
        requestItemsList.addEventListener('click', function (e) {
            if (e.target.closest('.remove-item')) {
                const row = e.target.closest('.request-item-row');
                if (row && requestItemsList.children.length > 1) {
                    row.remove();
                }
            }
        });
    });
   
 document.addEventListener('DOMContentLoaded', function () {
    const typeSelect = document.getElementById('type');
    const domesticFields = document.querySelector('.domestic-only');

    function toggleDomesticFields() {
        if (typeSelect.value === 'Domestic') {
            domesticFields.classList.remove('d-none');
        } else {
            domesticFields.classList.add('d-none');
        }
    }

    typeSelect.addEventListener('change', toggleDomesticFields);
    toggleDomesticFields(); // on page load
});

</script>
@endsection

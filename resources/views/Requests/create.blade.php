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
                    <select name="embassy_id" class="form-select" required>
                        <option value="">Select Embassy</option>
                           @foreach($embassies as $embassy) 
                             <option value="{{ $embassy->id }}">{{ $embassy->name }}</option> 
                          @endforeach 
                    </select>
                </div>
                <div class="col-md-6">
                    <label class="form-label">Member</label>
                    <div class="input-group">
                        <select name="member_id" class="form-select" required>
                            <option value="">Select Member</option>
                               @foreach($members as $member) 
                                 <option value="{{ $member->id }}">{{ $member->name }}</option> 
                                @endforeach 
                        </select>
                        <button type="button" class="btn btn-outline-primary" data-bs-toggle="modal" data-bs-target="#addMemberModal">
                            <i class="bx bx-plus"></i>
                        </button>
                    </div>
                </div>
                <div class="col-md-6">
                    <label class="form-label">Country</label>
                    <select name="country_id" class="form-select" required>
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

    <div class="card mb-4">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h5 class="mb-0">Requested Items</h5>
            <button type="button" id="add-request-item" class="btn btn-secondary btn-sm">Add Requested Item</button>
        </div>
        <div class="card-body">
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
let itemIndex = 1;
document.getElementById('add-request-item').onclick = function() {
    let container = document.getElementById('request-items-list');
    let row = document.createElement('div');
    row.className = 'request-item-row row g-2 mb-2 align-items-end';
    row.innerHTML = `
       
        <div class="col">
            <label class="form-label form-label-sm">Service Provider</label>
            <select name="request_items[${itemIndex}][service_provider_id]" class="form-select form-select-sm" required>
                <option value="">Select Provider</option>
                @foreach($serviceProviders as $provider)
                    <option value="{{ $provider->id }}">{{ $provider->name }}</option>
                @endforeach
            </select>
        </div>
         <div class="col">
            <label class="form-label form-label-sm">Service</label>
            <select name="request_items[${itemIndex}][service_id]" class="form-select form-select-sm" required>
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
                <input type="number" name="request_items[${itemIndex}][price]" class="form-control form-control-sm" step="0.01" required>
            </div>
        </div>
        <div class="col">
            <label class="form-label form-label-sm">Certificate Holder</label>
            <input type="text" name="request_items[${itemIndex}][certificate_holder_name]" class="form-control form-control-sm" required>
        </div>
        <div class="col">
            <label class="form-label form-label-sm">Index Number</label>
            <input type="text" name="request_items[${itemIndex}][certificate_index_number]" class="form-control form-control-sm">
        </div>
        <div class="col">
            <label class="form-label form-label-sm">Attachment</label>
            <div class="input-group input-group-sm">
                <input type="file" name="request_items[${itemIndex}][attachment]" class="form-control form-control-sm" placeholder="Attachment">
              
            </div>
        </div>
        <div class="col-auto">
            <button type="button" class="btn btn-danger btn-sm remove-item">
                <i class="bx bx-trash"></i>
            </button>
        </div>
    `;
    container.appendChild(row);
    itemIndex++;
};
document.getElementById('request-items-list').addEventListener('click', function(e) {
    if (e.target.classList.contains('remove-item')) {
        let rows = document.querySelectorAll('.request-item-row');
        if (rows.length > 1) {
            e.target.closest('.request-item-row').remove();
        }
    }
});
</script>
@endsection

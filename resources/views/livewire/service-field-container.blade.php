@include("modal.alert")
<div wire.ignore.self>
    <div class="row mt-3">
        <div class="col">Add provider's services</div>
        <div class="col">
            <button wire:click="addInput" class="btn btn-outline-primary btn-sm mb-1 float-end">
                <i class="bx bx-plus"></i> Add Service
            </button>
        </div>  
        <div class="col-12"><hr class="mb-3 mt-0"></div>
    </div>
    <div class="row">
        <div class="col-12">
            @foreach($inputs as $key => $value)
                <div class="service-field mb-3 d-flex">
                    <input type="text" wire:model="inputs.{{ $key }}" class="form-control me-2" placeholder="Enter service" name="service_name[]" >
                    <button wire:click="removeInput({{ $key }})" class="btn btn-danger">
                        <i class="bx bx-trash"></i>
                    </a>
                </div>
            @endforeach
        </div>
    </div>
</div>

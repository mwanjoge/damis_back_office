<div>
    <button type="button" wire:click="addInput" class="btn btn-link mb-3 text-primary fw-bolder">New Service</button>

    @foreach($inputs as $key => $value)
        <div class="service-field mb-3 d-flex">
            <input type="text" wire:model="inputs.{{ $key }}" class="form-control me-2" placeholder="Enter service" required>
            <button wire:click="removeInput({{ $key }})" class="btn btn-danger">
                <i class="bx bx-trash"></i>
            </button>
        </div>
    @endforeach
</div>

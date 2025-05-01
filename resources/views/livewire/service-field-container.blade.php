<div>
    <a wire:click="addInput" class="btn btn-primary mb-3">Add</a>

    @foreach($inputs as $key => $value)
        <div class="service-field mb-3 d-flex">
            <input type="text" wire:model="inputs.{{ $key }}" class="form-control me-2" placeholder="Enter service" required>
            <a wire:click="removeInput({{ $key }})" class="btn btn-danger">Remove</a>
        </div>
    @endforeach
</div>

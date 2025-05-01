<div>
    <a wire:click="addInput" class="btn btn-primary">add</a>
    @for($i = 0; $i < $count; $i++)
        <div class="service-field mb-3">
            <input type="text" class="form-control"  placeholder="Enter service" required>
        </div>
    @endfor
</div>

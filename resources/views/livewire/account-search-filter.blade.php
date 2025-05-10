<div>
    <div class="row mb-3">
        <div class="col">
            <input type="text" wire:model.debounce.500ms="search" class="form-control form-control-sm" placeholder="Search accounts...">
        </div>
 
        <div class="col">
            <select wire:model="embassy_id" data-choices class="form-control form-control-sm">
                <option value="">All Embassies</option>
                @foreach($embassies as $embassy)
                    <option value="{{ $embassy->id }}">{{ $embassy->name }}</option>
                @endforeach
            </select>
        </div>
       
    </div>
</div>

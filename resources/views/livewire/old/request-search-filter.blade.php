<div>
    <div class="row mb-3">
        <div class="col">
            <input type="text" wire:model.debounce.500ms="search" class="form-control form-control-sm" placeholder="Search by tracking number...">
        </div>
        <div class="col">
            <select wire:model="status" class="form-control form-control-sm">
                <option value="">All Statuses</option>
                <option value="Pending">Pending</option>
                <option value="In Progress">In Progress</option>
                <option value="Completed">Completed</option>
                <option value="Cancelled">Cancelled</option>
            </select>
        </div>
        <div class="col">
            <select wire:model="embassy_id" data-choices class="form-control form-control-sm">
                <option value="">All Embassies</option>
                @foreach($embassies as $embassy)
                    <option value="{{ $embassy->id }}">{{ $embassy->name }}</option>
                @endforeach
            </select>
        </div>
        <div class="col">
            <select wire:model="country_id" data-choices class="form-control form-control-sm">
                <option value="">All Countries</option>
                @foreach($countries as $country)
                    <option value="{{ $country->id }}">{{ $country->name }}</option>
                @endforeach
            </select>
        </div>
    </div>
</div>

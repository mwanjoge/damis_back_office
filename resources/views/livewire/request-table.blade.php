<div class="container">
    <!-- Status Tabs -->
    <ul class="nav nav-pills mb-4" role="tablist">
        @foreach(['Pending', 'In Progress', 'Completed', 'Cancelled'] as $tabStatus)
            <li class="nav-item" role="presentation">
                <button class="nav-link @if($status === $tabStatus) active @endif" wire:click="setStatus('{{ $tabStatus }}')" type="button" role="tab">
                    {{ $tabStatus }}
                </button>
            </li>
        @endforeach
    </ul>
    <div class="card">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered table-striped table-centered align-middle table-nowrap mb-0">
                    <thead class="table-light">
                        <tr>
                            <th>#</th>
                            <th>Mission</th>
                            <th>Country</th>
                            <th class="text-end">Price</th>
                            <th class="text-start">Currency</th>                            
                            <th>Status</th>
                            <th>Approved</th>
                            <th>Paid</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                    @forelse($this->filteredRequests as $request)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $request->embassy->name }}</td>
                            <td>{{ $request->country->name }}</td>
                            <td class="text-end">{{ number_format($request->total_cost, 2) }}</td>
                            <td class="text-start">{{ $request->country->currency_code }}</td>
                            <td>
                                <span class="badge 
                                    @if($request->status === 'Completed') bg-success
                                    @elseif($request->status === 'Pending') bg-warning text-dark
                                    @elseif($request->status === 'Cancelled') bg-danger
                                    @else bg-info
                                    @endif">
                                    {{ $request->status }}
                                </span>
                            </td>
                            <td>
                                @if($request->is_approved)
                                    <span class="badge bg-success">Yes</span>
                                @else
                                    <span class="badge bg-warning text-dark">No</span>
                                @endif
                            </td>
                            <td>
                                @if($request->is_paid)
                                    <span class="badge bg-success">Yes</span>
                                @else
                                    <span class="badge bg-danger">No</span>
                                @endif
                            </td>
                            <td>
                                <a href="{{ route('requests.show', $request->id) }}" class="btn btn-primary btn-sm">View</a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="9" class="text-center text-muted">No requests found.</td>
                        </tr>
                    @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

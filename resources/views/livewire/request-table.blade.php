<div>
    <!-- Status Tabs -->
    <ul class="nav nav-pills mb-3" role="tablist">
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
            <table class="table table-borderless table-centered align-middle table-nowrap mb-0">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Account</th>
                        <th>Status</th>
                        <th>Approved</th>
                        <th>Paid</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                @foreach($this->filteredRequests as $request)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $request->account_id }}</td>
                        <td>{{ $request->status }}</td>
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
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

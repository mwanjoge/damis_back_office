<div class="container">
    <!-- Status Tabs -->
    <ul class="nav nav-pills mb-4" role="tablist">
        @foreach(['Pending', 'In Progress', 'Completed', 'Cancelled'] as $tabStatus)
            <li class="nav-item" role="presentation">
                <button class="nav-link {{$status === $tabStatus ? 'active' : ''}}" wire:click="setStatus('{{ $tabStatus }}')" type="button" role="tab">
                    {{ $tabStatus }}
                </button>
            </li>
        @endforeach
    </ul>

    <div class="table-responsive table-card">
        <table id="scroll-horizontal" class="table nowrap mb-0 datatable" style="width: 100%;">
            <thead class="text-muted table-light">
            <tr>
                <th>#</th>
                <th style="width: 200px;">Mission</th>
                <th style="width: 150px;">Country</th>
                <th class="text-end">Price</th>
                <th class="text-start">Currency</th>
                <th>Status</th>
                <th>Approved</th>
                <th>Paid</th>
                <th>Actions</th>
            </tr>
            </thead>
            <tbody>
            @forelse($requests as $request)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td class="embassy" style="max-width: 200px; overflow: hidden; text-overflow: ellipsis; white-space: nowrap;" title="{{ $request->embassy?->name ?? 'N/A' }}">
                        {{ $request->embassy?->name ?? 'N/A' }}
                    </td>
                    <td class="country" style="max-width: 150px; overflow: hidden; text-overflow: ellipsis; white-space: nowrap;" title="{{ $request->country?->name ?? 'N/A' }}">
                        {{ $request->country?->name ?? 'N/A' }}
                    </td>
                    <td class="text-end">{{ number_format($request->total_cost, 2) }}</td>
                    <td class="text-start">{{ $request->country?->currency_code ?? 'N/A' }}</td>
                    <td>
                        <span class="badge
                            @if($request->status === 'Completed') bg-success-subtle text-success
                            @elseif($request->status === 'Pending') bg-warning-subtle text-warning
                            @elseif($request->status === 'Cancelled') bg-danger-subtle text-danger
                            @else bg-info
                            @endif">
                            {{ $request->status }}
                        </span>
                    </td>
                    <td>
                        @if($request->is_approved)
                            <span class="badge bg-success-subtle text-success">Yes</span>
                        @else
                            <span class="badge bg-warning-subtle text-warning">No</span>
                        @endif
                    </td>
                    <td>
                        @if($request->is_paid)
                            <span class="badge bg-success-subtle text-success">Yes</span>
                        @else
                            <span class="badge bg-danger-subtle text-danger">No</span>
                        @endif
                    </td>
                    <td>
                        <a href="{{ route('requests.show', encode([$request->id])) }}" class="btn btn-primary btn-sm">
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-eye" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                <path d="M10 12a2 2 0 1 0 4 0a2 2 0 0 0 -4 0"></path>
                                <path d="M21 12c-2.4 4 -5.4 6 -9 6c-3.6 0 -6.6 -2 -9 -6c2.4 -4 5.4 -6 9 -6c3.6 0 6.6 2 9 6"></path>
                            </svg>
                            View
                        </a>
                    </td>
                </tr>
            @empty
                {{-- <tr>
                    <td colspan="9" class="text-center text-muted">No requests found.</td>
                </tr> --}}
            @endforelse
            </tbody>
        </table>
    </div>
</div>

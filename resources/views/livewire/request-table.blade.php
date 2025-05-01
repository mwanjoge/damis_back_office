<div>
    <h2>Requests</h2>
    <table class="table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Account</th>
                <th>Status</th>
                <th>Approved</th>
                <th>Paid</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
        @foreach($requests as $request)
            <tr>
                <td>{{ $request->id }}</td>
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

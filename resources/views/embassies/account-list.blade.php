<div class="table-responsive">
    <table class="table table-striped align-middle">
        <thead>
            <tr>
                <th>Embassy</th>
                <th>Account Name</th>
                <th>Created</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($embassies as $embassy)
                <tr>
                    <td>{{ $embassy->name }}</td>
                    <td>{{ $embassy->account->name ?? 'N/A' }}</td>
                    <td>{{ optional($embassy->account)->created_at?->format('Y-m-d') }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>

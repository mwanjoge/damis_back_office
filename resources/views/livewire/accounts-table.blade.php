<div>
    <div class="table-responsive" wire:ignore>
        <table class="table table-striped align-middle">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Account Name</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($embassies as $embassy)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $embassy->account->name ?? 'N/A' }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

<div>
    <div class="table-responsive" wire:ignore>
        <table class="table table-striped align-middle datatable">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Account Name</th>
                    <th class="text-end">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($embassies as $embassy)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $embassy->account->name ?? 'N/A' }}</td>
                        <td class="text-end">
                            <a href="{{ route('embassies.show', encode([$embassy->id])) }}" class="btn btn-info btn-sm">
                                <i class="bx bx-detail"></i>
                            </a>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

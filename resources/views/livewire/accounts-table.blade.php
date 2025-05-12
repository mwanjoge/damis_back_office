<div>
    <div class="table-responsive">
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
    <div class="d-flex justify-content-center mt-4">
        {{ $embassies->links('pagination::bootstrap-5') }}
    </div>
</div>
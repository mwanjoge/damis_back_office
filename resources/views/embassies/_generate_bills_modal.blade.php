<div class="modal fade" id="generateBillsModal{{ $embassy->country_id }}" tabindex="-1" aria-labelledby="generateBillsModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                {{-- <h5 class="modal-title" id="generateBillsModalLabel">Generate Bills For {{$embassy->countries->name}}</h5> --}}
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="generateBillsForm" action="{{ route('bills.store') }}" method="POST">
                    @csrf
                    <input type="hidden" name="account_id" value="{{ $embassy->account->id }}">
                    <input type="hidden" name="embassy_id" value="{{ $embassy->id }}">
                    <input type="hidden" name="country_id" value="{{ $embassy->country_id }}">
                    <input type="hidden" name="currency" value="{{ $embassy->countries->first()->currency_code ?? $embassy->countries->first()->currency ?? 'N/A' }}">
                    <div class="mb-3">
                        <label for="amount" class="form-label">Provide Service Fee</label>
                        <input type="number" class="form-control" id="amount" name="price" required>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary" form="generateBillsForm">Generate</button>
            </div>
        </div>
    </div>
</div>
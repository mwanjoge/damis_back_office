<!-- Rejection Confirmation Modal -->
<div class="modal fade" id="rejectConfirmationModal" tabindex="-1" aria-labelledby="rejectLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header text-black">
                <h5 class="modal-title" id="rejectLabel">Reason for rejection</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="reject-form" method="POST" action="{{ route('requests.reject') }}">
                    @csrf
                    <input type="hidden" id="reject-item-id" name="request_item_id">
                    <div class="mb-3">
                        <label for="reject-comment" class="form-label">Reason</label>
                        <textarea class="form-control" id="reject-comment" name="comment" rows="4" required></textarea>
                    </div>
                    <div class="text-end">
                        <button type="submit" class="btn btn-danger">Confirm Rejection</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="generateBillsModal<?php echo e($country->id); ?>" tabindex="-1" aria-labelledby="generateBillsModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="generateBillsModalLabel">Generate Bills For <?php echo e($country->name); ?></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="generateBillsForm" action="<?php echo e(route('bills.store')); ?>" method="POST">
                    <?php echo csrf_field(); ?>
                    <input type="hidden" name="account_id" value="<?php echo e($embassy->account->id); ?>">
                    <input type="hidden" name="embassy_id" value="<?php echo e($embassy->id); ?>">
                    <input type="hidden" name="country_id" value="<?php echo e($country->id); ?>">
                    <input type="hidden" name="currency" value="<?php echo e($country->currency_code ?? $country->currency); ?>">
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
</div><?php /**PATH C:\Users\Public\projects\damis_back_office\resources\views/embassies/_generate_bills_modal.blade.php ENDPATH**/ ?>
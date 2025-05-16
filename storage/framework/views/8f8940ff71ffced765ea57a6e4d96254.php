<div>
    <div class="card py-1 mb-2">
        <div class="py-1 px-2 rounded-4">
            <h4 class="text-center mb-0">Summary</h4>
        </div>
    </div>

    <div class="row g-1">
        <div class="col-12">
            <div class="card card-animate border-warning shadow-sm rounded-4" style="min-height: 80px;">
                <div class="card-body py-2 px-4">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <p class="fw-medium text-muted mb-0 small">Pending</p>
                            <h5 class="mt-2 mb-1 ff-secondary fw-semibold">
                                <span class="counter-value" data-target="<?php echo e($summary['Pending'] ?? 0); ?>"><?php echo e($summary['Pending'] ?? 0); ?></span>
                            </h5>
                            <p class="mb-0 text-muted small">
                                <span class="badge bg-light text-warning mb-0">
                                    <i class="bx bx-time-five align-middle" style="color: #ffc107;"></i>
                                </span>
                                Total: TZS <?php echo e(number_format($totalCost['Pending'] ?? 0)); ?>

                            </p>
                        </div>
                        <div>
                            <div class="avatar-sm flex-shrink-0">
                                <span class="avatar-title bg-warning-subtle rounded-circle fs-4">
                                    <i class="bx bx-time-five" style="color: #ffc107;"></i>
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-12">
            <div class="card card-animate border-info shadow-sm rounded-4" style="min-height: 80px;">
                <div class="card-body py-2 px-4">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <p class="fw-medium text-muted mb-0 small">In Progress</p>
                            <h5 class="mt-2 mb-1 ff-secondary fw-semibold">
                                <span class="counter-value" data-target="<?php echo e($summary['In Progress'] ?? 0); ?>"><?php echo e($summary['In Progress'] ?? 0); ?></span>
                            </h5>
                            <p class="mb-0 text-muted small">
                                <span class="badge bg-light text-info mb-0">
                                    <i class="bx bx-loader align-middle" style="color: #17a2b8;"></i>
                                </span>
                                Total: TZS <?php echo e(number_format($totalCost['In Progress'] ?? 0)); ?>

                            </p>
                        </div>
                        <div>
                            <div class="avatar-sm flex-shrink-0">
                                <span class="avatar-title bg-info-subtle rounded-circle fs-4">
                                    <i class="bx bx-loader text-info" style="color: #17a2b8;"></i>
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-12">
            <div class="card card-animate border-success shadow-sm rounded-4" style="min-height: 80px;">
                <div class="card-body py-2 px-4">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <p class="fw-medium text-muted mb-0 small">Completed</p>
                            <h5 class="mt-2 mb-1 ff-secondary fw-semibold">
                                <span class="counter-value" data-target="<?php echo e($summary['Completed'] ?? 0); ?>"><?php echo e($summary['Completed'] ?? 0); ?></span>
                            </h5>
                            <p class="mb-0 text-muted small">
                                <span class="badge bg-light text-success mb-0">
                                    <i class="bx bx-check-circle align-middle" style="color: #28a745;"></i>
                                </span>
                                Total: TZS <?php echo e(number_format($totalCost['Completed'] ?? 0)); ?>

                            </p>
                        </div>
                        <div>
                            <div class="avatar-sm flex-shrink-0">
                                <span class="avatar-title bg-success-subtle rounded-circle fs-4">
                                    <i class="bx bx-check-circle text-success" style="color: #28a745;"></i>
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-12">
            <div class="card card-animate border-danger shadow-sm rounded-4" style="min-height: 80px;">
                <div class="card-body py-2 px-4">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <p class="fw-medium text-muted mb-0 small">Cancelled</p>
                            <h5 class="mt-2 mb-1 ff-secondary fw-semibold">
                                <span class="counter-value" data-target="<?php echo e($summary['Cancelled'] ?? 0); ?>"><?php echo e($summary['Cancelled'] ?? 0); ?></span>
                            </h5>
                            <p class="mb-0 text-muted small">
                                <span class="badge bg-light text-danger mb-0">
                                    <i class="bx bx-x-circle align-middle" style="color: #dc3545;"></i>
                                </span>
                                Total: TZS <?php echo e(number_format($totalCost['Cancelled'] ?? 0)); ?>

                            </p>
                        </div>
                        <div>
                            <div class="avatar-sm flex-shrink-0">
                                <span class="avatar-title bg-danger-subtle rounded-circle fs-4">
                                    <i class="bx bx-x-circle text-danger" style="color: #dc3545;"></i>
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php /**PATH /Users/administrator/Herd/damis_back_office/resources/views/livewire/request-summary-bar.blade.php ENDPATH**/ ?>
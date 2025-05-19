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
                                    <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-clock" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                        <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                        <path d="M3 12a9 9 0 1 0 18 0a9 9 0 0 0 -18 0"></path>
                                        <path d="M12 7v5l3 3"></path>
                                    </svg>
                                </span>
                                Total: TZS <?php echo e(number_format($totalCost['Pending'] ?? 0)); ?>

                            </p>
                        </div>
                        <div>
                            <div class="avatar-sm flex-shrink-0">
                                <span class="avatar-title bg-warning-subtle rounded-circle fs-4">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-hourglass" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round" style="color: #ffc107;">
                                        <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                        <path d="M6.5 7h11"></path>
                                        <path d="M6.5 17h11"></path>
                                        <path d="M6 20v-2a6 6 0 1 1 12 0v2a1 1 0 0 1 -1 1h-10a1 1 0 0 1 -1 -1z"></path>
                                        <path d="M6 4v2a6 6 0 1 0 12 0v-2a1 1 0 0 0 -1 -1h-10a1 1 0 0 0 -1 1z"></path>
                                    </svg>
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
                                    <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-loader" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                        <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                        <path d="M12 6l0 -3"></path>
                                        <path d="M16.25 7.75l2.15 -2.15"></path>
                                        <path d="M18 12l3 0"></path>
                                        <path d="M16.25 16.25l2.15 2.15"></path>
                                        <path d="M12 18l0 3"></path>
                                        <path d="M7.75 16.25l-2.15 2.15"></path>
                                        <path d="M6 12l-3 0"></path>
                                        <path d="M7.75 7.75l-2.15 -2.15"></path>
                                    </svg>
                                </span>
                                Total: TZS <?php echo e(number_format($totalCost['In Progress'] ?? 0)); ?>

                            </p>
                        </div>
                        <div>
                            <div class="avatar-sm flex-shrink-0">
                                <span class="avatar-title bg-info-subtle rounded-circle fs-4">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-refresh" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round" style="color: #17a2b8;">
                                        <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                        <path d="M20 11a8.1 8.1 0 0 0 -15.5 -2m-.5 -4v4h4"></path>
                                        <path d="M4 13a8.1 8.1 0 0 0 15.5 2m.5 4v-4h-4"></path>
                                    </svg>
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
                                    <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-circle-check" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                        <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                        <path d="M12 12m-9 0a9 9 0 1 0 18 0a9 9 0 1 0 -18 0"></path>
                                        <path d="M9 12l2 2l4 -4"></path>
                                    </svg>
                                </span>
                                Total: TZS <?php echo e(number_format($totalCost['Completed'] ?? 0)); ?>

                            </p>
                        </div>
                        <div>
                            <div class="avatar-sm flex-shrink-0">
                                <span class="avatar-title bg-success-subtle rounded-circle fs-4">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-check" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round" style="color: #28a745;">
                                        <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                        <path d="M5 12l5 5l10 -10"></path>
                                    </svg>
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
                                    <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-circle-x" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                        <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                        <path d="M12 12m-9 0a9 9 0 1 0 18 0a9 9 0 1 0 -18 0"></path>
                                        <path d="M10 10l4 4m0 -4l-4 4"></path>
                                    </svg>
                                </span>
                                Total: TZS <?php echo e(number_format($totalCost['Cancelled'] ?? 0)); ?>

                            </p>
                        </div>
                        <div>
                            <div class="avatar-sm flex-shrink-0">
                                <span class="avatar-title bg-danger-subtle rounded-circle fs-4">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-x" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round" style="color: #dc3545;">
                                        <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                        <path d="M18 6l-12 12"></path>
                                        <path d="M6 6l12 12"></path>
                                    </svg>
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php /**PATH C:\Users\Public\projects\damis_back_office\resources\views/livewire/request-summary-bar.blade.php ENDPATH**/ ?>
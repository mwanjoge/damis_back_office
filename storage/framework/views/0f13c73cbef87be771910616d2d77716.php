<?php echo $__env->make('requests.request_review_modal', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
<?php $__env->startSection('title', 'Show Request'); ?>
<?php $__env->startSection('content'); ?>

    <div class="row g-4 mt-3">
        <!-- Left column: Request Details -->
        <div class="col-lg-5">
            <div class="card h-100">
                <div class="card-header">
                    <h4>Request Details</h4>
                </div>
                <div class="card-body">
                    <h5>Tracking Number: <?php echo e($request->tracking_number); ?></h5>
                    <table class="table table-bordered">
                        <tbody>
                            <tr>
                                <th>Account</th>
                                <td><?php echo e(optional($request->account)->name ?? $request->account_id); ?></td>
                            </tr>
                            <tr>
                                <th>Embassy</th>
                                <td><?php echo e(optional($request->embassy)->name ?? $request->embassy_id); ?></td>
                            </tr>
                            <tr>
                                <th>Member</th>
                                <td><?php echo e(optional($request->member)->name ?? $request->member_id); ?></td>
                            </tr>
                            <tr>
                                <th>Country</th>
                                <td><?php echo e(optional($request->country)->name ?? $request->country_id); ?></td>
                            </tr>
                            <tr>
                                <th>Type</th>
                                <td><?php echo e($request->type); ?></td>
                            </tr>
                            <tr>
                                <th>Total Cost</th>
                                <td><?php echo e($request->total_cost); ?></td>
                            </tr>
                            <tr>
                                <th>Is Approved (Admin)</th>
                                <td><?php echo e($request->is_approved ? 'Yes' : 'No'); ?></td>
                            </tr>
                            <tr>
                                <th>Is Paid (User)</th>
                                <td><?php echo e($request->is_paid ? 'Yes' : 'No'); ?></td>
                            </tr>
                        </tbody>
                    </table>
                    <a href="<?php echo e(route('requests.index')); ?>" class="btn btn-secondary btn-sm">Back</a>
                    <?php if(session()->has('success')): ?>
                        <div class="alert alert-success mt-2"><?php echo e(session('success')); ?></div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
        <!-- Right column: Invoice, Payment, Items -->
        <div class="col-lg-7 d-flex flex-column gap-4">
            <div class="card">
                <div class="card-header">
                    <h6 class="mb-0">Invoice Details</h6>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-8">
                            <strong>Invoice No:</strong> <?php echo e($request->invoice?->ref_no ?? '-'); ?><br>
                            <strong>Date:</strong> <?php echo e($request->invoice?->invoice_date?->format('d M, Y') ?? '-'); ?><br>
                            <strong>Payment Status:</strong> <span
                                class="badge bg-<?php echo e($request->invoice?->status == 'paid' ? 'success' : 'warning'); ?>-subtle text-<?php echo e($request->invoice?->status == 'paid' ? 'success' : 'warning'); ?> fs-11"><?php echo e(ucfirst($request->invoice?->status ?? 'Pending')); ?></span><br>
                            <strong>Total Amount:</strong> <?php echo e(number_format($request->total_cost, 2)); ?>

                            <?php echo e($request->invoice?->currency ?? 'USD'); ?>

                        </div>
                        <div class="col-4 text-start">
                            <?php if($request->embassy): ?>
                                <div class="text-muted small">
                                    <div><?php echo e($request->embassy->name); ?></div>
                                    <div><?php echo e($request->embassy->country ?? ''); ?></div>

                                </div>
                            <?php endif; ?>
                            <div class="mt-2 text-start">
                                <strong class="fw-bold">Applicant:</strong> <?php echo e($request->member->name ?? '-'); ?><br>
                                <strong class="fw-bold">Email:</strong> <?php echo e($request->member->email ?? '-'); ?><br>
                                <strong class="fw-bold">Phone:</strong> <?php echo e($request->member->phone ?? '-'); ?>

                                                                    
                            </div>
                        </div>
                    </div>
                    <div class="table-responsive mt-4">
                        <table class="table table-borderless text-center table-nowrap align-middle mb-0">
                            <thead class="table-active">
                                <tr>
                                    <th>#</th>
                                    <th>Service</th>
                                    <th>Certificate Holder</th>
                                    <th>Price</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $__empty_1 = true; $__currentLoopData = $request->requestItems; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                    <tr>
                                        <td><?php echo e($index + 1); ?></td>
                                        <td class="text-start"><strong><?php echo e($item->service->name ?? '-'); ?></strong></td>
                                        <td><?php echo e($item->certificate_holder_name); ?></td>
                                        <td><?php echo e(number_format($item->price, 2)); ?></td>
                                    </tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                                    <tr>
                                        <td colspan="4" class="text-muted text-center">No items found.</td>
                                    </tr>
                                <?php endif; ?>
                            </tbody>
                        </table>
                    </div>
                    <div class="border-top border-top-dashed mt-3 pt-2">
                        <table class="table table-borderless table-nowrap align-middle mb-0 ms-auto" style="width:250px">
                            <tbody>
                                <tr>
                                    <td>Total</td>
                                    <td class="text-end"><?php echo e(number_format($request->total_cost, 2)); ?>

                                        <?php echo e($request->invoice?->currency ?? 'USD'); ?></td>
                                </tr>
                                <tr>
                                    <td>Paid</td>
                                    <td class="text-end"><?php echo e(number_format($request->invoice?->paid_amount ?? 0, 2)); ?></td>
                                </tr>
                                <tr>
                                    <td>Balance</td>
                                    <td class="text-end"><?php echo e(number_format($request->invoice?->balance ?? 0, 2)); ?></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="mt-4">
                        <h6 class="text-muted text-uppercase fw-semibold mb-3">Payment Details:</h6>
                        <p class="text-muted mb-1">Payment Method: <span
                                class="fw-medium"><?php echo e($request->invoice?->payment_method ?? '-'); ?></span></p>
                    </div>
                </div>
            </div>
            <div class="card">
                <div class="card-header">
                    <h6 class="mb-0">Request Payment</h6>
                </div>
                <div class="card-body">
                    <div>
                        <strong>Payment Reference:</strong> <?php echo e($request->payment_reference ?? '-'); ?><br>
                        <strong>Payment Date:</strong> <?php echo e($request->payment_date ?? '-'); ?><br>
                        <strong>Paid Amount:</strong> <?php echo e($request->paid_amount ?? '-'); ?><br>
                        <strong>Payment Status:</strong>
                        <?php echo e($request->payment_status ?? ($request->is_paid ? 'Paid' : 'Not Paid')); ?>

                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <h6 class="mb-0">Request Items</h6>
                </div>
                <div class="card-body">
                    <table class="table table-sm table-bordered mb-0">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Service</th>
                                <th>Service Provider</th>
                                <th>Price</th>
                                <th>Certificate Holder</th>
                                <th>Index Number</th>
                                <th>Status</th>
                                <th>Attachment</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $__currentLoopData = $request->requestItems ?? []; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $i => $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <?php
                                    $status = strtolower($item->request->status);
                                ?>

                                <tr>
                                    <td><?php echo e($i + 1); ?></td>
                                    <td><?php echo e(optional($item->service)->name ?? $item->service_id); ?></td>
                                    <td><?php echo e(optional($item->service->serviceProvider)->name ?? $item->service_provider_id); ?>

                                    </td>
                                    <td><?php echo e($item->price ?? $item->service->amount); ?></td>
                                    <td><?php echo e($item->certificate_holder_name); ?></td>
                                    <td><?php echo e($item->certificate_index_number); ?></td>

                                    <td>
                                        <?php if($status == 'pending'): ?>
                                            <span class="badge bg-warning-subtle text-warning fs-11">Pending</span>
                                        <?php elseif($status == 'approved'): ?>
                                            <span class="badge bg-success-subtle text-success fs-11">Approved</span>
                                        <?php elseif($status == 'rejected'): ?>
                                            <span class="badge bg-danger-subtle text-danger fs-11">Rejected</span>
                                        <?php else: ?>
                                            <span class="badge bg-secondary-subtle text-secondary fs-11">Unknown</span>
                                        <?php endif; ?>
                                    </td>
                                    <td>
                                        <?php if($item->attachment): ?>
                                            <button type="button" class="btn btn-sm btn-outline-primary rounded-pill px-3"
                                                onclick="previewDocument('<?php echo e(asset('storage/' . $item->attachment)); ?>', '<?php echo e($item->certificate_holder_name); ?>', '<?php echo e($item->certificate_index_number); ?>', '<?php echo e($item->id); ?>', '<?php echo e($item->service->name); ?>', '<?php echo e($item->service->serviceProvider->name); ?>')">
                                                <i class="bi bi-eye"></i> View
                                            </button>
                                        <?php else: ?>
                                            <span class="text-muted">-</span>
                                        <?php endif; ?>
                                    </td>
                                </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            <?php if(empty($request->requestItems) || count($request->requestItems) == 0): ?>
                                <tr>
                                    <td colspan="7" class="text-center text-muted">No items found.</td>
                                </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.master', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\PROJECTS\damis_back_office\resources\views/Requests/show.blade.php ENDPATH**/ ?>
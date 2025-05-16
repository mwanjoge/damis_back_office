<div class="container">
    <!-- Status Tabs -->
    <ul class="nav nav-pills mb-4" role="tablist">
        <!--[if BLOCK]><![endif]--><?php $__currentLoopData = ['Pending', 'In Progress', 'Completed', 'Cancelled']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $tabStatus): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <li class="nav-item" role="presentation">
                <button class="nav-link <?php echo e($status === $tabStatus ? 'active' : ''); ?>" wire:click="setStatus('<?php echo e($tabStatus); ?>')" type="button" role="tab">
                    <?php echo e($tabStatus); ?>

                </button>
            </li>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><!--[if ENDBLOCK]><![endif]-->
    </ul>
    <div class="card">
        <div class="card-body">
                 <div class="table-responsive table-card">
            <table id="scroll-horizontal" class="table dt-responsive nowrap mb-0" style="width: 100%;">
                <thead class="text-muted table-light">
                        <tr>
                            <th>#</th>
                            <th style="width: 200px;">Mission</th>
                            <th style="width: 150px;">Country</th>
                            <th class="text-end">Price</th>
                            <th class="text-start">Currency</th>
                            <th>Status</th>
                            <th>Approved</th>
                            <th>Paid</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                    <!--[if BLOCK]><![endif]--><?php $__empty_1 = true; $__currentLoopData = $requests; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $request): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                        <tr>
                            <td><?php echo e($loop->iteration); ?></td>
                            <td style="max-width: 200px; overflow: hidden; text-overflow: ellipsis; white-space: nowrap;" title="<?php echo e($request->embassy->name); ?>"><?php echo e($request->embassy->name); ?></td>
                            <td style="max-width: 150px; overflow: hidden; text-overflow: ellipsis; white-space: nowrap;" title="<?php echo e($request->country->name); ?>"><?php echo e($request->country->name); ?></td>
                            <td class="text-end"><?php echo e(number_format($request->total_cost, 2)); ?></td>
                            <td class="text-start"><?php echo e($request->country->currency_code); ?></td>
                            <td>
                                <span class="badge
                                    <?php if($request->status === 'Completed'): ?> bg-success
                                    <?php elseif($request->status === 'Pending'): ?> bg-warning text-dark
                                    <?php elseif($request->status === 'Cancelled'): ?> bg-danger
                                    <?php else: ?> bg-info
                                    <?php endif; ?>">
                                    <?php echo e($request->status); ?>

                                </span>
                            </td>
                            <td>
                                <!--[if BLOCK]><![endif]--><?php if($request->is_approved): ?>
                                    <span class="badge bg-success">Yes</span>
                                <?php else: ?>
                                    <span class="badge bg-warning text-dark">No</span>
                                <?php endif; ?><!--[if ENDBLOCK]><![endif]-->
                            </td>
                            <td>
                                <!--[if BLOCK]><![endif]--><?php if($request->is_paid): ?>
                                    <span class="badge bg-success">Yes</span>
                                <?php else: ?>
                                    <span class="badge bg-danger">No</span>
                                <?php endif; ?><!--[if ENDBLOCK]><![endif]-->
                            </td>
                            <td>
                                <a href="<?php echo e(route('requests.show', $request->id)); ?>" class="btn btn-primary btn-sm">View</a>
                            </td>
                        </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                        <tr>
                            <td colspan="9" class="text-center text-muted">No requests found.</td>
                        </tr>
                    <?php endif; ?><!--[if ENDBLOCK]><![endif]-->
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<?php /**PATH /Users/administrator/Herd/damis_back_office/resources/views/livewire/request-table.blade.php ENDPATH**/ ?>
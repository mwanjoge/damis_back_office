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

    <!-- Search Box -->
    <div class="row mb-4">
        <div class="col-md-6">
            <div class="input-group">
                <span class="input-group-text">
                    <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M10 10m-7 0a7 7 0 1 0 14 0a7 7 0 1 0 -14 0" /><path d="M21 21l-6 -6" /></svg>
                </span>
                <input type="text" class="form-control" placeholder="Search by embassy, country, tracking number, or type..." wire:model.debounce.300ms="search">
                <!--[if BLOCK]><![endif]--><?php if(!empty($search)): ?>
                    <button class="btn btn-outline-secondary" type="button" wire:click="$set('search', '')">
                        <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M18 6l-12 12" /><path d="M6 6l12 12" /></svg>
                    </button>
                <?php endif; ?><!--[if ENDBLOCK]><![endif]-->
            </div>
        </div>
    </div>

    <div class="card">
        <div class="card-body">
                 <div class="table-responsive table-card">
            <table id="scroll-horizontal" class="table list nowrap mb-0" style="width: 100%;">
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
                            <td class="embassy" style="max-width: 200px; overflow: hidden; text-overflow: ellipsis; white-space: nowrap;" title="<?php echo e($request->embassy->name); ?>"><?php echo e($request->embassy->name); ?></td>
                            <td class="country" style="max-width: 150px; overflow: hidden; text-overflow: ellipsis; white-space: nowrap;" title="<?php echo e($request->country->name); ?>"><?php echo e($request->country->name); ?></td>
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
                                <a href="<?php echo e(route('requests.show', $request->id)); ?>" class="btn btn-primary btn-sm">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-eye" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                        <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                        <path d="M10 12a2 2 0 1 0 4 0a2 2 0 0 0 -4 0"></path>
                                        <path d="M21 12c-2.4 4 -5.4 6 -9 6c-3.6 0 -6.6 -2 -9 -6c2.4 -4 5.4 -6 9 -6c3.6 0 6.6 2 9 6"></path>
                                    </svg>
                                    View
                                </a>
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
<?php /**PATH C:\Users\Public\projects\damis_back_office\resources\views/livewire/request-table.blade.php ENDPATH**/ ?>
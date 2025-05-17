<?php $__env->startSection('content'); ?>
<?php echo $__env->make("modal.alert", array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>

    <div class="profile-foreground position-relative mx-n4 mt-n4">
        <div class="profile-wid-bg">
            <img src="<?php echo e(URL::asset('build/images/profile-bg.jpg')); ?>" alt="" class="profile-wid-img" />
        </div>
    </div>

    <div class="pt-4 mb-4 pb-lg-4 profile-wrapper">
        <div class="row g-4">
            <div class="col-auto">
                <div
                    class="avatar-lg bg-primary text-white d-flex align-items-center justify-content-center rounded-circle fs-4 fw-bold">
                    <?php echo e(strtoupper(substr($embassy->name, 0, 1))); ?>

                </div>
            </div>
            <div class="col">
                <div class="p-2">
                    <h3 class="text-white mb-1"><?php echo e($embassy->name); ?></h3>
                    <p class="text-white text-opacity-75"><?php echo e(ucfirst($embassy->type)); ?></p>
                    <div class="hstack text-white-50 gap-2">
                        <div><i class="ri-map-pin-user-line me-1"></i><?php echo e($embassy->address ?? 'N/A'); ?></div>
                        <div><i class="ri-phone-line me-1"></i><?php echo e($embassy->phone ?? 'N/A'); ?></div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Profile Details -->
    <div class="row">
        <!-- Left Column: Embassy Details & Accredited Countries -->
        <div class="col-xl-5 d-flex flex-column gap-3">
            <div class="card">
                <div class="card-body">
                <h5 class="card-title mb-3">Embassy Details</h5>
                    <table class="table table-borderless mb-0">
                        <tbody>
                            <tr>
                                <th>Name:</th>
                                <td><?php echo e($embassy->name); ?></td>
                            </tr>
                            <tr>
                                <th>Type:</th>
                                <td><?php echo e(ucfirst($embassy->type)); ?></td>
                            </tr>
                            <tr>
                                <th>Status:</th>
                                <td>
                                    <span class="badge bg-<?php echo e($embassy->is_active ? 'success' : 'secondary'); ?>">
                                        <?php echo e($embassy->is_active ? 'Active' : 'Inactive'); ?>

                                    </span>
                                </td>
                            </tr>
                            <tr>
                                <th>Email:</th>
                                <td><?php echo e($embassy->email ?? 'N/A'); ?></td>
                            </tr>
                            <tr>
                                <th>Address:</th>
                                <td><?php echo e($embassy->address ?? 'N/A'); ?></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="card">
                <div class="card-body">  <h5 class="card-title mb-3">Accredited Countries</h5>
                    <?php if($embassy->countries->isEmpty()): ?>
                        <p class="text-muted">No accredited countries listed.</p>
                    <?php else: ?>
                        <ul class="list-group list-group-flush">
                            <?php $__currentLoopData = $embassy->countries; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $country): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <li class="list-group-item">
                                    <?php echo $__env->make('embassies._generate_bills_modal', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
                                    <?php echo e($country->name); ?>

                                    <span class="float-end">
                                        <a class="btn btn-danger btn-sm"><i class="bx bxs-trash" wire:click="removeCountry(<?php echo e($country->id); ?>)"></i></a>
                                        <a class="btn btn-success btn-sm" href="javascript:void(0)" title="Generate Bills" data-bs-toggle="modal" data-bs-target="#generateBillsModal<?php echo e($country->id); ?>">
                                            <i class="bx bx-money"></i>
                                        </a>
                                    </span>
                                </li>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </ul>
                    <?php endif; ?>
                </div>
            </div>
        </div>
        <!-- Right Column: Services Fees -->
        <div class="col-xl-7">
            <div class="card h-95">
                <div class="card-body">
                    <h5 class="card-title mb-3">Services Fees</h5>
                    <?php if($embassy->billableItems == null): ?>
                        <p class="text-muted">No service fees</p>
                    <?php else: ?>
                        <table class="table table-bordered table-striped table-sm">
                            <thead>
                                <tr>
                                    <th>Service</th>
                                    <th>Service Provider</th>
                                    <th>Price</th>
                                    <th>Currency</th>
                                    <th>Country</th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php $__currentLoopData = $embassy->billableItems; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $bill): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr>
                                    <td><?php echo e($bill->billable->name); ?></td>
                                    <td><?php echo e($bill->billable->serviceProvider->name); ?></td>
                                    <td class="text-end"><?php echo e($bill->price); ?></td>
                                    <td><?php echo e($bill->currency); ?></td>
                                    <td><?php echo e($bill->country->name); ?></td>
                                </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </tbody>
                        </table>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.master', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\Public\projects\damis_back_office\resources\views/embassy_profile.blade.php ENDPATH**/ ?>
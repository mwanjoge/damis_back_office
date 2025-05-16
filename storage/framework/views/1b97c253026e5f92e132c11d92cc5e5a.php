<?php echo $__env->make('modal.alert', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
<?php $__env->startSection('title'); ?>
    Role Permissions - <?php echo e(ucfirst($role->name ?? 'Unknown')); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <div class="container my-5">
        <a href="<?php echo e(route('roles.index')); ?>" class="btn btn-secondary mb-4">← Back to Roles</a>

        <h4 class="mb-3 text-primary">
            Manage Permissions for <strong><?php echo e(ucfirst($role->name ?? 'Unknown')); ?></strong>
        </h4>

        <form action="<?php echo e(route('roles.update-permissions', $role->id)); ?>" method="POST"
            class="p-4 border rounded bg-white shadow-sm">
            <?php echo csrf_field(); ?>
            <?php echo method_field('PUT'); ?>

            <div class="mb-3 float-end">
                <input type="checkbox" id="select-all"> <label for="select-all">Select All Permissions</label>
            </div>

             <div class="row mx-1">
                <?php $__currentLoopData = $groupedPermissions ?? []; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $group => $permissions): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <div class="col-md-4 mb-4 p-3">
                        <h5 class="text-secondary"><?php echo e($group ?? 'General'); ?> Permissions</h5>
                        <div class=" column-cols-1 column-cols-md-3 column-cols-lg-4 column-cols-xl-5 mx-1">
                            <?php $__currentLoopData = $permissions ?? []; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $permission): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <div class="col mb-2">
                                    <div class="form-check rounded p-2">
                                        <input class="form-check-input permission-checkbox" type="checkbox" name="permissions[]"
                                            value="<?php echo e($permission->name); ?>"
                                            id="perm-<?php echo e($role->name ?? '0'); ?>-<?php echo e($permission->id); ?>"
                                            <?php echo e($role->permissions->contains('name', $permission->name) ? 'checked' : ''); ?>>
                                        <label class="form-check-label text-capitalize"
                                            for="perm-<?php echo e($role->id ?? '0'); ?>-<?php echo e($permission->id); ?>">
                                            <?php echo e(str_replace('_', ' ', $permission->name ?? 'Unknown')); ?>

                                        </label>
                                    </div>
                                </div>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </div>
                    </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
            <div class="text-end">
                <button type="submit" class="btn btn-primary">Save Permissions</button>
            </div>
        </form>
    </div>

    <script>
        document.getElementById('select-all').addEventListener('change', function() {
            let checkboxes = document.querySelectorAll('.permission-checkbox');
            checkboxes.forEach(cb => cb.checked = this.checked);
        });
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.tabler.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /Users/administrator/Herd/damis_back_office/resources/views/authentication/roles/show.blade.php ENDPATH**/ ?>
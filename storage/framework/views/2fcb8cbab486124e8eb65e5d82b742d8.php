
<?php $__env->startSection('title', 'Show Employee'); ?>
<?php $__env->startSection('content'); ?>
<div class="row mt-4">
    <div class="col-lg-8 mx-auto">
        <div class="card">
            <div class="card-header">
                <h4>Employee Details</h4>
            </div>
            <div class="card-body">
                <table class="table table-bordered">
                    <tbody>
                        <tr><th>Full Name</th><td><?php echo e($employee->first_name); ?> <?php echo e($employee->middle_name ? $employee->middle_name . ' ' : ''); ?><?php echo e($employee->last_name); ?></td></tr>
                        <tr><th>Account</th><td><?php echo e(optional($employee->account)->name ?? $employee->account_id); ?></td></tr>
                        <tr><th>Department</th><td><?php echo e(optional($employee->department)->name ?? $employee->depertment_id); ?></td></tr>
                        <tr><th>Designation</th><td><?php echo e(optional($employee->designation)->name ?? $employee->designation_id); ?></td></tr>
                        <tr><th>Email</th><td><?php echo e($employee->email); ?></td></tr>
                        <tr><th>Status</th><td><span class="badge <?php echo e($employee->is_active ? 'bg-success' : 'bg-danger'); ?>"><?php echo e($employee->is_active ? 'Active' : 'Inactive'); ?></span></td></tr>
                        <tr><th>Created At</th><td><?php echo e($employee->created_at); ?></td></tr>
                        <tr><th>Updated At</th><td><?php echo e($employee->updated_at); ?></td></tr>
                    </tbody>
                </table>
                </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.master', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\Public\projects\damis_back_office\resources\views/employee/show.blade.php ENDPATH**/ ?>
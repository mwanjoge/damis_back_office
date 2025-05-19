<div class="table-responsive">
    <table class="table table-striped align-middle">
        <thead>
            <tr>
                <th>Embassy</th>
                <th>Account Name</th>
                <th>Created</th>
            </tr>
        </thead>
        <tbody>
            <?php $__currentLoopData = $embassies; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $embassy): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <tr>
                    <td><?php echo e($embassy->name); ?></td>
                    <td><?php echo e($embassy->account->name ?? 'N/A'); ?></td>
                    <td><?php echo e(optional($embassy->account)->created_at?->format('Y-m-d')); ?></td>
                </tr>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </tbody>
    </table>
</div>
<?php /**PATH C:\Users\Public\projects\damis_back_office\resources\views/embassies/account-list.blade.php ENDPATH**/ ?>
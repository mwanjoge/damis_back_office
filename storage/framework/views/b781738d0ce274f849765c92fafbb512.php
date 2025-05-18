<div>
    <div class="table-responsive" wire:ignore>
        <table class="table table-striped align-middle datatable">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Account Name</th>
                </tr>
            </thead>
            <tbody>
                <!--[if BLOCK]><![endif]--><?php $__currentLoopData = $embassies; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $embassy): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <tr>
                        <td><?php echo e($loop->iteration); ?></td>
                        <td><?php echo e($embassy->account->name ?? 'N/A'); ?></td>
                    </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><!--[if ENDBLOCK]><![endif]-->
            </tbody>
        </table>
    </div>
</div>
<?php /**PATH C:\Users\Public\projects\damis_back_office\resources\views/livewire/accounts-table.blade.php ENDPATH**/ ?>
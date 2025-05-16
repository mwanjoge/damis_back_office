<nav aria-label="breadcrumb">
    <ol class="breadcrumb bg-light p-2 rounded shadow-sm mb-3">
        <?php $__currentLoopData = $breadcrumbs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $breadcrumb): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <?php if(!$loop->last): ?>
                <li class="breadcrumb-item">
                    <a href="<?php echo e($breadcrumb['url']); ?>" class="text-primary"><?php echo e($breadcrumb['name']); ?></a>
                </li>
            <?php else: ?>
                <li class="breadcrumb-item active text-dark fw-semibold" aria-current="page">
                    <?php echo e($breadcrumb['name']); ?>

                </li>
            <?php endif; ?>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </ol>
</nav>
<?php /**PATH D:\PROJECTS\damis_back_office\resources\views/layouts/breadcrumb.blade.php ENDPATH**/ ?>
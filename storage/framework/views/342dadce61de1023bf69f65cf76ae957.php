<?php $__env->startSection('title', 'Requests'); ?>
<?php $__env->startSection('content'); ?>
    <?php
    $breadcrumbs = [
        ['name' => 'Home', 'url' => route('home')],
        ['name' => 'Requests', 'url' => route('requests.index')]
    ];
    ?>

    

    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="mb-0">Requests</h2>
        <a href="<?php echo e(route('requests.create')); ?>" class="btn btn-primary">Create Request</a>
    </div>
    <div class="row g-4">
        <div class="col-md-3">
            <?php
$__split = function ($name, $params = []) {
    return [$name, $params];
};
[$__name, $__params] = $__split('request-summary-bar', ['summary' => $summary]);

$__html = app('livewire')->mount($__name, $__params, 'lw-2237666562-0', $__slots ?? [], get_defined_vars());

echo $__html;

unset($__html);
unset($__name);
unset($__params);
unset($__split);
if (isset($__slots)) unset($__slots);
?>
        </div>
        <div class="col-md-9">
            <div class="card h-100 mb-5">
                <div class="card-body">
                    <?php
$__split = function ($name, $params = []) {
    return [$name, $params];
};
[$__name, $__params] = $__split('request-table', ['requests' => $requests]);

$__html = app('livewire')->mount($__name, $__params, 'lw-2237666562-1', $__slots ?? [], get_defined_vars());

echo $__html;

unset($__html);
unset($__name);
unset($__params);
unset($__split);
if (isset($__slots)) unset($__slots);
?>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.tabler.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\PROJECTS\damis_back_office\resources\views/requests/index.blade.php ENDPATH**/ ?>
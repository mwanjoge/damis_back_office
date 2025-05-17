<?php $__env->startSection('content'); ?>
    <?php
        $breadcrumbs = [
            ['name' => 'Home', 'url' => route('home')],
            ['name' => 'Settings', 'url' => route('settings')]
        ];
    ?>

    <?php echo $__env->make('layouts.breadcrumb', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>

    <div class="row mt-4 mb-5">
    <div class="col-12 col-xl-12 col-xxl-10">
        <h4 class="p-1 font-italic">Settings</h4>
        <div class="card shadow-sm">
            <div class="card-header bg-white border-bottom-0">
                <ul class="nav nav-tabs-custom rounded card-header-tabs border-bottom-0" role="tablist">
                <li class="nav-item">
                        <a class="nav-link" data-bs-toggle="tab" href="#tab-accounts" role="tab">
                            <i class="fas fa-user-shield"></i> Accounts
                        </a>
                    </li>
                <li class="nav-item">
                        <a class="nav-link active" data-bs-toggle="tab" href="#tab-embassy" role="tab">
                            <i class="far fa-user"></i> Mission
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-bs-toggle="tab" href="#tab-countries" role="tab">
                            <i class="fas fa-home"></i> Countries
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-bs-toggle="tab" href="#tab-service-provider" role="tab">
                            <i class="far fa-user"></i> Service Providers
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-bs-toggle="tab" href="#tab-services" role="tab">
                            <i class="far fa-user"></i> Services
                        </a>
                    </li>

                </ul>
            </div>

            <div class="card-body px-4 bg-white">
                <div class="tab-content">
                    <!-- Accounts -->
                    <div class="tab-pane fade" id="tab-accounts" role="tabpanel" wire:ignore.self>

                        <?php
$__split = function ($name, $params = []) {
    return [$name, $params];
};
[$__name, $__params] = $__split('accounts-table');

$__html = app('livewire')->mount($__name, $__params, 'lw-2393909593-0', $__slots ?? [], get_defined_vars());

echo $__html;

unset($__html);
unset($__name);
unset($__params);
unset($__split);
if (isset($__slots)) unset($__slots);
?>
                    </div>

                    <!-- Mission -->
                    <div class="tab-pane fade show active" id="tab-embassy" role="tabpanel" wire:ignore.self>

                        <?php
$__split = function ($name, $params = []) {
    return [$name, $params];
};
[$__name, $__params] = $__split('embassies-table');

$__html = app('livewire')->mount($__name, $__params, 'lw-2393909593-1', $__slots ?? [], get_defined_vars());

echo $__html;

unset($__html);
unset($__name);
unset($__params);
unset($__split);
if (isset($__slots)) unset($__slots);
?>
                    </div>

                    <!-- Countries -->
                    <div class="tab-pane fade" id="tab-countries" role="tabpanel" wire:ignore.self>

                        <?php
$__split = function ($name, $params = []) {
    return [$name, $params];
};
[$__name, $__params] = $__split('countries-table');

$__html = app('livewire')->mount($__name, $__params, 'lw-2393909593-2', $__slots ?? [], get_defined_vars());

echo $__html;

unset($__html);
unset($__name);
unset($__params);
unset($__split);
if (isset($__slots)) unset($__slots);
?>
                    </div>

                    <!-- Service Providers -->
                    <div class="tab-pane fade" id="tab-service-provider" role="tabpanel" wire:ignore.self>

                        <?php
$__split = function ($name, $params = []) {
    return [$name, $params];
};
[$__name, $__params] = $__split('service-provider-table');

$__html = app('livewire')->mount($__name, $__params, 'lw-2393909593-3', $__slots ?? [], get_defined_vars());

echo $__html;

unset($__html);
unset($__name);
unset($__params);
unset($__split);
if (isset($__slots)) unset($__slots);
?>
                    </div>

                    <!-- Services -->
                    <div class="tab-pane fade" id="tab-services" role="tabpanel" wire:ignore.self>

                        <?php
$__split = function ($name, $params = []) {
    return [$name, $params];
};
[$__name, $__params] = $__split('services-table');

$__html = app('livewire')->mount($__name, $__params, 'lw-2393909593-4', $__slots ?? [], get_defined_vars());

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
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('script'); ?>
<script>
    $(function() {
        $('a[data-bs-toggle="tab"]').on('shown.bs.tab', function(e) {
            localStorage.setItem('lastAuthTab', $(this).attr('href'));
        });

        var lastTab = <?php echo json_encode(session('active_tab'), 15, 512) ?> || localStorage.getItem('lastAuthTab');
        if (lastTab) {
            $('a[data-bs-toggle="tab"][href="' + lastTab + '"]').tab('show');

            <?php if($errors->any()): ?>
                $(document).ready(function() {
                    $('.modal.show').each(function() {
                        const instance = bootstrap.Modal.getInstance(this);
                        if (instance) {
                            instance.hide();
                            instance.dispose();
                        }
                    });
                    $('.modal-backdrop').remove();

                    let modalClass = lastTab.replace('#tab-', '') + '-modal';
                    let modalSelector = '.' + modalClass;
                    const modalEl = document.querySelector(modalSelector);
                    if (modalEl) {
                        const modal = new bootstrap.Modal(modalEl);
                        modal.show();
                    }
                });
            <?php endif; ?>
        }
    });
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.tabler.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\Public\projects\damis_back_office\resources\views/settings.blade.php ENDPATH**/ ?>
<?php $__env->startSection('content'); ?>
    <?php
        $breadcrumbs = [
            ['name' => 'Home', 'url' => route('home')],
            ['name' => 'authentication', 'url' => route('authentication')]
        ];
    ?>

    

    <?php echo $__env->make('modal.alert', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
    <div class="row">
        <div class="col-xxl-9 pt-4">
            <h4 class="p-1 font-italic">Authentication</h4>
            <div class="card mb-xxl-n5">
                <div class="card-header">
                    <ul class="nav nav-tabs-custom rounded card-header-tabs border-bottom-0" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" data-bs-toggle="tab" href="#tab-embassy" role="tab">
                                <i class="far fa-user"></i> Users
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-bs-toggle="tab" href="#tab-countries" role="tab">
                                <i class="fas fa-home"></i> Roles
                            </a>
                        </li>
                    </ul>
                </div>

                <div class="tab-content px-0">
                        <!-- Users -->
                        <div class="tab-pane fade show active" id="tab-embassy" role="tabpanel">
                            <?php echo $__env->make('authentication.users.users_table', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
                        </div>

                        <!-- Roles -->
                        <div class="tab-pane fade" id="tab-countries" role="tabpanel">
                            <?php echo $__env->make('authentication.roles.index', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
                        </div>
                    </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('script'); ?>
    <script>
        $(function() {
            // for bootstrap 3 use 'shown.bs.tab', for bootstrap 2 use 'shown' in the next line
            $('a[data-bs-toggle="tab"]').on('shown.bs.tab', function(e) {
                // save the latest tab; use cookies if you like 'em better:
                localStorage.setItem('lastTab', $(this).attr('href'));
            });

            // go to the latest tab, if it exists:
            var lastTab = localStorage.getItem('lastTab');
            if (lastTab) {
                $('[href="' + lastTab + '"]').tab('show');
            }
        });
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.tabler.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\PROJECTS\damis_back_office\resources\views/authentication/authentication_home.blade.php ENDPATH**/ ?>
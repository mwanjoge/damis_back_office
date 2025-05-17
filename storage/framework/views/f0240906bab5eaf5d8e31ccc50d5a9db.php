<div>
    <div class="row mb-3">
        <div class="col">
            <input type="text" wire:model.debounce.500ms="search" class="form-control form-control-sm" placeholder="Search by tracking number...">
        </div>
        <div class="col">
            <select wire:model="status" class="form-control form-control-sm">
                <option value="">All Statuses</option>
                <option value="Pending">Pending</option>
                <option value="In Progress">In Progress</option>
                <option value="Completed">Completed</option>
                <option value="Cancelled">Cancelled</option>
            </select>
        </div>
        <div class="col">
            <select wire:model="embassy_id" data-choices class="form-control form-control-sm">
                <option value="">All Embassies</option>
                <!--[if BLOCK]><![endif]--><?php $__currentLoopData = $embassies; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $embassy): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <option value="<?php echo e($embassy->id); ?>"><?php echo e($embassy->name); ?></option>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><!--[if ENDBLOCK]><![endif]-->
            </select>
        </div>
        <div class="col">
            <select wire:model="country_id" data-choices class="form-control form-control-sm">
                <option value="">All Countries</option>
                <!--[if BLOCK]><![endif]--><?php $__currentLoopData = $countries; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $country): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <option value="<?php echo e($country->id); ?>"><?php echo e($country->name); ?></option>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><!--[if ENDBLOCK]><![endif]-->
            </select>
        </div>
    </div>
</div>
<?php /**PATH C:\Users\Public\projects\damis_back_office\resources\views/livewire/request-search-filter.blade.php ENDPATH**/ ?>
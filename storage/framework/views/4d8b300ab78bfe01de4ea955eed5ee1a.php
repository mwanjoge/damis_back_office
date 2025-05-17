
<div wire.ignore.self>
    <div class="row mt-3">
        <div class="col">Add provider's services</div>
        <div class="col">
            <a href="javascript:void(0)" wire:click.prevent="addInput" class="btn btn-outline-primary btn-sm mb-1 float-end">
                <i class="bx bx-plus"></i> Add Service
            </a>
        </div>  
        <div class="col-12"><hr class="mb-3 mt-0"></div>
    </div>
    <div class="row">
        <div class="col-12">
            <!--[if BLOCK]><![endif]--><?php $__currentLoopData = $inputs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div class="service-field mb-3 d-flex">
                    <input type="text" wire:model="input.(<?php echo e($key); ?>)" class="form-control me-2" placeholder="Enter service" name="service_name[]" >
                    <a wire:click="inputs." wire:click.prevent="removeInput(<?php echo e($key); ?>)" class="btn btn-danger">
                        <i class="bx bx-trash"></i>
                    </a>
                </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><!--[if ENDBLOCK]><![endif]-->
        </div>
    </div>
</div>
<?php /**PATH C:\Users\Public\projects\damis_back_office\resources\views/livewire/service-field-container.blade.php ENDPATH**/ ?>
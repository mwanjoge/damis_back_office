<div class="mt-5">
    <div class="card pt-4">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h5 class="mb-0">Requested Items</h5>
            <button type="button" wire:click="addInput" id="add-request-item" class="btn btn-secondary btn-sm">Add
                Requested Item</button>
        </div>
        <div class="card-body">
            <div id="request-items-list" name="request_items">
                <!-- <select wire:model="test" wire:change="getService">
                    <option value="test1">Test</option>
                    <option value="test2">Test 2</option>
                </select> -->
            <!--[if BLOCK]><![endif]--><?php $__currentLoopData = $inputs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $input): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div class="request-item-row row g-2 mb-2 align-items-end">
                    <div class="col">
                                <label for="choices-single-default" class="form-label text-muted">Service Provider</label>
                        <select wire:model="inputs.<?php echo e($key); ?>.service_provider_id" wire:model.live wire:change="getServices(<?php echo e($key); ?>)" class="form-control" id="choices-single-default"  name="request_items[<?php echo e($key); ?>][service_provider_id]" required>
                            <option value="">Select Provider</option>
                            <!--[if BLOCK]><![endif]--><?php $__currentLoopData = $providers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $provider): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option value="<?php echo e($provider->id); ?>"><?php echo e($provider->name); ?></option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><!--[if ENDBLOCK]><![endif]-->
                        </select>
                        <!--[if BLOCK]><![endif]--><?php $__errorArgs = ["inputs.$key.service_provider_id"];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                            <span class="text-danger"><?php echo e($message); ?></span>
                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?><!--[if ENDBLOCK]><![endif]-->
                    </div>
                    <div class="col">
                        <label class="form-label form-label-sm">Service</label>
                        <select wire:model="inputs.<?php echo e($key); ?>.service_id" class="form-select form-select-sm choices-select" name="request_items[<?php echo e($key); ?>][service_id]" required>
                            <option value="">Select Service</option>
                            <!--[if BLOCK]><![endif]--><?php $__currentLoopData = $servicesInputs[$key] ?? []; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $service): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option value="<?php echo e($service->id); ?>"><?php echo e($service->name); ?></option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><!--[if ENDBLOCK]><![endif]-->
                        </select>
                        <!--[if BLOCK]><![endif]--><?php $__errorArgs = ["inputs.$key.service_id"];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                            <span class="text-danger"><?php echo e($message); ?></span>
                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?><!--[if ENDBLOCK]><![endif]-->
                    </div>
                    <div class="col">
                        <label class="form-label form-label-sm" >Price</label>
                        <div class="input-group input-group-sm">
                            <span class="input-group-text">TZS</span>
                            <input type="number" wire:model="inputs.<?php echo e($key); ?>.price" name="request_items[<?php echo e($key); ?>][price]" class="form-control form-control-sm  choices-select" step="0.01" required>
                        </div>
                        <!--[if BLOCK]><![endif]--><?php $__errorArgs = ["inputs.$key.price"];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                            <span class="text-danger"><?php echo e($message); ?></span>
                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?><!--[if ENDBLOCK]><![endif]-->
                    </div>
                    <div class="col">
                        <label class="form-label form-label-sm">Certificate Holder</label>
                        <input type="text" wire:model="inputs.<?php echo e($key); ?>.certificate_holder_name" name="request_items[<?php echo e($key); ?>][certificate_holder_name]" class="form-control form-control-sm" required>
                        <!--[if BLOCK]><![endif]--><?php $__errorArgs = ["inputs.$key.certificate_holder_name"];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                            <span class="text-danger"><?php echo e($message); ?></span>
                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?><!--[if ENDBLOCK]><![endif]-->
                    </div>
                    <div class="col">
                        <label class="form-label form-label-sm">Index Number</label>
                        <input type="text" wire:model="inputs.<?php echo e($key); ?>.certificate_index_number" name="request_items[<?php echo e($key); ?>][certificate_index_number]" class="form-control form-control-sm">
                        <!--[if BLOCK]><![endif]--><?php $__errorArgs = ["inputs.$key.certificate_index_number"];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                            <span class="text-danger"><?php echo e($message); ?></span>
                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?><!--[if ENDBLOCK]><![endif]-->
                    </div>
                    <div class="col">
                        <label class="form-label form-label-sm">Attachment</label>
                        <div class="input-group input-group-sm">
                            <input type="file" wire:model="inputs.<?php echo e($key); ?>.attachment" name="request_items[<?php echo e($key); ?>][attachment]" class="form-control form-control-sm" placeholder="Attachment">
                        </div>
                        <!--[if BLOCK]><![endif]--><?php $__errorArgs = ["inputs.$key.attachment"];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                            <span class="text-danger"><?php echo e($message); ?></span>
                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?><!--[if ENDBLOCK]><![endif]-->
                    </div>
                    <div class="col-auto">
                        <button type="button" wire:click="removeInput(<?php echo e($key); ?>)" class="btn btn-danger btn-sm remove-item">
                            <i class="bx bx-trash"></i>
                        </button>
                    </div>
                </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><!--[if ENDBLOCK]><![endif]-->
            </div>
        </div>
    </div>
</div><?php /**PATH /Users/administrator/Herd/damis_back_office/resources/views/livewire/request-items.blade.php ENDPATH**/ ?>
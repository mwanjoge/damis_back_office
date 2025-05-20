<div class="mt-5">
    <div class="card">
        <div class="card-header">
            <div class=" d-flex justify-content-between align-items-center container-fluid">
                    <h3 class="card-title me-auto">Requested Items</h3>
                    <button type="button" wire:click="addInput" id="add-request-item"
                        class="btn btn-primary ms-auto">
                        <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24"
                            viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                            stroke-linecap="round" stroke-linejoin="round">
                            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                            <path d="M12 5l0 14" />
                            <path d="M5 12l14 0" />
                        </svg>
                        Add Item
                    </button>
            </div>
        </div>
        <div class="card-body">
            <div id="request-items-list" name="request_items">
                <!--[if BLOCK]><![endif]--><?php $__currentLoopData = $inputs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $input): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <div class="request-item-row card card-sm mb-3">
                        <div class="card-body">
                            <div class="row g-3 align-items-center">
                                <div class="col-md-2">
                                    <div class="form-label">Service Provider</div>
                                    <select wire:model.live="inputs.<?php echo e($key); ?>.service_provider_id"
                                        wire:change="getServices(<?php echo e($key); ?>)" class="form-select"
                                        name="request_items[<?php echo e($key); ?>][service_provider_id]" required>
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
                                        <div class="invalid-feedback d-block"><?php echo e($message); ?></div>
                                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?><!--[if ENDBLOCK]><![endif]-->
                                </div>
                                <div class="col-md-2">
                                    <div class="form-label">Service</div>
                                    <select wire:model.live="inputs.<?php echo e($key); ?>.service_id" class="form-select"
                                        name="request_items[<?php echo e($key); ?>][service_id]" required>
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
                                        <div class="invalid-feedback d-block"><?php echo e($message); ?></div>
                                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?><!--[if ENDBLOCK]><![endif]-->
                                </div>
                                
                                <div class="col-md-2">
                                    <div class="form-label">Certificate Holder</div>
                                    <input type="text"
                                        wire:model="inputs.<?php echo e($key); ?>.certificate_holder_name"
                                        name="request_items[<?php echo e($key); ?>][certificate_holder_name]"
                                        class="form-control" required>
                                    <!--[if BLOCK]><![endif]--><?php $__errorArgs = ["inputs.$key.certificate_holder_name"];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                        <div class="invalid-feedback d-block"><?php echo e($message); ?></div>
                                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?><!--[if ENDBLOCK]><![endif]-->
                                </div>
                                <div class="col-md-2">
                                    <div class="form-label">Index Number</div>
                                    <input type="text"
                                        wire:model="inputs.<?php echo e($key); ?>.certificate_index_number"
                                        name="request_items[<?php echo e($key); ?>][certificate_index_number]"
                                        class="form-control">
                                    <!--[if BLOCK]><![endif]--><?php $__errorArgs = ["inputs.$key.certificate_index_number"];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                        <div class="invalid-feedback d-block"><?php echo e($message); ?></div>
                                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?><!--[if ENDBLOCK]><![endif]-->
                                </div>
                                <div class="col-md-2">
                                    <div class="form-label">Attachment</div>
                                    <input type="file" wire:model="inputs.<?php echo e($key); ?>.attachment"
                                        name="request_items[<?php echo e($key); ?>][attachment]" class="form-control"
                                        placeholder="Attachment">
                                    <!--[if BLOCK]><![endif]--><?php $__errorArgs = ["inputs.$key.attachment"];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                        <div class="invalid-feedback d-block"><?php echo e($message); ?></div>
                                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?><!--[if ENDBLOCK]><![endif]-->
                                </div>
                                <div class="col-auto ms-auto">
                                    <button type="button" wire:click="removeInput(<?php echo e($key); ?>)"
                                        class="btn btn-danger btn-icon" title="Remove item">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24"
                                            height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"
                                            fill="none" stroke-linecap="round" stroke-linejoin="round">
                                            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                            <path d="M4 7l16 0" />
                                            <path d="M10 11l0 6" />
                                            <path d="M14 11l0 6" />
                                            <path d="M5 7l1 12a2 2 0 0 0 2 2h8a2 2 0 0 0 2 -2l1 -12" />
                                            <path d="M9 7v-3a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v3" />
                                        </svg>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><!--[if ENDBLOCK]><![endif]-->
            </div>
        </div>
    </div>
</div>
<?php /**PATH C:\Users\Public\projects\damis_back_office\resources\views/livewire/request-items.blade.php ENDPATH**/ ?>
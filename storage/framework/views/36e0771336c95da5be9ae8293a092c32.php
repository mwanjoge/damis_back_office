<?php $__env->startSection('title', 'Create Request'); ?>
<?php $__env->startSection('content'); ?>

    <form action="<?php echo e(route('requests.store')); ?>" method="POST" enctype="multipart/form-data">
        <?php echo csrf_field(); ?>
         <?php if($errors->any()): ?>
            <div class="alert alert-danger">
                <ul class="mb-0">
                    <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
    <li><?php echo e($error); ?></li>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </ul>
            </div>
        <?php endif; ?>
        <div class="mb-3 d-flex justify-content-between align-items-center">
            <h2 class="mb-0">Create Request</h2>
        </div>
        <div class="card mb-4">
            <div class="card-header">
                <h5 class="mb-0">Request details</h5>
            </div>
            <div class="card-body">

                <div class="row g-3">
                    <div class="col-md-6">
                        <label class="form-label">Type</label>
                        <select name="type" class="form-select <?php $__errorArgs = ['type'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" required>
                            <option value="Diaspora" <?php echo e(old('type') == 'Diaspora' ? 'selected' : ''); ?>>Diaspora</option>
                            <option value="Domestic" <?php echo e(old('type') == 'Domestic' ? 'selected' : ''); ?>>Domestic</option>
                        </select>
                        <?php $__errorArgs = ['type'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                            <span class="invalid-feedback"><?php echo e($message); ?></span>
                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                    </div>
                    

                    <div class="col-md-6">
                        <div class="d-flex justify-content-between align-items-center mb-1">
                            <label class="form-label mb-0">Applicant Name</label>
                            <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal"
                                data-bs-target="#addMemberModal">
                                <i class="bx bx-plus"></i>New Applicant
                            </button>
                        </div>
                    
                        <select id="member_id" name="member_id" data-choices
                            class="form-control data-choices <?php $__errorArgs = ['member_id'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" required>
                            <option value="">Select Applicant</option>
                            <?php $__currentLoopData = $members; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $member): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option value="<?php echo e($member->id); ?>" data-type="<?php echo e($member->type); ?>"
                                    <?php echo e(old('member_id') == $member->id ? 'selected' : ''); ?>><?php echo e($member->name); ?></option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select>
                    
                        <?php $__errorArgs = ['member_id'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                            <span class="invalid-feedback d-block"><?php echo e($message); ?></span>
                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                    </div>
                           
                    <div class="col-md-6">
                        <label class="form-label">Country</label>
                        <select id="countrySelect" name="country_id" data-choices
                            class="form-control  <?php $__errorArgs = ['country_id'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" required>
                            <option value="">Select Country</option>
                            <?php $__currentLoopData = $countries; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $country): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option value="<?php echo e($country->id); ?>"
                                    <?php echo e(old('country_id') == $country->id ? 'selected' : ''); ?>><?php echo e($country->name); ?>

                                </option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select>
                        <?php $__errorArgs = ['country_id'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                            <span class="invalid-feedback"><?php echo e($message); ?></span>
                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                    </div>

                </div>
            </div>
        </div>

        <!-- <div class="card mb-4"> -->

        <!--   <div class="card-body">
                <div id="request-items-list">
                    <div class="request-item-row row g-2 mb-2 align-items-end">
                      
                        <div class="col">
                            <label class="form-label form-label-sm">Service Provider</label>
                            <select name="request_items[0][service_provider_id]" class="form-select form-select-sm" required>
                                <option value="">Select Provider</option>
                                <?php $__currentLoopData = $serviceProviders; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $provider): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
    <option value="<?php echo e($provider->id); ?>"><?php echo e($provider->name); ?></option>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </select>
                        </div>
                        <div class="col">
                            <label class="form-label form-label-sm">Service</label>
                            <select name="request_items[0][service_id]" class="form-select form-select-sm" required>
                                <option value="">Select Service</option>
                                <?php $__currentLoopData = $services; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $service): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
    <option value="<?php echo e($service->id); ?>"><?php echo e($service->name); ?></option>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </select>
                        </div>
                        <div class="col">
                            <label class="form-label form-label-sm">Price</label>
                            <div class="input-group input-group-sm">
                                <span class="input-group-text">TZS</span>
                                <input type="number" name="request_items[0][price]" class="form-control form-control-sm" step="0.01" required>
                            </div>
                        </div>
                        <div class="col">
                            <label class="form-label form-label-sm">Certificate Holder</label>
                            <input type="text" name="request_items[0][certificate_holder_name]" class="form-control form-control-sm" required>
                        </div>
                        <div class="col">
                            <label class="form-label form-label-sm">Index Number</label>
                            <input type="text" name="request_items[0][certificate_index_number]" class="form-control form-control-sm">
                        </div>
                        <div class="col">
                            <label class="form-label form-label-sm">Attachment</label>
                            <div class="input-group input-group-sm">
                                <input type="file" name="request_items[0][attachment]" class="form-control form-control-sm" placeholder="Attachment">
        
                            </div>
                        </div>
                        <div class="col-auto">
                            <button type="button" class="btn btn-danger btn-sm remove-item">
                                <i class="bx bx-trash"></i>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div> -->

        <div name="request_items">
            <?php
$__split = function ($name, $params = []) {
    return [$name, $params];
};
[$__name, $__params] = $__split('request-items');

$__html = app('livewire')->mount($__name, $__params, 'lw-638954310-0', $__slots ?? [], get_defined_vars());

echo $__html;

unset($__html);
unset($__name);
unset($__params);
unset($__split);
if (isset($__slots)) unset($__slots);
?>
        </div>

        <div class="mb-3 d-flex justify-content-end">
            <button type="submit" class="btn btn-primary btn-sm">Submit</button>
        </div>
    </form>

    <!-- Member Modal -->
    <div>
        <?php
$__split = function ($name, $params = []) {
    return [$name, $params];
};
[$__name, $__params] = $__split('add-member-modal');

$__html = app('livewire')->mount($__name, $__params, 'lw-638954310-1', $__slots ?? [], get_defined_vars());

echo $__html;

unset($__html);
unset($__name);
unset($__params);
unset($__split);
if (isset($__slots)) unset($__slots);
?>

    </div>


    <script>
        window.addEventListener('member-added', () => {
            // Close the modal
            const modal = document.getElementById('addMemberModal');
            const bootstrapModal = bootstrap.Modal.getInstance(modal);
            bootstrapModal.hide();

            // Optionally, show a success message
            Swal.fire({
                icon: 'success',
                title: 'Success',
                text: 'Member added successfully!',
                confirmButtonColor: '#3085d6',
                confirmButtonText: 'OK'
            });
        });
    </script>
    <!-- <script>
        document.addEventListener('livewire:load', function() {
            Livewire.on('memberAdded', function(id, name) {
                let memberSelect = document.getElementById('member_id');
                // Add the new member as an option if not present
                let exists = Array.from(memberSelect.options).some(opt => opt.value == id);
                if (!exists) {
                    let option = new Option(name, id, true, true);
                    memberSelect.add(option);
                }
                // Select the new member
                memberSelect.value = id;
                // Trigger change event if needed
                memberSelect.dispatchEvent(new Event('change'));
            });
        });
    </script> -->
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.master', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /Users/administrator/Herd/damis_back_office/resources/views/requests/create.blade.php ENDPATH**/ ?>
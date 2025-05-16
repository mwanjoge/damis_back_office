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

                        <select name="type" id="typeSelect" class="form-select <?php $__errorArgs = ['type'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                            required>
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
                            <button type="button" class="btn btn-primary btn-sm px-4 py-0" data-bs-toggle="modal"
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

                    <div class="col-md-6">

                        <input type="hidden" id="priceValue" name="price">
                        <div id="priceDisplay" class="mt-3 fw-bold" style="display: none;">
                            <div class="d-flex flex-column">
                                <label class="form-label fw-bold">Price per service:</label>
                                <span id="priceValueDisplay" style="font-weight: bold;"></span>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>

        <div name="request_items">
            <?php
$__split = function ($name, $params = []) {
    return [$name, $params];
};
[$__name, $__params] = $__split('request-items');

$__html = app('livewire')->mount($__name, $__params, 'lw-4001883634-0', $__slots ?? [], get_defined_vars());

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

$__html = app('livewire')->mount($__name, $__params, 'lw-4001883634-1', $__slots ?? [], get_defined_vars());

echo $__html;

unset($__html);
unset($__name);
unset($__params);
unset($__split);
if (isset($__slots)) unset($__slots);
?>

    </div>


    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const typeSelect = document.getElementById("typeSelect");
            const countrySelect = document.getElementById("countrySelect");
            const memberSelect = document.getElementById("member_id");
            const priceDisplay = document.getElementById("priceDisplay");
            const priceValue = document.getElementById("priceValue");
            const priceValueDisplay = document.getElementById("priceValueDisplay");

            typeSelect.addEventListener("change", function() {
                if (this.value === "Domestic") {
                    countrySelect.value = "174";
                    countrySelect.setAttribute("disabled", true);
                } else {
                    countrySelect.removeAttribute("disabled");
                }
                fetchPrice();
            });

            countrySelect.addEventListener("change", fetchPrice);

            function fetchPrice() {
                const countryId = countrySelect.value;
                const memberId = memberSelect.value;
                const type = typeSelect.value;

                if (!countryId || !type) {
                    priceDisplay.style.display = 'none';
                    return;
                }

                fetch(`/billable-price?country_id=${countryId}`)
                    .then(response => {
                        if (!response.ok) throw new Error('Server error');
                        return response.json();
                    })
                    .then(data => {
                        if (data.success) {
                            priceValue.value = parseFloat(data.price.replace(/,/g, ''));
                            priceValueDisplay.textContent = `${data.price} ${data.currency}`;
                            priceDisplay.style.display = 'block';
                        } else {
                            priceValue.textContent = 'N/A';
                            priceDisplay.style.display = 'none';
                        }
                    })
                    .catch(error => {
                        console.error('Fetch error:', error);
                        priceValue.textContent = 'Error loading price';
                        priceDisplay.style.display = 'block';
                    });

            }

            // Initial call
            typeSelect.dispatchEvent(new Event("change"));
        });

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
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.master', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\PROJECTS\damis_back_office\resources\views/requests/create.blade.php ENDPATH**/ ?>
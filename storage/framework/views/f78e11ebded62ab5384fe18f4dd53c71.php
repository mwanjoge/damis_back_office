<div class="tab-pane px-4" id="embassy" role="tabpanel">
    <div class="text-end pb-4">
        <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target=".countries-modal" wire:click="openForm">
            New Country
        </button>
    </div>
    <div class="table-responsive table-card" wire:ignore>
        <table class="table table-borderless table-centered align-middle table-nowrap mb-0">
            <thead class="text-muted table-light pt-3">
                <tr>
                    <th>#</th>
                    <th>Country</th>
                    <th>Mission</th>
                    <th>Code</th>
                    <th>Phone Code</th>
                    <th>Currency</th>
                    <th>Currency code</th>
                    <th class="text-end" style="width: 180px;">Actions</th>
                </tr>
            </thead>
            <tbody>
                <!--[if BLOCK]><![endif]--><?php $__currentLoopData = $countries; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $country): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <tr>
                        <td><?php echo e($loop->iteration); ?></td>
                        <td><?php echo e($country->name); ?></td>
                        <td><?php echo e($country->embassy?->name); ?></td>
                        <td><?php echo e($country->code); ?></td>
                        <td><?php echo e($country->phone_code); ?></td>
                        <td><?php echo e($country->currency); ?></td>
                        <th><?php echo e($country->currency_code); ?></th>
                        <td class="text-end">
                            <!-- Edit Button -->
                            <button class="btn btn-warning btn-sm" data-bs-toggle="modal"
                                data-bs-target=".countries-modal" wire:click="openForm(<?php echo e($country->id); ?>)">
                                <i class="bx bx-edit-alt"></i>
                            </button>

                            <!-- Delete Button -->
                            <button type="button" class="btn btn-danger btn-sm delete-btn" data-id="<?php echo e($country->id); ?>">
                                <i class="bx bxs-trash"></i>
                            </button>
                        </td>
                    </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><!--[if ENDBLOCK]><![endif]-->
            </tbody>
        </table>
    </div>

    <!-- Country Modal -->
    <div class="modal fade countries-modal" tabindex="-1" aria-hidden="true" wire:ignore.self>
        <div class="modal-dialog modal-dialog-centered">
            <form method="post"
                action="<?php echo e($editingId ? route('country.update', $editingId) : route('country.store')); ?>"
                class="modal-content">
                <?php echo csrf_field(); ?>
                <!--[if BLOCK]><![endif]--><?php if($editingId): ?>
                    <?php echo method_field('PUT'); ?>
                <?php endif; ?><!--[if ENDBLOCK]><![endif]-->

                <div class="modal-body justify-content-center p-5">

                    <!--[if BLOCK]><![endif]--><?php if($errors->any()): ?>
                        <div class="alert alert-danger">
                            <ul class="mb-0">
                                <!--[if BLOCK]><![endif]--><?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <li><?php echo e($error); ?></li>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><!--[if ENDBLOCK]><![endif]-->
                            </ul>
                        </div>
                    <?php endif; ?><!--[if ENDBLOCK]><![endif]-->

                    <div class="mt-4 text-start">
                        <h4 class="mb-3 text-center"><?php echo e($editingId ? 'Edit Country' : 'Add New Country'); ?></h4>
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Country Name</label>
                                <input type="text" class="form-control" wire:model="name" name="name" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Country Code</label>
                                <input type="text" class="form-control" wire:model="code" name="code">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Phone Code</label>
                                <input type="text" class="form-control" wire:model="phone_code" name="phone_code">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Currency</label>
                                <input type="text" class="form-control" wire:model="currency" name="currency">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Currency Code</label>
                                <input type="text" class="form-control" wire:model="currency_code"
                                    name="currency_code">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Select Mission</label>
                                <select class="form-control" wire:model="embassy_id" data-choices name="embassy_id">
                                    <option value="">Select Mission</option>
                                    <!--[if BLOCK]><![endif]--><?php $__currentLoopData = $embassies; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $embassy): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <option value="<?php echo e($embassy['id']); ?>"><?php echo e($embassy['name']); ?></option>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><!--[if ENDBLOCK]><![endif]-->
                                </select>
                            </div>
                        </div>
                        <div class="hstack gap-2 justify-content-center mt-4">
                            <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">
                                <?php echo e($editingId ? 'Update' : 'Save'); ?>

                            </button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <!-- Include SweetAlert2 -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script src="https://cdn.jsdelivr.net/npm/choices.js/public/assets/scripts/choices.min.js"></script>


    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const elements = document.querySelectorAll('[data-choices]');
            elements.forEach(el => {
                new Choices(el, {
                    searchEnabled: true,
                    itemSelectText: '',
                });
            });
        });

        document.addEventListener('click', function(e) {
            const deleteBtn = e.target.closest('.delete-btn');
            if (deleteBtn) {
                e.preventDefault();
                const countryId = deleteBtn.dataset.id;

                Swal.fire({
                    title: 'Are you sure?',
                    text: "You won't be able to revert this!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, delete it!'
                }).then((result) => {
                    if (result.isConfirmed) {
                        window.Livewire.find('<?php echo e($_instance->getId()); ?>').deleteConfirm(countryId);
                    }
                });
            }
        });

        Livewire.on('showDeleteSuccess', () => {
            Swal.fire({
                icon: 'success',
                title: 'Deleted!',
                text: 'Country has been deleted.',
                showConfirmButton: false,
                timer: 1500
            });
        });

        Livewire.on('showDeleteError', () => {
            Swal.fire({
                icon: 'error',
                title: 'Error!',
                text: 'Failed to delete country.',
            });
        });

        window.addEventListener('close-modal', () => {
            $('.countries-modal').modal('hide');
        });
    </script>

</div>

<?php $__env->startPush('scripts'); ?>
    <script>
        window.addEventListener('close-modal', () => {
            $('.countries-modal').modal('hide');
        });
    </script>
<?php $__env->stopPush(); ?>
<?php /**PATH C:\Users\Public\projects\damis_back_office\resources\views/livewire/countries-table.blade.php ENDPATH**/ ?>
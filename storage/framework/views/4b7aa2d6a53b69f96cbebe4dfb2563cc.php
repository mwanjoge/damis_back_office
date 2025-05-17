<?php echo $__env->make('modal.alert', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
<div>

    <div class="tab-pane px-4" id="designation" role="tabpanel">
        <div class="text-end pb-4">
            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target=".designation-modal"
                onclick="openDesignationModal()">
                New Designation
            </button>
        </div>

        <div class="table-responsive table-card">
            <table class="table table-borderless table-centered align-middle table-nowrap mb-0">
                <thead class="text-muted table-light">
                    <tr>
                        <th>#</th>
                        <th>Designation</th>
                        <th>Account</th>
                        <th class="text-end" style="width: 180px;">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <!--[if BLOCK]><![endif]--><?php $__empty_1 = true; $__currentLoopData = $designations; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $designation): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                        <tr>
                            <td><?php echo e($loop->iteration); ?></td>
                            <td><?php echo e($designation->name); ?></td>
                            <td><?php echo e($designation->account->name ?? 'N/A'); ?></td>
                            <td class="text-end">
                                <button class="btn btn-warning btn-sm" data-bs-toggle="modal"
                                    data-bs-target=".designation-modal"
                                    onclick="openDesignationModal(<?php echo e(json_encode($designation)); ?>)">
                                    <i class="bx bx-edit-alt"></i>
                                </button>

                                <form method="POST" action="<?php echo e(route('designation.destroy', $designation->id)); ?>"
                                    style="display:inline-block;">
                                    <?php echo csrf_field(); ?>
                                    <?php echo method_field('DELETE'); ?>
                                    <button type="submit" class="btn btn-danger btn-sm">
                                        <i class="bx bxs-trash"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                        <tr>
                            <td colspan="4" class="text-center">No designations found.</td>
                        </tr>
                    <?php endif; ?><!--[if ENDBLOCK]><![endif]-->
                </tbody>
            </table>
        </div>
    </div>

    <!-- Designation Modal -->
    <div wire:ignore.self class="modal fade designation-modal" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <form id="designationForm" method="post" action="<?php echo e(route('designation.store')); ?>">
                    <?php echo csrf_field(); ?>
                    <input type="hidden" name="_method" id="designationMethod" value="POST">
                    <input type="hidden" name="id" id="designationId">
                    <div class="modal-header text-center">
                        <h4 id="designationModalTitle">Add New Designation</h4>
                    </div>

                    <div class="modal-body px-5">
                        <!--[if BLOCK]><![endif]--><?php if($errors->any()): ?>
                            <div class="alert alert-danger">
                                <ul class="mb-0">
                                    <!--[if BLOCK]><![endif]--><?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <li><?php echo e($error); ?></li>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><!--[if ENDBLOCK]><![endif]-->
                                </ul>
                            </div>
                        <?php endif; ?><!--[if ENDBLOCK]><![endif]-->
                        <div class="mb-3">
                            <label class="form-label">Designation Name</label>
                            <input type="text" name="name" id="designationName" class="form-control">
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Account</label>
                            <select name="account_id" id="designationAccountId" data-choices class="form-select " required>
                                <option value="">Select Account</option>
                                <!--[if BLOCK]><![endif]--><?php $__currentLoopData = $accounts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $account): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option value="<?php echo e($account->id); ?>"><?php echo e($account->name); ?></option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><!--[if ENDBLOCK]><![endif]-->
                            </select>
                        </div>

                        <div class="hstack gap-2 justify-content-center mt-4">
                            <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Save Designation</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        function openDesignationModal(data = {}) {
            const isEdit = !!data.id;
            document.getElementById('designationModalTitle').innerText = isEdit ? 'Edit Designation' : 'Add New Designation';
            document.getElementById('designationMethod').value = isEdit ? 'PUT' : 'POST';
            document.getElementById('designationId').value = data.id || '';
            document.getElementById('designationName').value = data.name || '';
            document.getElementById('designationAccountId').value = data.account_id || '';

            const form = document.getElementById('designationForm');
            const formActionBase = "<?php echo e(url('designation')); ?>";
            form.action = isEdit ? `${formActionBase}/${data.id}` : formActionBase;

            new bootstrap.Modal(document.querySelector('.designation-modal')).show();
        }

        function confirmDelete(id, type) {
            if (confirm(`Are you sure you want to delete this ${type}?`)) {
                console.log(`Deleting ${type} with ID: ${id}`);
            }
        }
    </script>
</div>
<?php /**PATH C:\Users\Public\projects\damis_back_office\resources\views/livewire/designation-table.blade.php ENDPATH**/ ?>
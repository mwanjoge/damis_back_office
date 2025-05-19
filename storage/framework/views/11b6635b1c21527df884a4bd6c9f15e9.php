                <?php echo $__env->make('modal.alert', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
                <div>
                    <div class="tab-pane px-4" id="department" role="tabpanel">
                        <div class="text-end pb-4">
                            <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                                data-bs-target=".department-modal" onclick="openDepartmentModal()">
                                New Department
                            </button>
                        </div>
                        <div class="table-responsive table-card">
                            <table class="table table-borderless table-centered align-middle table-nowrap mb-0 datatable">
                                <thead class="text-muted table-light">
                                    <tr>
                                        <th>#</th>
                                        <th>Department</th>
                                        <!-- Removed Status column -->
                                        <th class="text-end" style="width: 180px;">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <!--[if BLOCK]><![endif]--><?php $__empty_1 = true; $__currentLoopData = $departments; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $department): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                        <tr>
                                            <td><?php echo e($loop->iteration); ?></td>
                                            <td><?php echo e($department->name); ?></td>
                                            <!-- Removed Status cell -->
                                            <td class="text-end">
                                                <button class="btn btn-warning btn-sm" data-bs-toggle="modal"
                                                    data-bs-target=".department-modal"
                                                    onclick="openDepartmentModal(<?php echo e(json_encode($department)); ?>)">
                                                    <i class="bx bx-pencil"></i>
                                                </button>
                                                <form method="POST"
                                                    action="<?php echo e(route('department.destroy', $department->id)); ?>"
                                                    style="display:inline-block;">
                                                    <?php echo csrf_field(); ?>
                                                    <?php echo method_field('DELETE'); ?>
                                                    <button type="submit" class="btn btn-danger btn-sm">
                                                        <i class="bx bx-trash-alt"></i>
                                                    </button>
                                                </form>
                                            </td>
                                        </tr>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                                        <tr>
                                            <td colspan="4" class="text-center">No departments found.</td>
                                        </tr>
                                    <?php endif; ?><!--[if ENDBLOCK]><![endif]-->
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <!-- Department Modal -->
                    <div wire:ignore.self class="modal fade department-modal" tabindex="-1" role="dialog"
                        aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content">
                                <form id="departmentForm" method="post" action="<?php echo e(route('department.store')); ?>">
                                    <?php echo csrf_field(); ?>
                                    <div class="modal-header text-center">
                                        <h4 id="departmentModalTitle">Add New Department</h4>
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
                                        <input type="hidden" name="_method" id="departmentMethod" value="POST">
                                        <input type="hidden" name="id" id="departmentId">
                                        <div class="mb-3">
                                            <label class="form-label">Department Name</label>
                                            <input type="text" name="name" id="departmentName"
                                                class="form-control" required>
                                        </div>
                                        <!-- Removed Status field -->
                                        <div class="hstack gap-2 justify-content-center mt-4">
                                            <button type="button" class="btn btn-light"
                                                data-bs-dismiss="modal">Close</button>
                                            <button type="submit" class="btn btn-primary">Save Department</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <script>
                        function openDepartmentModal(data = {}) {
                            const isEdit = !!data.id;
                            document.getElementById('departmentModalTitle').innerText = isEdit ? 'Edit Department' : 'Add New Department';
                            document.getElementById('departmentId').value = data.id || '';
                            document.getElementById('departmentName').value = data.name || '';
                            // Removed departmentStatus logic

                            const methodInput = document.getElementById('departmentMethod');
                            const form = document.getElementById('departmentForm');
                            const storeUrl = "<?php echo e(route('department.store')); ?>";
                            const updateUrlTemplate = "<?php echo e(route('department.update', ['department' => ':id'])); ?>";

                            if (isEdit) {
                                methodInput.value = 'PUT';
                                form.action = updateUrlTemplate.replace(':id', data.id);
                            } else {
                                methodInput.value = 'POST';
                                form.action = storeUrl;
                            }

                            new bootstrap.Modal(document.querySelector('.department-modal')).show();
                        }
                    </script>
                </div>
<?php /**PATH C:\Users\Public\projects\damis_back_office\resources\views/livewire/department-table.blade.php ENDPATH**/ ?>
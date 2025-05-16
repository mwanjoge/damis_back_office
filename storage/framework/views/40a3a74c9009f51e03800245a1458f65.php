<div>
    <?php echo $__env->make('modal.alert', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
    <div class="tab-pane px-4" id="employee" role="tabpanel">
        <div class="text-end pb-4">
            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target=".employee-modal"
                onclick="openEmployeeModal()">
                New Employee
            </button>
        </div>

        <div class="table-responsive">
            <table class="table table-nowrap mb-0">
                <thead class="text-muted table-light">
                    <tr>
                        <th>#</th>
                        <th>First Name</th>
                        <th>Last Name</th>
                        <th>Email</th>
                        <th>Department</th>
                        <th>Designation</th>
                        <th>Status</th>
                        <th class="text-end" style="width: 220px;">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <!--[if BLOCK]><![endif]--><?php $__empty_1 = true; $__currentLoopData = $employees; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $employee): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                        <tr>
                            <td><?php echo e($loop->iteration); ?></td>
                            <td><?php echo e($employee->first_name); ?></td>
                            <td><?php echo e($employee->last_name); ?></td>
                            <td><?php echo e($employee->email); ?></td>
                            <td><?php echo e($employee->department->name ?? 'N/A'); ?></td>
                            <td><?php echo e($employee->designation->name ?? 'N/A'); ?></td>
                            <td><span
                                    class="badge <?php echo e($employee->is_active ? 'bg-success' : 'bg-danger'); ?>"><?php echo e($employee->is_active ? 'Active' : 'Inactive'); ?></span>
                            </td>
                            <td class="text-end">
                                <button class="btn btn-warning btn-sm" data-bs-toggle="modal"
                                    data-bs-target=".employee-modal"
                                    onclick="openEmployeeModal(<?php echo e(json_encode($employee)); ?>)">
                                    <i class="bx bx-edit-alt"></i>
                                </button>
                                <form method="POST" action="<?php echo e(route('employee.destroy', $employee->id)); ?>"
                                    style="display:inline-block;">
                                    <?php echo csrf_field(); ?>
                                    <?php echo method_field('DELETE'); ?>
                                    <button type="submit" class="btn btn-danger btn-sm">
                                        <i class="bx bxs-trash"></i>
                                    </button>
                                </form>
                                <a href="<?php echo e(route('employee.show', $employee->id)); ?>" class="btn btn-info btn-sm">
                                    <i class="bx bxs-show"></i>
                                </a>
                                <form method="POST" action="<?php echo e(route('employee.reset-password', $employee->id)); ?>"
                                    style="display:inline-block;" onsubmit="return confirm('Are you sure you want to reset the password to default?');">
                                    <?php echo csrf_field(); ?>
                                    <button type="submit" class="btn btn-secondary btn-sm" title="Reset Password">
                                        <i class="bx bx-reset"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                        <tr>
                            <td colspan="8" class="text-center">No employees found.</td>
                        </tr>
                    <?php endif; ?><!--[if ENDBLOCK]><![endif]-->
                </tbody>
            </table>
        </div>
    </div>
    <!-- Employee Modal -->
    <div wire:ignore.self class="modal fade employee-modal" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <form id="employeeForm" method="post" action="<?php echo e(route('employee.store')); ?>">
                    <?php echo csrf_field(); ?>
                    <div class="modal-header text-center">
                        <h4 id="employeeModalTitle">Add New Employee</h4>
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
                        <input type="hidden" name="_method" id="employeeMethod">
                        <input type="hidden" name="id" id="employeeId">
                        <div class="mb-3">
                            <label class="form-label">First Name</label>
                            <input type="text" name="first_name" id="employeeFirstName" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Last Name</label>
                            <input type="text" name="last_name" id="employeeLastName" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Email</label>
                            <input type="email" name="email" id="employeeEmail" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Department</label>
                            <select name="depertment_id" id="employeeDepartmentId" data-choices class="form-select "
                                required>
                                <option value="">Select Department</option>
                                <!--[if BLOCK]><![endif]--><?php $__currentLoopData = $departments; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $department): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option value="<?php echo e($department->id); ?>"><?php echo e($department->name); ?></option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><!--[if ENDBLOCK]><![endif]-->
                            </select>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Designation</label>
                            <select name="designation_id" id="employeeDesignationId" data-choices class="form-select ">
                                <option value="">Select Designation</option>
                                <!--[if BLOCK]><![endif]--><?php $__currentLoopData = $designations; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $designation): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option value="<?php echo e($designation->id); ?>"><?php echo e($designation->name); ?></option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><!--[if ENDBLOCK]><![endif]-->
                            </select>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Status</label>
                            <select name="is_active" id="employeeStatus" class="form-select" required>
                                <option value="1">Active</option>
                                <option value="0">Inactive</option>
                            </select>
                        </div>
                        <div class="hstack gap-2 justify-content-center mt-4">
                            <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Save Employee</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <script>
        function openEmployeeModal(data = {}) {
            document.getElementById('employeeModalTitle').innerText = data.id ? 'Edit Employee' : 'Add New Employee';
            document.getElementById('employeeMethod').value = data.id ? 'PUT' : 'POST';
            document.getElementById('employeeId').value = data.id || '';
            document.getElementById('employeeFirstName').value = data.first_name || '';
            document.getElementById('employeeLastName').value = data.last_name || '';
            document.getElementById('employeeEmail').value = data.email || '';
            document.getElementById('employeeDepartmentId').value = data.depertment_id || '';
            document.getElementById('employeeDesignationId').value = data.designation_id || '';
            document.getElementById('employeeStatus').value = data.is_active ? '1' : '0';
            const formActionBase = "<?php echo e(url('employee')); ?>";
            document.getElementById('employeeForm').action = data.id ? `${formActionBase}/${data.id}` : formActionBase;
            new bootstrap.Modal(document.querySelector('.employee-modal')).show();
        }
    </script>
</div>
<?php /**PATH D:\PROJECTS\damis_back_office\resources\views/livewire/employee-table.blade.php ENDPATH**/ ?>

<?php echo $__env->make('modal.alert', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>

    
   
        
        <table class="table table-hover mb-0">
                <thead class="bg-light text-dark">
                    <tr>
                        <th>#</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Phone</th>
                        <th>Role</th>
                        <th class="text-end" style="width: 180px;">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $__currentLoopData = $users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr>
                            <td><?php echo e($loop->iteration); ?></td>
                            <td><?php echo e($user->name); ?></td>
                            <td><?php echo e($user->email); ?></td>
                            <td><?php echo e($user->phone); ?></td>
                            <td class="text-capitalize">
                                <?php if($user->roles->isEmpty()): ?>
                                    <span class="text-muted">No role assigned</span>
                                <?php else: ?>
                                    <?php $__currentLoopData = $user->roles; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $role): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <span class="text-capitalize"><?php echo e($role->name); ?></span>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                <?php endif; ?>

                            </td>
                            <td class="text-end">
                                <button class="btn btn-sm btn-warning" data-bs-toggle="modal"
                                    data-bs-target="#userModal"
                                    onclick="openUserModal('edit', <?php echo e($user->id); ?>, '<?php echo e($user->name); ?>', <?php echo e($user->role_id ?? 'null'); ?>)">
                                    <i class="bx bx-lock-alt"></i>
                                </button>
                                
                            </td>
                        </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </tbody>
            </table>




<?php echo $__env->make('authentication.users.users_modal', ['roles' => $roles], array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>

<script>
    function openUserModal(mode, id = '', name = '', roleId = '') {
        const modalTitle = document.getElementById('userModalLabel');
        const userIdField = document.getElementById('userId');
        const nameField = document.getElementById('userName');
        const roleSelect = document.getElementById('userRole');

        nameField.value = name;
        roleSelect.value = roleId || '';

        if (mode === 'edit') {
            modalTitle.innerText = 'Assign Role';
            userIdField.value = id;
        } else {
            modalTitle.innerText = 'Add New User';
            userIdField.value = '';
            nameField.value = '';
            roleSelect.value = '';
        }
    }
</script>
<?php /**PATH /Users/administrator/Herd/damis_back_office/resources/views/authentication/users/users_table.blade.php ENDPATH**/ ?>
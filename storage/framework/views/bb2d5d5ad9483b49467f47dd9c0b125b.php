
<?php echo $__env->make('authentication.roles.role_modal', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>


<div class="container">
    <?php echo $__env->make('modal.alert', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
    <div class="d-flex justify-content-end align-items-center">
        
        <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#roleModal"
            onclick="openRoleModal('create')">+ Create New Role</button>
    </div>

    <div class="card">
        <div class="card-body">
            <table class="table table-striped">
                <thead>
                    <tr class="bg-light text-dark">
                        <th>#</th>
                        <th>Role Name</th>
                        <th>Permissions</th>
                        <th class="text-end" style="width: 180px;">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $__currentLoopData = $roles; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $role): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr>
                            <td><?php echo e($loop->iteration); ?></td>
                            <td class="text-capitalize"><?php echo e($role->name); ?></td>
                            <td><?php echo e($role->permissions->count()); ?> permissions</td>
                            <td class="text-end">
                                <a href="<?php echo e(route('roles.show', $role->id)); ?>" class="btn btn-sm btn-primary">
                                    <i class="bx bx-show"></i>
                                </a>
                                <button class="btn btn-sm btn-warning" data-bs-toggle="modal"
                                    data-bs-target="#roleModal"
                                    onclick="openRoleModal('edit', <?php echo e($role->id); ?>, '<?php echo e(addslashes($role->name)); ?>')">
                                    <i class="bx bx-edit-alt"></i>
                                </button>

                                <a href="#" class="btn btn-sm btn-danger">
                                    <i class="bx bxs-trash"></i>
                                </a>
                            </td>
                        </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </tbody>
            </table>
        </div>

    </div>
</div>



    <script>
        const createRoleUrl = "<?php echo e(route('roles.store')); ?>";
        const updateRoleUrlTemplate = "<?php echo e(route('roles.update', ['role' => '__ROLE_ID__'])); ?>";

        function openRoleModal(mode, id = null, name = '') {
            console.log('Editing Role:', id, name);

            const modalTitle = document.getElementById('roleModalLabel');
            const form = document.getElementById('roleForm');
            const nameInput = document.getElementById('roleName');
            const methodInput = document.getElementById('_method_field');
            const roleIdInput = document.getElementById('roleId');

            if (mode === 'edit') {
                modalTitle.textContent = 'Edit Role';
                nameInput.value = name;
                form.action = updateRoleUrlTemplate.replace('__ROLE_ID__', id);
                methodInput.value = 'PUT';
                roleIdInput.value = id;
            } else {
                modalTitle.textContent = 'Create New Role';
                nameInput.value = '';
                form.action = createRoleUrl;
                methodInput.value = 'POST';
                roleIdInput.value = '';
            }
        }
    </script>
<?php /**PATH D:\PROJECTS\damis_back_office\resources\views/authentication/roles/index.blade.php ENDPATH**/ ?>
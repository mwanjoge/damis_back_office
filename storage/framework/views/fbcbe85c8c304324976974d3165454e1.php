<?php echo $__env->make('modal.alert', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>

<div id="services" role="tabpanel">
    <div class="text-end pb-4">
        <button type="button" class="btn btn-primary" id="new-service-btn" data-bs-toggle="modal"
                                    data-bs-target=".services-modal">
            New Service
        </button>
    </div>

    <div class="table-responsive table-card">
        <table class="table table-borderless table-centered align-middle table-nowrap mb-0">
            <thead class="text-muted table-light">
                <tr>
                    <th>#</th>
                    <th>Service</th>
                    <th>Service Provider</th>
                    <th class="text-end" style="width: 180px;">Actions</th>
                </tr>
            </thead>
            <tbody>
                <!--[if BLOCK]><![endif]--><?php $__currentLoopData = $services; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $service): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <tr>
                        <td><?php echo e($loop->iteration); ?></td>
                        <td><?php echo e($service->name); ?></td>
                        <td><?php echo e($service->serviceProvider->name ?? 'N/A'); ?></td>
                        <td class="text-end">
                            <button type="button" class="btn btn-warning btn-sm edit-btn" data-bs-toggle="modal"
                                    data-bs-target=".services-modal" data-id="<?php echo e($service->id); ?>" data-name="<?php echo e($service->name); ?>" data-provider="<?php echo e($service->serviceProvider->id ?? ''); ?>">
                                <i class="bx bx-edit-alt"></i>
                            </button>

                            <button type="button" class="btn btn-danger btn-sm delete-btn" data-id="<?php echo e($service->id); ?>">
                                <i class="bx bxs-trash"></i>
                            </button>
                        </td>
                    </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><!--[if ENDBLOCK]><![endif]-->
            </tbody>
        </table>
    </div>

    <!-- Modal -->
    <div class="modal fade services-modal" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-body text-start p-5">
                    <h4 class="mb-3 text-center" id="modal-title">New Service</h4>

                    <form id="service-form" method="post">
                        <?php echo csrf_field(); ?>
                        <div class="mb-3">
                            <label class="form-label">Service Name</label>
                            <input type="text" class="form-control" id="service-name" placeholder="Service Name" name='name' required>
                            <span class="text-danger" id="name-error"></span>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Service Provider</label>
                            <select id="service-provider" class="form-select" name="service_provider_id" required>
                                <option value="">-- Select --</option>
                                <!--[if BLOCK]><![endif]--><?php $__currentLoopData = $serviceProviders; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $provider): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option value="<?php echo e($provider->id); ?>"><?php echo e($provider->name); ?></option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><!--[if ENDBLOCK]><![endif]-->
                            </select>
                            <span class="text-danger" id="provider-error"></span>
                        </div>

                        <div class="hstack gap-2 justify-content-center mt-4">
                            <button type="button" class="btn btn-light" data-bs-dismiss="modal" id="close-modal-btn">Close</button>
                            <button type="submit" class="btn btn-primary" >Save</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>


<script>
  document.addEventListener('DOMContentLoaded', function() {
    // document.getElementById('modal-title').innerText = data.id ? 'Edit Service' : 'Add New Service';
    document.getElementById('service-form').value = data.id ? 'PUT' : 'POST';
    const servicesModal = new bootstrap.Modal(document.querySelector('.services-modal'));
    const form = document.getElementById('service-form');
    const submitBtn = document.getElementById('submit-btn');
    const modalTitle = document.getElementById('modal-title');
    const serviceNameInput = document.getElementById('service-name');
    const serviceProviderSelect = document.getElementById('service-provider');
    const closeModalBtn = document.getElementById('close-modal-btn');

    const formActionBase = "<?php echo e(url('service')); ?>";
    document.getElementById('service-form').action = data.id ? `${formActionBase}/${data.id}` : formActionBase;

    // Handle new service button
    document.getElementById('new-service-btn').addEventListener('click', function() {
        modalTitle.innerText = 'New Service';
        serviceNameInput.value = '';
        serviceProviderSelect.value = '';
        submitBtn.innerText = 'Save';
        servicesModal.show();
    });

    // Handle edit button click
    document.querySelectorAll('.edit-btn').forEach(button => {
        button.addEventListener('click', function() {
            const serviceId = button.getAttribute('data-id');
            const serviceName = button.getAttribute('data-name');
            const serviceProviderId = button.getAttribute('data-provider');

            modalTitle.innerText = 'Edit Service';
            serviceNameInput.value = serviceName;
            serviceProviderSelect.value = serviceProviderId || '';
            submitBtn.innerText = 'Update';

            // form.action = `<?php echo e(url('service')); ?>/${serviceId}/edit`;


            servicesModal.show();
        });
    });

    // Handle modal close
    closeModalBtn.addEventListener('click', function() {
        servicesModal.hide();
    });

    // Handle delete confirmation
    document.addEventListener('click', function(e) {
        const deleteBtn = e.target.closest('.delete-btn');
        if (deleteBtn) {
            e.preventDefault();
            const serviceId = deleteBtn.dataset.id;

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
                    window.location.href = `<?php echo e(route('service.destroy', ':id')); ?>`.replace(':id', serviceId);
                    // Send delete request
                    fetch(route('service.destroy', serviceId), {
                        method: 'DELETE',
                        headers: {
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                        }
                    });
                }
            });
        }
    });
});

</script>
<?php /**PATH C:\Users\Public\projects\damis_back_office\resources\views/livewire/services-table.blade.php ENDPATH**/ ?>
<?php echo $__env->make('modal.alert', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
<div>
    <div class="tab-pane px-4" id="embassy" role="tabpanel">
        <div class="text-end pb-4">
            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target=".mission-modal"
                onclick="openMissionModal()">
                New Mission
            </button>
        </div>

        <div class="table-responsive table-card" wire:ignore>
            <table class="table table-borderless table-centered align-middle table-nowrap mb-0  datatable">
                <thead class="text-muted table-light">
                    <tr>
                        <th>#</th>
                        <th>Mission</th>
                        <th>Type</th>
                        <th>Status</th>
                        <th class="text-end" style="width: 180px;">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <!--[if BLOCK]><![endif]--><?php $__empty_1 = true; $__currentLoopData = $embassies; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $embassy): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                        <tr>
                            <td><?php echo e($loop->iteration); ?></td>
                            <td><?php echo e($embassy->name); ?></td>
                            <td><?php echo e(ucfirst($embassy->type)); ?></td>
                            <td><?php echo e($embassy->is_active ? 'Active' : 'Inactive'); ?></td>
                            <td class="text-end">
                                <?php
                                    $embassyData = $embassy->only(['id', 'name', 'type', 'is_active']);
                                    $embassyData['countries'] = $embassy->countries->pluck('id')->toArray();
                                    $embassyData['location_id'] = $embassy->country_id;

                                ?>

                                <button class="btn btn-warning btn-sm" data-bs-toggle="modal"
                                    data-bs-target=".mission-modal"
                                    onclick='openMissionModal(<?php echo json_encode($embassyData, 15, 512) ?>)'>
                                    <i class="bx bx-pencil"></i>
                                </button>


                                <form method="POST" action="<?php echo e(route('embassy.destroy', $embassy->id)); ?>"
                                    style="display:inline-block;">
                                    <?php echo csrf_field(); ?>
                                    <?php echo method_field('DELETE'); ?>
                                    <button type="submit" class="btn btn-danger btn-sm">
                                        <i class="bx bx-trash-alt"></i>
                                    </button>
                                </form>
                                <a href="<?php echo e(route('embassies.show', $embassy->id)); ?>" class="btn btn-info btn-sm">
                                    <i class="bx bx-detail"></i>
                                </a>

                            </td>
                        </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                        <tr>
                            <td colspan="5" class="text-center">No missions found.</td>
                        </tr>
                    <?php endif; ?><!--[if ENDBLOCK]><![endif]-->
                </tbody>
            </table>
        </div>
    </div>

    <!-- Mission Modal -->
    <div wire:ignore.self class="modal fade mission-modal" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <form id="missionForm" method="post">
                    <?php echo csrf_field(); ?>
                    <div class="modal-header text-center">
                        <h4 id="missionModalTitle">Add New Mission</h4>
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
                        <input type="hidden" name="_method" id="missionMethod">
                        <input type="hidden" name="id" id="missionId">

                        <div class="mb-3">
                            <label class="form-label">Mission Name</label>
                            <input type="text" name="name" id="missionName" class="form-control" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Type</label>
                            <select name="type" id="missionType" class="form-select" required>
                                <option value="Embassy">Embassy</option>
                                <option value="Permanent Mission">Permanent Mission</option>
                                <option value="High Commission">High Commission</option>
                            </select>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Mission Location</label>
                            <select name="location_id" data-choices class="form-select " required
                               >
                                <option value="">Select Location</option>
                                <!--[if BLOCK]><![endif]--><?php $__currentLoopData = $countries; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $id => $name): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option value="<?php echo e($id); ?>"><?php echo e($name); ?></option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><!--[if ENDBLOCK]><![endif]-->
                            </select>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Status</label>
                            <select name="is_active" id="missionStatus" class="form-select" required>
                                <option value="1">Active</option>
                                <option value="0">Inactive</option>
                            </select>
                        </div>
                        <div id="accreditedCountriesWrapper" class="mb-3">
                            <p class="mt-4">Accredited Countries</p>
                            <select name="country_id[]" class="js-example-basic-multiple form-select" multiple
                                wire:model="states" required>
                                <!--[if BLOCK]><![endif]--><?php $__currentLoopData = $countries; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $id => $name): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option value="<?php echo e($id); ?>"><?php echo e($name); ?></option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><!--[if ENDBLOCK]><![endif]-->
                            </select>
                        </div>

                        <div class="hstack gap-2 justify-content-center mt-4">
                            <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Save</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        function openMissionModal(data = {}) {
            document.getElementById('missionModalTitle').innerText = data.id ? 'Edit Mission' : 'Add New Mission';
            document.getElementById('missionMethod').value = data.id ? 'PUT' : 'POST';
            document.getElementById('missionId').value = data.id || '';
            document.getElementById('missionName').value = data.name || '';
            document.getElementById('missionType').value = data.type || 'Embassy';
            document.getElementById('missionStatus').value = data.is_active ? '1' : '0';

            const formActionBase = "<?php echo e(url('embassy')); ?>";
            document.getElementById('missionForm').action = data.id ? `${formActionBase}/${data.id}` : formActionBase;

            // Pre-select mission location
            const locationSelect = document.querySelector('select[name="location_id"]');
            locationSelect.value = data.country_id || '';

            const countrySelect = document.querySelector('select[name="country_id[]"]');

            // Show/hide Accredited Countries field
            const accreditedCountriesWrapper = document.getElementById('accreditedCountriesWrapper');
            if (data.id) {
                accreditedCountriesWrapper.style.display = 'block'; // hide when editing
            } else {
                accreditedCountriesWrapper.style.display = 'block'; // show when adding
            }

            // Reset selection
            Array.from(countrySelect.options).forEach(option => {
                option.selected = false;
            });

            if (data.countries) {
                data.countries.forEach(id => {
                    const option = Array.from(countrySelect.options).find(opt => opt.value == id);
                    if (option) option.selected = true;
                });
            }

            if ($(countrySelect).hasClass('js-example-basic-multiple')) {
                $(countrySelect).trigger('change');
            }

            new bootstrap.Modal(document.querySelector('.mission-modal')).show();
        }



        function confirmDelete(id, type) {
            if (confirm(`Are you sure you want to delete this ${type}?`)) {
                console.log(`Deleting ${type} with ID: ${id}`);
            }
        }
    </script>
</div>
<?php /**PATH C:\Users\Public\projects\damis_back_office\resources\views/livewire/embassies-table.blade.php ENDPATH**/ ?>
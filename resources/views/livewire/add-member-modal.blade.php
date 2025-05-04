<div>
    <!-- Modal -->
    <div class="modal fade" id="addMemberModal" tabindex="-1" aria-labelledby="addMemberModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <form wire:submit.prevent="saveMember">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="addMemberModalLabel">Add Member</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="member_name" class="form-label">Name</label>
                            <input type="text" id="member_name" class="form-control" wire:model="name" required>
                        </div>
                        <div class="mb-3">
                            <label for="member_email" class="form-label">Email</label>
                            <input type="email" id="member_email" class="form-control" wire:model="email">
                        </div>
                        <div class="mb-3">
                            <label for="member_phone" class="form-label">Phone</label>
                            <input type="text" id="member_phone" class="form-control" wire:model="phone">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary btn-sm">Save Member</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    document.addEventListener('livewire:load', function () {
        Livewire.on('memberAdded', function (id, name) {
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
            // Close the modal (if using Bootstrap 5)
            let modal = bootstrap.Modal.getInstance(document.getElementById('addMemberModal'));
            modal.hide();
        });
    });

    function toggleEmbassyCountry() {
        let memberSelect = document.getElementById('member_id');
        let selected = memberSelect.options[memberSelect.selectedIndex];
        let type = selected ? selected.getAttribute('data-type') : '';
        let embassyDiv = document.getElementById('embassySelect').closest('.col-md-6');
        let countryDiv = document.getElementById('countrySelect').closest('.col-md-6');
        if (type === 'Domestic') {
            embassyDiv.style.display = 'none';
            countryDiv.style.display = 'none';
            document.getElementById('embassySelect').required = false;
            document.getElementById('countrySelect').required = false;
        } else {
            embassyDiv.style.display = '';
            countryDiv.style.display = '';
            document.getElementById('embassySelect').required = true;
            document.getElementById('countrySelect').required = true;
        }
    }
    document.getElementById('member_id').addEventListener('change', toggleEmbassyCountry);
    document.addEventListener('DOMContentLoaded', toggleEmbassyCountry);
</script>


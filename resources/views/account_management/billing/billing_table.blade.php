<div class="tab-pane px-4" id="embassy" role="tabpanel">
    <div class="text-end pb-4">
        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target=".mission-modal"
            onclick="openMissionModal()">
            New Billing
        </button>
    </div>

    <div class="table-responsive table-card">
        <table class="table table-borderless table-centered align-middle table-nowrap mb-0">
            <thead class="text-muted table-light">
                <tr>
                    <th>#</th>
                    <th>Country</th>
                    <th>Amount</th>
                    <th>Currency</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($bills as $bill)
                    <tr>
                        <td>1</td>
                        <td>Sample Embassy</td>
                        <td>Consulate</td>
                        <td>Active</td>
                        <td>
                            <button class="btn btn-warning btn-sm" data-bs-toggle="modal"
                                data-bs-target=".mission-modal"
                                onclick="openMissionModal('{{ $embassy->id }}', '{{ $embassy->name }}', '{{ $embassy->type }}', '{{ $embassy->is_active }}')">
                                <i class="bx bx-edit-alt"></i>
                            </button>

                            <button class="btn btn-danger btn-sm"
                                onclick="confirmDelete({{ $embassy->id }}, 'mission')">
                                <i class="bx bxs-trash"></i>
                            </button>
                            <button class="btn btn-info btn-sm">
                                <i class="bx bxs-show"></i>
                            </button>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="text-center">No Billing found.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
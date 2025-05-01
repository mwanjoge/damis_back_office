<script>
    function confirmDelete(recordId, recordType, deleteCallback) {
        const formattedType = recordType.charAt(0).toUpperCase() + recordType.slice(1);

        Swal.fire({
            title: `Are you sure?`,
            text: `This ${recordType} record will be deleted permanently!`,
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#d33",
            cancelButtonColor: "#3085d6",
            confirmButtonText: "Yes, delete it!"
        }).then((result) => {
            if (result.isConfirmed) {
                Swal.fire("Deleted!", `The ${recordType} record has been removed.`, "success");

                // If using Livewire:
                if (typeof deleteCallback === "function") {
                    deleteCallback(recordId);
                } else if (typeof Livewire !== "undefined" && deleteCallback) {
                    Livewire.emit(deleteCallback, recordId);
                }
            }
        });
    }
</script>

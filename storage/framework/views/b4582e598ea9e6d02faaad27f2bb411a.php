<script src="<?php echo e(URL::asset('build/libs/bootstrap/js/bootstrap.bundle.min.js')); ?>"></script>
<script src="<?php echo e(URL::asset('build/js/plugins.js')); ?>"></script>
<script src="<?php echo e(URL::asset('build/libs/simplebar/simplebar.min.js')); ?>"></script>
<script src="<?php echo e(URL::asset('build/libs/node-waves/waves.min.js')); ?>"></script>
<script src="<?php echo e(URL::asset('build/libs/feather-icons/feather.min.js')); ?>"></script>
<script src="<?php echo e(URL::asset('build/js/pages/plugins/lord-icon-2.1.0.js')); ?>"></script>
<<<<<<< HEAD
=======
<script src="<?php echo e(URL::asset('build/js/plugins.js')); ?>"></script>

<!-- DataTables JS -->
<script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.11.5/js/dataTables.bootstrap5.min.js"></script>
<script src="https://cdn.datatables.net/responsive/2.2.9/js/dataTables.responsive.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.2.2/js/dataTables.buttons.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.2.2/js/buttons.bootstrap5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.2.2/js/buttons.html5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.2.2/js/buttons.print.min.js"></script>

<!-- Required for Excel/PDF export -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>

<!-- Initialize DataTables for all tables -->
<script>
    $(document).ready(function() {
        // Initialize DataTables for all tables
        $('.table').each(function() {
            // Skip tables that already have DataTables initialized
            if ($.fn.DataTable.isDataTable(this)) {
                return;
            }

            // Check if table has any rows (excluding header)
            var rowCount = $(this).find('tbody tr').length;

            try {
                $(this).DataTable({
                    responsive: true,
                    lengthMenu: [
                        [10, 25, 50, -1],
                        [10, 25, 50, 'All']
                    ],
                    // Only show pagination if there are more than 10 rows
                    paging: rowCount > 10,
                    // Only show search box if there are more than 5 rows
                    searching: rowCount > 5,
                    // Conditionally add export buttons for tables with data
                    dom: rowCount > 0 ? 'Blfrtip' : 'lfrtip',
                    buttons: [
                        'copy', 'csv', 'excel', 'pdf', 'print'
                    ],
                    // Default ordering (sort by first column ascending)
                    order: [[0, 'asc']],
                    // Language customization
                    language: {
                        search: "_INPUT_",
                        searchPlaceholder: "Search...",
                        lengthMenu: "_MENU_ records per page",
                        info: "Showing _START_ to _END_ of _TOTAL_ entries",
                        infoEmpty: "Showing 0 to 0 of 0 entries",
                        infoFiltered: "(filtered from _MAX_ total entries)"
                    }
                });
            } catch (e) {
                console.error("Error initializing DataTable:", e);
            }
        });
    });
</script>
>>>>>>> 701fd51ddf4f8694b3c941a2466a9f682904f9d3

<?php echo $__env->yieldContent('script'); ?>
<?php echo $__env->yieldContent('script-bottom'); ?>
<?php /**PATH D:\PROJECTS\damis_back_office\resources\views/layouts/vendor-scripts.blade.php ENDPATH**/ ?>
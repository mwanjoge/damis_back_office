<!-- jQuery first, then Bootstrap bundle (includes Popper) -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>

<!-- Tabler Core JS -->
<script src="{{ asset('vendors/tabler/js/tabler.min.js') }}"></script>

<!-- Choices.js for enhanced select boxes -->
<script src="https://cdn.jsdelivr.net/npm/choices.js/public/assets/scripts/choices.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<!-- DataTables -->
<script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.3/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.datatables.net/2.3.1/js/dataTables.js"></script>
<script src="https://cdn.datatables.net/2.3.1/js/dataTables.bootstrap5.js"></script>

{{-- https://code.jquery.com/jquery-3.7.1.js
https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.3/js/bootstrap.bundle.min.js
https://cdn.datatables.net/2.3.1/js/dataTables.js
https://cdn.datatables.net/2.3.1/js/dataTables.bootstrap5.js --}}
<script src="{{ asset('vendors/tabler/js/app.js') }}"></script>

<!-- Chart.js -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<!-- Bootstrap JS Bundle with Popper -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous">
</script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/choices.js/public/assets/scripts/choices.min.js"></script>
<script src="{{ URL::asset('build/js/pages/select2.init.js') }}"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

{{-- <script src="./libs/apexcharts/dist/apexcharts.min.js?1744816593" defer></script>
<script src="./libs/jsvectormap/dist/jsvectormap.min.js?1744816593" defer></script>
<script src="./libs/jsvectormap/dist/maps/world.js?1744816593" defer></script>
<script src="./libs/jsvectormap/dist/maps/world-merc.js?1744816593" defer></script> --}}
<!-- END PAGE LIBRARIES -->
<!-- BEGIN GLOBAL MANDATORY SCRIPTS -->
<script src="{{ asset('vendors/tabler/js/tabler.min.js') }}" defer></script>
<!-- END GLOBAL MANDATORY SCRIPTS -->
<!-- BEGIN DEMO SCRIPTS -->
{{-- <script src="{{ asset('vendors/tabler/js/demo.min.js') }}" defer></script> --}}
<!-- END DEMO SCRIPTS -->
<!-- BEGIN PAGE SCRIPTS -->

<script>
    function confirmDelete(id) {
        Swal.fire({
            title: 'Are you sure?',
            text: "This action cannot be undone.",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#6c757d',
            confirmButtonText: 'Yes, delete it!',
            reverseButtons: true,
        }).then((result) => {
            if (result.isConfirmed) {
                document.getElementById('delete-form-' + id).submit();
            }
        });
    }
</script>

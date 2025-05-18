<!-- jQuery first, then Bootstrap bundle (includes Popper) -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>

<!-- Tabler Core JS -->
<script src="{{ asset('vendors/tabler/js/tabler.min.js') }}"></script>

<!-- Choices.js for enhanced select boxes -->
<script src="https://cdn.jsdelivr.net/npm/choices.js/public/assets/scripts/choices.min.js"></script>

<!-- DataTables -->
<script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.11.5/js/dataTables.bootstrap5.min.js"></script>
<script src="https://cdn.datatables.net/responsive/2.2.9/js/dataTables.responsive.min.js"></script>

<!-- Other libraries -->
<script src="{{ asset('vendors/tabler/js/apexcharts.min.js') }}"></script>
<script src="{{ asset('vendors/tabler/js/demo.min.js') }}"></script>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<!-- Initialize Choices.js -->
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Initialize all elements with data-choices
        var choicesElements = document.querySelectorAll('[data-choices]');
        if (choicesElements.length > 0) {
            choicesElements.forEach(function(element) {
                new Choices(element, {
                    searchEnabled: true,
                    itemSelectText: '',
                    shouldSort: false
                });
            });
        }
    });
</script>

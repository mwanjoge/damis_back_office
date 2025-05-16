<!-- Include SweetAlert2 -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<!--[if BLOCK]><![endif]--><?php if(session('success')): ?>
    <script>
        Swal.fire({
            icon: 'success',
            title: 'Success',
            text: '<?php echo e(session('success')); ?>',
            confirmButtonColor: '#3085d6',
            confirmButtonText: 'OK'
        });
    </script>
<?php endif; ?><!--[if ENDBLOCK]><![endif]-->

<!--[if BLOCK]><![endif]--><?php if(session('error')): ?>
    <script>
        Swal.fire({
            icon: 'error',
            title: 'Error',
            text: '<?php echo e(session('error')); ?>',
            confirmButtonColor: '#3085d6',
            confirmButtonText: 'OK'
        });
    </script>
<?php endif; ?><!--[if ENDBLOCK]><![endif]--><?php /**PATH D:\PROJECTS\damis_back_office\resources\views/modal/alert.blade.php ENDPATH**/ ?>
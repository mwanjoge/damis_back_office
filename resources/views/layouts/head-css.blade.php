@yield('css')
<!-- Layout config Js -->
<script src="{{ URL::asset('build/js/layout.js') }}"></script>
<!-- Bootstrap Css -->
<link href="{{ URL::asset('build/css/bootstrap.min.css') }}"  rel="stylesheet" type="text/css" />
<!-- Icons Css -->
<link href="{{ URL::asset('build/css/icons.min.css') }}" rel="stylesheet" type="text/css" />
<!-- App Css-->
<link href="{{ URL::asset('build/css/app.min.css') }}"  rel="stylesheet" type="text/css" />
<!-- custom Css-->
<link href="{{ URL::asset('build/css/custom.min.css') }}"  rel="stylesheet" type="text/css" />
<!-- Custom Breadcrumb Styles -->
<style>
    .breadcrumb {
        transition: all 0.3s ease;
        border-left: 3px solid #405189;
    }
    .breadcrumb-item + .breadcrumb-item::before {
        color: #6c757d;
    }
    .breadcrumb-item a:hover {
        text-decoration: underline;
    }
    .breadcrumb-item.active {
        color: #343a40 !important;
    }
</style>
<!-- DataTables Css -->
<link href="https://cdn.datatables.net/1.11.5/css/dataTables.bootstrap5.min.css" rel="stylesheet" type="text/css" />
<link href="https://cdn.datatables.net/responsive/2.2.9/css/responsive.bootstrap5.min.css" rel="stylesheet" type="text/css" />
<link href="https://cdn.datatables.net/buttons/2.2.2/css/buttons.bootstrap5.min.css" rel="stylesheet" type="text/css" />
<!-- Custom DataTables Css -->
<link href="{{ URL::asset('build/css/datatables-custom.css') }}" rel="stylesheet" type="text/css" />
{{-- @yield('css') --}}

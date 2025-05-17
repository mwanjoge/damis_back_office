@extends('layouts.tabler.app')
@section('content')
    @php
        $breadcrumbs = [
            ['name' => 'Home', 'url' => route('home')],
            ['name' => 'Human resource', 'url' => route('human_resources')]
        ];
    @endphp

    {{-- @include('layouts.breadcrumb') --}}

    <div class="row mt-4 mb-5">
        <div class="col-12 col-xl-12 col-xxl-10">
            <h4 class="p-1 font-italic">Settings</h4>
            <div class="card shadow-sm">
                <div class="card-header bg-white border-bottom-0">
                    <ul class="nav nav-tabs-custom rounded card-header-tabs border-bottom-0" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" data-bs-toggle="tab" href="#tab-department" role="tab">
                                <i class="bx bx-building"></i> Departments
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-bs-toggle="tab" href="#tab-designation" role="tab">
                                <i class="bx bx-id-card"></i> Designations
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-bs-toggle="tab" href="#tab-employee" role="tab">
                                <i class="bx bx-user"></i> Employees
                            </a>
                        </li>
                    </ul>
                </div>

                <div class="card-body px-4 bg-white">
                    <div class="tab-content">
                        <!-- Mission -->
                        <div class="tab-pane fade show active" id="tab-department" role="tabpanel" wire:ignore.self>

                            @livewire('department-table')
                        </div>

                        <!-- Countries -->
                        <div class="tab-pane fade" id="tab-designation" role="tabpanel" wire:ignore.self>

                            @livewire('designation-table')
                        </div>

                        <!-- Service Providers -->
                        <div class="tab-pane fade" id="tab-employee" role="tabpanel" wire:ignore.self>

                            @livewire('employee-table')
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('script')
    <script>
        $(function() {
            // Save the last opened tab on click
            $('a[data-bs-toggle="tab"]').on('shown.bs.tab', function(e) {
                localStorage.setItem('lastAuthTab', $(this).attr('href'));
            });

            // Get the last active tab
            var lastTab = localStorage.getItem('lastAuthTab');
            if (lastTab) {
                // Activate the tab
                $('a[data-bs-toggle="tab"][href="' + lastTab + '"]').tab('show');

                // Automatically open corresponding modal if there are errors
                @if ($errors->any())
                    $(document).ready(function() {
                        $('.modal.show').each(function() {
                            const instance = bootstrap.Modal.getInstance(this);
                            if (instance) {
                                instance.hide();
                                instance.dispose();
                            }
                        });
                        $('.modal-backdrop').remove();
                        // Convert tab ID to modal class name
                        let modalClass = lastTab.replace('#tab-', '') + '-modal';
                        let modalSelector = '.' + modalClass;

                        const modalEl = document.querySelector(modalSelector);
                        console.log('Trying to open modal:', modalSelector);
                        if (modalEl) {
                            const modal = new bootstrap.Modal(modalEl, {
                                // backdrop: 'static',
                                // keyboard: false
                            });
                            modal.show();
                        } else {
                            console.warn('Modal not found for selector:', modalSelector);
                        }
                    });
                @endif
            }
        });
    </script>
@endsection

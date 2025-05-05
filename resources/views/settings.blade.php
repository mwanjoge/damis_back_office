@extends('layouts.master')
@section('content')
    <div class="row">
        <div class="col-xxl-9">
            <h4 class="p-1 font-italic">Settings</h4>
            <div class="card mt-xxl-n5">
                <div class="card-header">
                    <ul class="nav nav-tabs-custom rounded card-header-tabs border-bottom-0" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" data-bs-toggle="tab" href="#tab-embassy" role="tab">
                                <i class="far fa-user"></i> Mission
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-bs-toggle="tab" href="#tab-countries" role="tab">
                                <i class="fas fa-home"></i> Countries
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-bs-toggle="tab" href="#tab-service-provider" role="tab">
                                <i class="far fa-user"></i> Service Providers
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-bs-toggle="tab" href="#tab-services" role="tab">
                                <i class="far fa-user"></i> Services
                            </a>
                        </li>
                    </ul>
                </div>

                <div class="card-body px-4" style="background-color: white">
                    <div class="tab-content">
                        <!-- Mission -->
                        <div class="tab-pane fade show active" id="tab-embassy" role="tabpanel" wire:ignore.self>
                            @livewire('embassies-table')
                        </div>

                        <!-- Countries -->
                        <div class="tab-pane fade" id="tab-countries" role="tabpanel" wire:ignore.self>
                            @livewire('countries-table')
                        </div>

                        <!-- Service Providers -->
                        <div class="tab-pane fade" id="tab-service-provider" role="tabpanel" wire:ignore.self>
                            @livewire('service-provider-table')
                        </div>

                        <!-- Services -->
                        <div class="tab-pane fade" id="tab-services" role="tabpanel" wire:ignore.self>
                            @livewire('services-table')
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
                        // First, force-close any open modals and remove all backdrops
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

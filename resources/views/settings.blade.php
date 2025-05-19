@extends('layouts.tabler.app')

@section('content')
    @php
        $breadcrumbs = [
            ['name' => 'Home', 'url' => route('home')],
            ['name' => 'Settings', 'url' => route('settings')]
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
                        <a class="nav-link" data-bs-toggle="tab" href="#tab-accounts" role="tab">
                            <i class="bx bx-user-circle"></i> Accounts
                        </a>
                    </li>
                <li class="nav-item">
                        <a class="nav-link active" data-bs-toggle="tab" href="#tab-embassy" role="tab">
                            <i class="bx bx-building-house"></i> Mission
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-bs-toggle="tab" href="#tab-countries" role="tab">
                            <i class="bx bx-globe"></i> Countries
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-bs-toggle="tab" href="#tab-service-provider" role="tab">
                            <i class="bx bx-briefcase"></i> Service Providers
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-bs-toggle="tab" href="#tab-services" role="tab">
                            <i class="bx bx-cog"></i> Services
                        </a>
                    </li>

                </ul>
            </div>

            <div class="card-body px-4 bg-white">
                <div class="tab-content">
                    <!-- Accounts -->
                    <div class="tab-pane fade" id="tab-accounts" role="tabpanel" wire:ignore.self>

                        @livewire('accounts-table')
                    </div>

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
        $('a[data-bs-toggle="tab"]').on('shown.bs.tab', function(e) {
            localStorage.setItem('lastAuthTab', $(this).attr('href'));
        });

        var lastTab = @json(session('active_tab')) || localStorage.getItem('lastAuthTab');
        if (lastTab) {
            $('a[data-bs-toggle="tab"][href="' + lastTab + '"]').tab('show');

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

                    let modalClass = lastTab.replace('#tab-', '') + '-modal';
                    let modalSelector = '.' + modalClass;
                    const modalEl = document.querySelector(modalSelector);
                    if (modalEl) {
                        const modal = new bootstrap.Modal(modalEl);
                        modal.show();
                    }
                });
            @endif
        }
    });
</script>
@endsection

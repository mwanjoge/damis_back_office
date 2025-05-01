@extends('layouts.master')
@section('content')
    <div class="row">
        <div class="col-xxl-9">
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

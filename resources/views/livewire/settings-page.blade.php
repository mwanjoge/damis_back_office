@extends('layouts.master')
@section('title')
    @lang('translation.settings')
@endsection
@section('content')
    <div class="row">
        <div class="col-xxl-9">
            <div class="card mt-xxl-n5">
                <div class="card-header">
                    <ul class="nav nav-tabs-custom rounded card-header-tabs border-bottom-0" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" data-bs-toggle="tab" href="#countries" role="tab">
                                <i class="fas fa-home"></i>
                                Countries
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-bs-toggle="tab" href="#embassy" role="tab">
                                <i class="far fa-user"></i>
                                Mission
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-bs-toggle="tab" href="#service-provider" role="tab">
                                <i class="far fa-user"></i>
                                Service Providers
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-bs-toggle="tab" href="#services" role="tab">
                                <i class="far fa-user"></i>
                                Services
                            </a>
                        </li>
                    </ul>
                </div>
            </div>

            <div class="card-body p-4" style="background-color: white">
                <div class="tab-content">
                    <div class="tab-pane active" id="countries" role="tabpanel">
                        {{-- <div class="justify-content-end text-end row">
                            <button type="button" class="btn btn-primary waves-effect waves-light">New Country</button>                                  
                        </div> --}}
                        
                        <div class="table-responsive table-card">
                            <table class="table table-borderless table-centered align-middle table-nowrap mb-0">
                                <thead class="text-muted table-light">
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">Countries</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>1</td> 
                                        <td>Uganda</td>                         
                                    </tr>
                                    <tr>
                                        <td>2</td> 
                                        <td>Kenya</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>    
                    </div>
                    <!--end tab-pane-->
                    <div class="tab-pane" id="embassy" role="tabpanel">
                        <div class="table-responsive table-card">
                            <table class="table table-borderless table-centered align-middle table-nowrap mb-0">
                                <thead class="text-muted table-light">
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">Mission</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>1</td> 
                                        <td>Uganda Embassy</td>                         
                                    </tr>
                                    <tr>
                                        <td>2</td> 
                                        <td>Kenya Embassy</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <div class="tab-pane" id="service-provider" role="tabpanel">
                        <div class="table-responsive table-card">
                            <table class="table table-borderless table-centered align-middle table-nowrap mb-0">
                                <thead class="text-muted table-light">
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">Service Provider</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>1</td> 
                                        <td>NECTA</td>                         
                                    </tr>
                                    <tr>
                                        <td>2</td> 
                                        <td>RITA</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <div class="tab-pane" id="services" role="tabpanel">
                        <div class="table-responsive table-card">
                            <table class="table table-borderless table-centered align-middle table-nowrap mb-0">
                                <thead class="text-muted table-light">
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">Service Provider</th>
                                        <th scope="col">Service</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>1</td> 
                                        <td>NECTA</td> 
                                        <td>Academic certificate verification</td>                        
                                    </tr>
                                    <tr>
                                        <td>2</td> 
                                        <td>RITA</td>
                                        <td>Birth certificate verification</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endsection
    @section('script')
        <script src="{{ URL::asset('build/js/pages/profile-setting.init.js') }}"></script>
        <script src="{{ URL::asset('build/js/app.js') }}"></script>
    @endsection
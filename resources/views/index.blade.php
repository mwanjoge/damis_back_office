@extends('layouts.master')
@section('title')
    @lang('translation.dashboards')
@endsection
@section('css')
    <link href="{{ URL::asset('build/libs/jsvectormap/jsvectormap.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ URL::asset('build/libs/swiper/swiper-bundle.min.css') }}" rel="stylesheet" type="text/css" />
@endsection
@section('content')
    <div class="row">
        <div class="col">
            <div class="h-100">
                <div class="row mb-3 pb-1">
                    <div class="col-12">
                        <div class="d-flex align-items-lg-center flex-lg-row flex-column">
                            <div class="flex-grow-1">
                                <h4 class="fs-16 mb-1">Hello, {{ Auth::user()->name }}</h4>
                            </div>
                            <div class="mt-3 mt-lg-0">
                                <form action="javascript:void(0);">
                                    <div class="row g-3 mb-0 align-items-center">
                                        <div class="col-sm-auto">
                                            <div class="input-group">
                                                <input type="text"
                                                    class="form-control border-0 fs-13 dash-filter-picker shadow"
                                                    data-provider="flatpickr" data-range-date="true"
                                                    data-date-format="d M, Y"
                                                    data-deafult-date="01 Jan 2022 to 31 Jan 2022">
                                                <div class="input-group-text bg-secondary border-secondary text-white">
                                                    <i class="ri-calendar-2-line"></i>
                                                </div>
                                            </div>
                                        </div>
                                        <!--end col-->
                                    </div>
                                    <!--end row-->
                                </form>
                            </div>
                        </div><!-- end card header -->
                    </div>
                    <!--end col-->
                </div>
                <!--end row-->

                <div class="row">
                    <div class="col-xl-3 col-md-6">
                        <!-- card -->
                        <div class="card card-animate h-100">
                            <div class="card-body">
                                <div class="d-flex align-items-center">
                                    <div class="flex-grow-1 overflow-hidden">
                                        <p class="text-uppercase fw-medium text-muted text-truncate mb-0">
                                            Total Earnings</p>
                                    </div>
                                </div>
                                <div class="d-flex align-items-end justify-content-between mt-4">
                                    <div>
                                        <h4 class="fs-22 fw-semibold ff-secondary mb-4">
                                            ${{ number_format($totalEarnings ?? 0) }}
                                        </h4>
                                        <a href="" class="text-decoration-underline text-muted">View net earnings</a>
                                    </div>
                                    <div class="avatar-sm flex-shrink-0">
                                        <span class="avatar-title bg-success-subtle rounded fs-3">
                                            <i class="bx bx-dollar-circle text-success"></i>
                                        </span>
                                    </div>
                                </div>
                            </div><!-- end card body -->
                        </div><!-- end card -->
                    </div><!-- end col -->

                    <div class="col-xl-3 col-md-6">
                        <!-- card -->
                        <div class="card card-animate h-100">
                            <div class="card-body">
                                <div class="d-flex align-items-center">
                                    <div class="flex-grow-1 overflow-hidden">
                                        <p class="text-uppercase fw-medium text-muted text-truncate mb-0">
                                            Applications</p>
                                    </div>
                                </div>
                                <div class="d-flex align-items-end justify-content-between mt-4">
                                    <div>
                                        <h4 class="fs-22 fw-semibold ff-secondary mb-4">
                                            {{ $applicationsCount }}
                                        </h4>
                                        <a href="" class="text-decoration-underline text-muted">View all applications</a>
                                    </div>
                                    <div class="avatar-sm flex-shrink-0">
                                        <span class="avatar-title bg-info-subtle rounded fs-3">
                                            <i class="bx bx-shopping-bag text-info"></i>
                                        </span>
                                    </div>
                                </div>
                            </div><!-- end card body -->
                        </div><!-- end card -->
                    </div><!-- end col -->

                    <div class="col-xl-3 col-md-6">
                        <!-- card -->
                        <div class="card card-animate h-100">
                            <div class="card-body">
                                <div class="d-flex align-items-center">
                                    <div class="flex-grow-1 overflow-hidden">
                                        <p class="text-uppercase fw-medium text-muted text-truncate mb-0">
                                            Customers</p>
                                    </div>
                                </div>
                                <div class="d-flex align-items-end justify-content-between mt-4">
                                    <div>
                                        <h4 class="fs-22 fw-semibold ff-secondary mb-4">
                                            {{ $customersCount }}
                                        </h4>
                                        <a href="" class="text-decoration-underline text-muted" style="font-style: none;">Total customers</a>
                                    </div>
                                    <div class="avatar-sm flex-shrink-0">
                                        <span class="avatar-title bg-warning-subtle rounded fs-3">
                                            <i class="bx bx-user-circle text-warning"></i>
                                        </span>
                                    </div>
                                </div>
                            </div><!-- end card body -->
                        </div><!-- end card -->
                    </div><!-- end col -->

                    <div class="col-xl-3 col-md-6">
                        <!-- card -->
                        <div class="card card-animate h-100">
                            <div class="card-body">
                                <div class="d-flex align-items-center">
                                    <div class="flex-grow-1 overflow-hidden">
                                        <p class="text-uppercase fw-medium text-muted text-truncate mb-0">
                                            NEW APPLICATIONS</p>
                                    </div>
                                </div>
                                <div class="d-flex align-items-end justify-content-between mt-4">
                                    <div>
                                        <h4 class="fs-22 fw-semibold ff-secondary mb-4">
                                            {{ $newApplicationsCount }}
                                        </h4>
                                        <a href="" class="text-decoration-underline text-muted">New Applications</a>
                                    </div>
                                    <div class="avatar-sm flex-shrink-0">
                                        <span class="avatar-title bg-primary-subtle rounded fs-3">
                                            <i class="bx bx-wallet text-primary"></i>
                                        </span>
                                    </div>
                                </div>
                            </div><!-- end card body -->
                        </div><!-- end card -->
                    </div><!-- end col -->
                </div> <!-- end row-->

                {{-- Donut and Recent Applications --}}
                <div class="row mb-4">
                    <div class="col-lg-4 mb-3">
                        <div class="card shadow h-100 d-flex flex-column justify-content-center align-items-center">
                            <div class="card-body w-100">
                                <h6 class="text-center">Yearly Distribution</h6>
                                <canvas id="dashboard-donut-chart" height="260"></canvas>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-8 mb-3">
                        <div class="card shadow h-100">
                            <div class="card-body">
                                <h6>Recent Applications</h6>
                                <table class="table table-bordered table-striped mb-0">
                                    <thead>
                                        <tr>
                                            <th>Member</th>
                                            <th>Service</th>
                                            <th>Date</th>
                                            <th>Status</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($recentApplications as $request)
                                            <tr>
                                                <td>{{ $request->member->name ?? 'N/A' }}</td>
                                                <td>{{ $request->items->first()->service->name ?? 'N/A' }}</td>
                                                <td>{{ $request->created_at->format('Y-m-d') }}</td>
                                                <td><span class="badge bg-primary">{{ $request->status }}</span></td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Qualitative Embassy Data --}}
                <div class="row mb-4">
                    <div class="col-12">
                        <div class="card shadow h-100">
                            <div class="card-body">
                                <h6>Top 5 Embassies (Qualitative Data)</h6>
                                <div class="table-responsive">
                                    <table class="table table-bordered table-striped mb-0">
                                        <thead>
                                            <tr>
                                                <th>Embassy</th>
                                                <th>Country Coverage</th>
                                                <th>Requests</th>
                                                <th>Top Service</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($countryCoverage->take(5) as $embassy)
                                                <tr>
                                                    <td>{{ $embassy->name }}</td>
                                                    <td>{{ $embassy->countries_count }}</td>
                                                    <td>
                                                        {{ $requestsPerEmbassy->firstWhere('embassy_id', $embassy->id)?->total ?? 0 }}
                                                    </td>
                                                    <td>
                                                        @php
                                                            $req = $requestsPerEmbassy->firstWhere('embassy_id', $embassy->id);
                                                            $service = null;
                                                            if ($req && $req->embassy && isset($req->embassy->services) && is_iterable($req->embassy->services) && count($req->embassy->services)) {
                                                                $service = $req->embassy->services->first()->name ?? null;
                                                            }
                                                        @endphp
                                                        {{ $service ?? 'N/A' }}
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>


                {{-- Charts Section --}}
                <div class="row mb-4">
                    <div class="col-lg-6 mb-3">
                        <div class="card shadow h-100">
                            <div class="card-body">
                                <h6>Requests per Embassy</h6>
                                <canvas id="requestsPerEmbassyChart" height="200"></canvas>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6 mb-3">
                        <div class="card shadow h-100">
                            <div class="card-body">
                                <h6>Monthly Requests</h6>
                                <canvas id="monthlyRequestsChart" height="200"></canvas>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row mb-4">
                    <div class="col-lg-6 mb-3">
                        <div class="card shadow h-100">
                            <div class="card-body">
                                <h6>Top Services</h6>
                                <canvas id="topServicesChart" height="200"></canvas>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6 mb-3">
                        <div class="card shadow h-100">
                            <div class="card-body">
                                <h6>Provider Activity</h6>
                                <canvas id="providerStatsChart" height="200"></canvas>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row mb-4">
                    <div class="col-md-12">
                        <div class="card shadow h-100">
                            <div class="card-body">
                                <h6>Embassy Country Coverage</h6>
                                <canvas id="countryCoverageChart" height="150"></canvas>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        // Donut chart for yearly totals (Service Providers, Requests, Services)
        var providersTotal = {{ array_sum($activeServiceProvidersData) }};
        var requestsTotal = {{ array_sum($activeRequestsData) }};
        var servicesTotal = {{ array_sum($activeServicesData) }};
        new Chart(document.getElementById('dashboard-donut-chart'), {
            type: 'doughnut',
            data: {
                labels: ['Service Providers', 'Requests', 'Services'],
                datasets: [{
                    data: [providersTotal, requestsTotal, servicesTotal],
                    backgroundColor: ['#405189', '#0ab39c', '#f7b84b'],
                }]
            },
            options: {
                plugins: {
                    legend: { position: 'bottom' }
                }
            }
        });

        // Requests per Embassy
        const embassyLabels = @json($requestsPerEmbassy->pluck('embassy.name'));
        const embassyData = @json($requestsPerEmbassy->pluck('total'));
        new Chart(document.getElementById('requestsPerEmbassyChart'), {
            type: 'bar',
            data: {
                labels: embassyLabels,
                datasets: [{
                    label: 'Requests',
                    data: embassyData,
                    backgroundColor: '#4e73df',
                }]
            }
        });

        // Monthly Requests
        new Chart(document.getElementById('monthlyRequestsChart'), {
            type: 'line',
            data: {
                labels: [@for($i=1;$i<=12;$i++) '{{ DateTime::createFromFormat("!m", $i)->format("M") }}', @endfor],
                datasets: [{
                    label: 'Requests',
                    data: @json(array_values($monthlyRequests->toArray())),
                    borderColor: '#1cc88a',
                    fill: false,
                }]
            }
        });

        // Top Requested Services
        const topServiceLabels = @json($topServices->pluck('service.name'));
        const topServiceData = @json($topServices->pluck('count'));
        new Chart(document.getElementById('topServicesChart'), {
            type: 'pie',
            data: {
                labels: topServiceLabels,
                datasets: [{
                    data: topServiceData,
                    backgroundColor: ['#36b9cc', '#f6c23e', '#e74a3b', '#1cc88a', '#4e73df'],
                }]
            }
        });

        // Service Provider Activity (by services count)
        const providerLabels = @json($providerStats->pluck('name'));
        const providerData = @json($providerStats->pluck('services_count'));
        new Chart(document.getElementById('providerStatsChart'), {
            type: 'bar',
            data: {
                labels: providerLabels,
                datasets: [{
                    label: 'Services Provided',
                    data: providerData,
                    backgroundColor: '#f6c23e',
                }]
            }
        });

        // Country Coverage
        const coverageLabels = @json($countryCoverage->pluck('name'));
        const coverageData = @json($countryCoverage->pluck('countries_count'));
        new Chart(document.getElementById('countryCoverageChart'), {
            type: 'doughnut',
            data: {
                labels: coverageLabels,
                datasets: [{
                    data: coverageData,
                    backgroundColor: ['#36b9cc', '#4e73df', '#1cc88a', '#e74a3b', '#f6c23e'],
                }]
            }
        });
    </script>
@endsection

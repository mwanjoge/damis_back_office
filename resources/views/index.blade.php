@extends('layouts.master')
@section('title')
    @lang('translation.dashboards')
@endsection
@section('css')
    <link href="{{ URL::asset('build/libs/jsvectormap/jsvectormap.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ URL::asset('build/libs/swiper/swiper-bundle.min.css') }}" rel="stylesheet" type="text/css" />
@endsection
@section('content')
    @php
        $months = collect(range(1,12))->map(function($m){ return DateTime::createFromFormat('!m', $m)->format('M'); });
        $embassyNames = $requestsPerEmbassy->pluck('embassy.name', 'embassy_id');
        $earningsData = [];
        $embassyCurrencies = [];
        foreach($countryCoverage as $embassy) {
            $currency = optional($embassy->countries->first())->currency ?? 'USD';
            $embassyCurrencies[$embassy->id] = $currency;
        }
        foreach($embassyNames as $embassyId => $embassyName) {
            $earningsData[$embassyName] = array_fill(1, 12, 0);
            foreach($embassyEarningsOverTime->where('embassy_id', $embassyId) as $row) {
                $earningsData[$embassyName][(int)$row->month] = (float)$row->earnings;
            }
        }
        // Build embassy earnings datasets with meta info for chart tooltips
        $embassyEarningsDatasets = [];
        foreach($requestsPerEmbassy as $embassy) {
            $embassyId = $embassy->embassy_id;
            $embassyName = $embassy->embassy->name ?? 'N/A';
            $currency = $embassy->embassy->countries->first()->currency ?? 'USD';
            $countryCoverage = $embassy->embassy->countries_count ?? ($embassy->embassy->countries ? $embassy->embassy->countries->count() : 0);
            $data = array_fill(1, 12, 0);
            foreach($embassyEarningsOverTime->where('embassy_id', $embassyId) as $row) {
                $data[(int)$row->month] = (float)$row->earnings;
            }
            $embassyEarningsDatasets[] = [
                'data' => array_values($data),
                'fill' => false,
                'currency' => $currency,
                'embassy_name' => $embassyName,
                'country_coverage' => $countryCoverage
            ];
        }
    @endphp
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

                <div class="row g-4 mb-4">
                    <div class="col-xl-3 col-md-6">
                        <!-- card -->
                        <div class="card card-animate h-100 shadow-sm">
                            <div class="card-body">
                                <div class="d-flex align-items-center">
                                    <div class="flex-grow-1 overflow-hidden">
                                        <p class="text-uppercase fw-medium text-muted text-truncate mb-1">
                                            Total Earnings
                                        </p>
                                    </div>
                                </div>
                                <div class="d-flex align-items-end justify-content-between mt-3">
                                    <div>
                                        <h4 class="fs-22 fw-bold ff-secondary mb-2">
                                            {{ number_format($totalEarnings ?? 0) }}
                                        </h4>
                                        <a href="" class="text-decoration-underline text-muted small">View net earnings</a>
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
                        <div class="card card-animate h-100 shadow-sm">
                            <div class="card-body">
                                <div class="d-flex align-items-center">
                                    <div class="flex-grow-1 overflow-hidden">
                                        <p class="text-uppercase fw-medium text-muted text-truncate mb-1">
                                            Applications</p>
                                    </div>
                                </div>
                                <div class="d-flex align-items-end justify-content-between mt-3">
                                    <div>
                                        <h4 class="fs-22 fw-bold ff-secondary mb-2">
                                            {{ $applicationsCount }}
                                        </h4>
                                        <a href="" class="text-decoration-underline text-muted small">View all applications</a>
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
                        <div class="card card-animate h-100 shadow-sm">
                            <div class="card-body">
                                <div class="d-flex align-items-center">
                                    <div class="flex-grow-1 overflow-hidden">
                                        <p class="text-uppercase fw-medium text-muted text-truncate mb-1">
                                            Customers</p>
                                    </div>
                                </div>
                                <div class="d-flex align-items-end justify-content-between mt-3">
                                    <div>
                                        <h4 class="fs-22 fw-bold ff-secondary mb-2">
                                            {{ $customersCount }}
                                        </h4>
                                        <a href="" class="text-decoration-underline text-muted small" style="font-style: none;">Total customers</a>
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
                        <div class="card card-animate h-100 shadow-sm">
                            <div class="card-body">
                                <div class="d-flex align-items-center">
                                    <div class="flex-grow-1 overflow-hidden">
                                        <p class="text-uppercase fw-medium text-muted text-truncate mb-1">
                                            NEW APPLICATIONS</p>
                                    </div>
                                </div>
                                <div class="d-flex align-items-end justify-content-between mt-3">
                                    <div>
                                        <h4 class="fs-22 fw-bold ff-secondary mb-2">
                                            {{ $newApplicationsCount }}
                                        </h4>
                                        <a href="" class="text-decoration-underline text-muted small">New Applications</a>
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
                <div class="row g-4 mb-4">
                    <div class="col-lg-4 mb-3 mb-lg-0">
                        <div class="card shadow h-100 d-flex flex-column justify-content-center align-items-center">
                            <div class="card-body w-100">
                                <h6 class="text-center mb-3">Yearly Distribution</h6>
                                <canvas id="dashboard-donut-chart" height="260"></canvas>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-8">
                        <div class="card shadow h-100">
                            <div class="card-body">
                                <h6 class="mb-3">Recent Applications</h6>
                                <table class="table table-bordered table-striped mb-0 align-middle">
                                    <thead class="table-light">
                                        <tr>
                                            <th class="text-nowrap">Member</th>
                                            <th class="text-nowrap">Service</th>
                                            <th class="text-nowrap">Date</th>
                                            <th class="text-nowrap">Status</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($recentApplications->where('status', 'Completed')->take(10) as $request)
                                            <tr>
                                                <td>{{ $request->member->name ?? 'N/A' }}</td>
                                                <td>{{ $request->requestItems->first()->service->name ?? 'N/A' }}</td>
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

                {{-- Charts Section --}}
                <div class="row g-4 mb-4">
                    <div class="col-lg-6">
                        <div class="card shadow h-100">
                            <div class="card-body">
                                <h6 class="mb-3">Requests per Embassy</h6>
                                <canvas id="requestsPerEmbassyChart" height="200"></canvas>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="card shadow h-100">
                            <div class="card-body">
                                <h6 class="mb-3">Monthly Requests</h6>
                                <canvas id="monthlyRequestsChart" height="200"></canvas>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row g-4 mb-4">
                    <div class="col-lg-6">
                        <div class="card shadow h-100">
                            <div class="card-body">
                                <h6 class="mb-3">Top Services</h6>
                                <canvas id="topServicesChart" height="200"></canvas>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="card shadow h-100">
                            <div class="card-body">
                                <h6 class="mb-3">Provider Activity</h6>
                                <canvas id="providerStatsChart" height="200"></canvas>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Embassy Earnings Over Time --}}
                <div class="row g-4 mb-4">
                    <div class="col-md-12">
                        <div class="card shadow h-100">
                            <div class="card-body">
                                <h6 class="mb-3">Embassy Earnings Over Time</h6>
                                <canvas id="embassyEarningsOverTimeChart" height="220"></canvas>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Qualitative Embassy Data --}}
                <div class="row mb-4">
                    <div class="col-12">
                        <div class="card shadow h-100">
                            <div class="card-body">
                                <h6 class="mb-3">Top 5 Embassies (Qualitative Data)</h6>
                                <div class="table-responsive">
                                    <table class="table table-bordered table-striped mb-0 align-middle">
                       
    <thead>
        <tr>
            <th>Embassy</th>
            <th>Country Coverage</th>
            <th>Requests</th>
            <th>Top Service</th>
            <th>Earnings</th>
        </tr>
    </thead>
    <tbody>
        @foreach($topEmbassies as $embassyRequest)
            @php $embassy = $embassyRequest->embassy; @endphp
            <tr>
                <td>{{ $embassy->name }}</td>
                <td>
                    @foreach($embassy->countries as $country)
                        {{ $country->name }}@if(!$loop->last), @endif
                    @endforeach
                </td>
                <td>{{ $embassy->total_requests }}</td>
                <td>{{ $embassy->top_service }}</td>
                <td>${{ number_format($embassy->total_earnings, 2) }}</td>
            </tr>
        @endforeach
    </tbody>

                                </div>
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
        const embassyData = @json($requestsPerEmbassy->pluck('count'));
        // Prepare embassy earnings and currency for tooltips
        const embassyEarnings = @json($requestsPerEmbassy->map(function($item) use ($embassyEarningsOverTime) {
            // Sum earnings for this embassy
            $earn = $embassyEarningsOverTime->where('embassy_id', $item->embassy_id)->sum('earnings');
            return $earn ? number_format($earn, 2) : '0.00';
        }));
        // If you have a currency field, map it here; otherwise, set a default
        const embassyCurrencies = @json($requestsPerEmbassy->map(function($item) {
            return $item->embassy->currency ?? 'USD';
        }));

        new Chart(document.getElementById('requestsPerEmbassyChart'), {
            type: 'bar',
            data: {
                labels: embassyLabels.map(() => ''), // Hide labels on axis
                datasets: [{
                    label: 'Requests',
                    data: embassyData,
                    backgroundColor: '#4e73df',
                }]
            },
            options: {
                plugins: {
                    tooltip: {
                        callbacks: {
                            title: function(context) {
                                // Show embassy name in tooltip
                                return embassyLabels[context[0].dataIndex] || '';
                            },
                            afterBody: function(context) {
                                const idx = context[0].dataIndex;
                                const earning = embassyEarnings[idx] ?? '0.00';
                                const currency = embassyCurrencies[idx] ?? 'USD';
                                const requests = embassyData[idx] ?? 0;
                                return [
                                    `Requests: ${requests}`,
                                    `Earnings: ${earning} ${currency}`
                                ];
                            }
                        }
                    },
                    legend: { display: false }
                },
                scales: {
                    x: {
                        ticks: { display: false }
                    }
                }
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
        const topServiceLabels = @json($topServices->map(function($item) { return $item->service->name ?? 'N/A'; }));
        const topServiceData = @json($topServices->map(function($item) { return $item->count; }));
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

        // Embassy Earnings Over Time
        const embassyEarningsLabels = @json($months);
        const embassyEarningsDatasets = @json($embassyEarningsDatasets);
        new Chart(document.getElementById('embassyEarningsOverTimeChart'), {
            type: 'line',
            data: {
                labels: embassyEarningsLabels,
                datasets: embassyEarningsDatasets.map((ds, idx) => ({
                    ...ds,
                    borderColor: `hsl(${idx * 60}, 70%, 50%)`,
                    backgroundColor: `hsl(${idx * 60}, 70%, 80%)`,
                    label: ds.embassy_name,
                    country_coverage: ds.country_coverage
                }))
            },
            options: {
                plugins: {
                    legend: { display: false },
                    tooltip: {
                        callbacks: {
                            title: function(context) {
                                const embassyName = context[0].dataset.label;
                                const month = context[0].label;
                                return `${embassyName} - ${month}`;
                            },
                            label: function(context) {
                                const currency = context.dataset.currency || 'USD';
                                const earnings = context.parsed.y;
                                return `Earnings: ${earnings} ${currency}`;
                            },
                            afterLabel: function(context) {
                                const total = context.dataset.data.reduce((a,b)=>a+b,0);
                                const currency = context.dataset.currency || 'USD';
                                const countryCoverage = context.dataset.country_coverage || 0;
                                return [
                                    `Total: ${total} ${currency}`,
                                    `Country Coverage: ${countryCoverage}`
                                ];
                            }
                        }
                    }
                }
            }
        });
    </script>
<!-- apexcharts -->
    <script src="{{ URL::asset('build/libs/apexcharts/apexcharts.min.js') }}"></script>
    <script src="{{ URL::asset('build/libs/jsvectormap/jsvectormap.min.js') }}"></script>
    <script src="{{ URL::asset('build/libs/jsvectormap/maps/world-merc.js') }}"></script>
    <script src="{{ URL::asset('build/libs/swiper/swiper-bundle.min.js') }}"></script>
    <!-- dashboard init -->
    <script src="{{ URL::asset('build/js/pages/dashboard-ecommerce.init.js') }}"></script>
    <script src="{{ URL::asset('build/js/app.js') }}"></script>
@endsection

{{-- 
    PERFORMANCE NOTE:
    The largest share of request time is spent in "Application" (65.83%) and "Booting" (34.15%), with "View" rendering being negligible.
    This means your dashboard's performance bottleneck is in the backend logic (queries, data aggregation, service providers, etc.), not in the Blade view rendering.
    To improve dashboard speed:
    - Move heavy data aggregation to scheduled jobs or queue workers (pre-calculate and cache).
    - Use Cache::remember() for dashboard data, updating it periodically (every 5-10 minutes).
    - Optimize Eloquent queries and eager load relationships.
    - Only pass minimal, required data to the view.
    - See: https://laravel.com/docs/10.x/scheduling and https://laravel.com/docs/10.x/cache
--}}

@extends('layouts.tabler.app')
@section('title')
    @lang('Dashboard')
@endsection
@section('css')
    <link href="{{ URL::asset('build/libs/jsvectormap/jsvectormap.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ URL::asset('build/libs/swiper/swiper-bundle.min.css') }}" rel="stylesheet" type="text/css" />
@endsection
@section('content')

    @php
    $breadcrumbs = [
        ['name' => 'Dashboard', 'url' => route('home')]
    ];
    @endphp

    {{-- @include('layouts.breadcrumb') --}}

    @php
        $months = collect(range(1, 12))->map(function ($m) {
            return DateTime::createFromFormat('!m', $m)->format('M'); });
        $embassyNames = $requestsPerEmbassy ?? collect([]);
        $embassyNames = $embassyNames->pluck('embassy.name', 'embassy_id');
        $earningsData = [];
        $embassyCurrencies = [];
        $embassyEarningsOverTime = $embassyEarningsOverTime ?? collect([]);
      
        foreach ($embassyNames as $embassyId => $embassyName) {
            $earningsData[$embassyName] = array_fill(1, 12, 0);
            foreach ($embassyEarningsOverTime->where('embassy_id', $embassyId) as $row) {
                $earningsData[$embassyName][(int) $row->month] = (float) $row->earnings;
            }
        }
        // Build embassy earnings datasets with meta info for chart tooltips

    $embassyEarningsDatasets = [];
    foreach ($requestsPerEmbassy as $embassy) {
        $embassyId = $embassy->embassy_id;

        $embassyObj = $embassy->embassy;

        // Defensive checks with null safe operator (PHP 8+)
        $embassyName = $embassyObj?->name ?? 'N/A';
        $currency = $embassyObj?->countries?->first()?->currency ?? 'USD';
        $countryCount = $embassyObj?->countries_count ?? ($embassyObj?->countries ? $embassyObj->countries->count() : 0);

        $data = array_fill(1, 12, 0);
        foreach ($embassyEarningsOverTime->where('embassy_id', $embassyId) as $row) {
            $data[(int) $row->month] = (float) $row->earnings;
        }

        $embassyEarningsDatasets[] = [
            'data' => array_values($data),
            'fill' => false,
            'currency' => $currency,
            'embassy_name' => $embassyName,
            // you can add other fields as needed
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
                                <h4 class="fs-16 mb-1">Hello {{ Auth::user()->name }}</h4>
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
                                        <a href="" class="text-decoration-underline text-muted small">View net
                                            earnings</a>
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
                                        <a href="" class="text-decoration-underline text-muted small">View all
                                            applications</a>
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
                                        <a href="" class="text-decoration-underline text-muted small"
                                            style="font-style: normal;">Total customers</a>
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
                                        <a href="" class="text-decoration-underline text-muted small">New
                                            Applications</a>
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
                                <h6 class="text-center mb-3"></h6>
                                <canvas id="earningsByCurrencyChart" height="260"></canvas>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-8">
                        <div class="card">
                            <div class="card-header">
                                <h5 class="card-title mb-0">Recent Applications</h5>
                            </div>
                            <div class="card-body">
                                <table id="alternative-pagination"
                                    class="table nowrap dt-responsive align-middle table-hover table-bordered"
                                    style="width:100%">
                                    <thead>
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
                                <h6 class="mb-3">Top Services by Earnings</h6>
                                <canvas id="topServicesChart" height="200"></canvas>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="card shadow h-100">
                            <div class="card-body">
                                <h6 class="mb-3">Provider Activity</h6>
                                <canvas id="providerEarningsChart" height="200"></canvas>
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
                        <div class="card">
                            <div class="card-header">
                                <h5 class="card-title mb-0">Top 5 Highest Earning Embassies</h5>
                            </div>
                            <div class="card-body">
                                <table id="alternative-pagination"
                                    class="table nowrap dt-responsive align-middle table-hover table-bordered"
                                    style="width:100%">
                                    <thead>
                                        <tr>
                                            <th>Embassy</th>
                                            <th>Country Covered</th>
                                            <th>Top Service</th>
                                            <th>Earnings</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($topEmbassies as $embassy)
                                            <tr>
                                                <td>{{ $embassy->name }}</td>
                                                <td>{{ $embassy->countries ?? '-' }}</td>
                                                <td>{{ $embassy->top_service ?? 0 }}</td>
                                                <td>{{ number_format($embassy->total_earnings ?? 0, 2) }}</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>

                    </div>
                </div>

                {{-- Qualitative Request Data --}}
                {{-- Removed Top 5 Highest Earning Requests table as requested --}}


            </div>
        </div>
    </div>

@endsection

@section('script')
<script src="path/to/chartjs/dist/chart.umd.js"></script>

<script>
document.addEventListener('DOMContentLoaded', function () {

    new Chart(document.getElementById('earningsByCurrencyChart'), {
        type: 'doughnut',
        data: {
            labels: {!! json_encode(array_keys($statistics['earnings_by_currency'] ?? [])) !!},
            datasets: [{
                data: {!! json_encode(array_values($statistics['earnings_by_currency'] ?? [])) !!},
                backgroundColor: ['#3b76e1', '#63ad6f', '#eebf31', '#f06548', '#6f42c1'],
                borderWidth: 1
            }]
        },
        options: {
            maintainAspectRatio: false,
            plugins: {
                tooltip: { enabled: true },
                legend: { display: false }
            }
        }
    });

    new Chart(document.getElementById('requestsPerEmbassyChart'), {
        type: 'bar',
        data: {
            labels: {!! json_encode(array_keys($statistics['requests_per_embassy'] ?? [])) !!},
            datasets: [{
                data: {!! json_encode(array_values($statistics['requests_per_embassy'] ?? [])) !!},
                backgroundColor: '#3b76e1'
            }]
        },
        options: {
            maintainAspectRatio: false,
            plugins: {
                tooltip: { enabled: true },
                legend: { display: false }
            },
            scales: {
                x: { ticks: { display: false }, grid: { display: false } },
                y: { beginAtZero: true, ticks: { display: false }, grid: { display: false } }
            }
        }
    });


    new Chart(document.getElementById('monthlyRequestsChart'), {
        type: 'line',
        data: {
            labels: {!! json_encode(array_keys($statistics['monthly_requests'] ?? [])) !!},
            datasets: [{
                data: {!! json_encode(array_values($statistics['monthly_requests'] ?? [])) !!},
                borderColor: '#63ad6f',
                fill: false,
                tension: 0.3
            }]
        },
        options: {
            maintainAspectRatio: false,
            plugins: {
                tooltip: { enabled: true },
                legend: { display: false }
            },
            scales: {
                x: { ticks: { display: false }, grid: { display: false } },
                y: { beginAtZero: true, ticks: { display: false }, grid: { display: false } }
            }
        }
    });

    new Chart(document.getElementById('topServicesChart'), {
        type: 'bar',
        data: {
            labels: {!! json_encode(array_keys($statistics['top_services_by_earnings'] ?? [])) !!},
            datasets: [{
                data: {!! json_encode(array_values($statistics['top_services_by_earnings'] ?? [])) !!},
                backgroundColor: '#f06548'
            }]
        },
        options: {
            maintainAspectRatio: false,
            indexAxis: 'y',
            plugins: {
                tooltip: { enabled: true },
                legend: { display: false }
            },
            scales: {
                x: { beginAtZero: true, ticks: { display: false }, grid: { display: false } },
                y: { ticks: { display: false }, grid: { display: false } }
            }
        }
    });
    // Top Services by Request Count chart removed as requested

    // Provider Activity - Stacked Chart (see below)
    new Chart(document.getElementById('embassyEarningsOverTimeChart'), {
        type: 'line',
        data: {
            labels: {!! json_encode(array_keys($statistics['embassy_earnings_over_time'] ?? [])) !!},
            datasets: [{
                data: {!! json_encode(array_values($statistics['embassy_earnings_over_time'] ?? [])) !!},
                borderColor: '#eebf31',
                fill: false,
                tension: 0.4
            }]
        },
        options: {
            maintainAspectRatio: false,
            plugins: {
                tooltip: { enabled: true },
                legend: { display: false }
            },
            scales: {
                x: { ticks: { display: false }, grid: { display: false } },
                y: { beginAtZero: true, ticks: { display: false }, grid: { display: false } }
            }
        }
    });
    new Chart(document.getElementById('providerEarningsChart'), {
        type: 'bar',
        data: {
            labels: {!! json_encode(array_keys($statistics['provider_earnings'] ?? [])) !!},
            datasets: [{
                data: {!! json_encode(array_values($statistics['provider_earnings'] ?? [])) !!},
                backgroundColor: '#6f42c1'
            }]
        },
        options: {
            maintainAspectRatio: false,
            plugins: {
                tooltip: { enabled: true },
                legend: { display: false }
            },
            scales: {
                x: { ticks: { display: false }, grid: { display: false } },
                y: { beginAtZero: true, ticks: { display: false }, grid: { display: false } }
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
The largest share of request time is spent in "Application" (65.83%) and "Booting" (34.15%), with "View" rendering being
negligible.
This means your dashboard's performance bottleneck is in the backend logic (queries, data aggregation, service
providers, etc.), not in the Blade view rendering.
To improve dashboard speed:
- Move heavy data aggregation to scheduled jobs or queue workers (pre-calculate and cache).
- Use Cache::remember() for dashboard data, updating it periodically (every 5-10 minutes).
- Optimize Eloquent queries and eager load relationships.
- Only pass minimal, required data to the view.
- See: https://laravel.com/docs/10.x/scheduling and https://laravel.com/docs/10.x/cache
--}}

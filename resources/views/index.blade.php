@extends('layouts.tabler.app')
@section('title')
    @lang('Dashboard')
@endsection
@section('content')
    @php
    $breadcrumbs = [
        ['name' => 'Dashboard', 'url' => route('home')]
    ];
    @endphp

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
{{--                            <div class="mt-3 mt-lg-0">--}}
{{--                                <form action="javascript:void(0);">--}}
{{--                                    <div class="row g-3 mb-0 align-items-center">--}}
{{--                                        <div class="col-sm-auto">--}}
{{--                                            <div class="input-group">--}}
{{--                                                <input type="text"--}}
{{--                                                    class="form-control border-0 fs-13 dash-filter-picker shadow"--}}
{{--                                                    data-provider="flatpickr" data-range-date="true"--}}
{{--                                                    data-date-format="d M, Y"--}}
{{--                                                    data-deafult-date="01 Jan 2022 to 31 Jan 2022">--}}
{{--                                                <div class="input-group-text bg-secondary border-secondary text-white">--}}
{{--                                                    <i class="ri-calendar-2-line"></i>--}}
{{--                                                </div>--}}
{{--                                            </div>--}}
{{--                                        </div>--}}
{{--                                        <!--end col-->--}}
{{--                                    </div>--}}
{{--                                    <!--end row-->--}}
{{--                                </form>--}}
                        </div><!-- end card header -->
                    </div>
                    <!--end col-->
                </div>
                <!--end row-->

                <div class="row g-3 mb-4">
                    <div class="col-xl-3 col-md-6">
                        <!-- card -->
                        <div class="card h-100">
                            <div class="card-body">
                                <div class="d-flex align-items-center">
                                    <div class="flex-grow-1 overflow-hidden">
                                        <h3 class="mb-1">Total Earnings</h3>
                                    </div>
                                    <div class="avatar bg-success-lt">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-coin" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                            <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                            <path d="M12 12m-9 0a9 9 0 1 0 18 0a9 9 0 1 0 -18 0"></path>
                                            <path d="M14.8 9a2 2 0 0 0 -1.8 -1h-2a2 2 0 1 0 0 4h2a2 2 0 1 1 0 4h-2a2 2 0 0 1 -1.8 -1"></path>
                                            <path d="M12 7v10"></path>
                                        </svg>
                                    </div>
                                </div>
                                <div class="d-flex align-items-baseline mt-3">
                                    <div class="h1 mb-0 me-2">{{ number_format($totalEarnings ?? 0) }}</div>
                                </div>
                                <div class="mt-2">
                                    <a href="" class="text-muted">View net earnings</a>
                                </div>
                            </div><!-- end card body -->
                        </div><!-- end card -->
                    </div><!-- end col -->

                    <div class="col-xl-3 col-md-6">
                        <!-- card -->
                        <div class="card h-100">
                            <div class="card-body">
                                <div class="d-flex align-items-center">
                                    <div class="flex-grow-1 overflow-hidden">
                                        <h3 class="mb-1">Applications</h3>
                                    </div>
                                    <div class="avatar bg-azure-lt">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-file-text" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                            <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                            <path d="M14 3v4a1 1 0 0 0 1 1h4"></path>
                                            <path d="M17 21h-10a2 2 0 0 1 -2 -2v-14a2 2 0 0 1 2 -2h7l5 5v11a2 2 0 0 1 -2 2z"></path>
                                            <path d="M9 9l1 0"></path>
                                            <path d="M9 13l6 0"></path>
                                            <path d="M9 17l6 0"></path>
                                        </svg>
                                    </div>
                                </div>
                                <div class="d-flex align-items-baseline mt-3">
                                    <div class="h1 mb-0 me-2">{{ $applicationsCount }}</div>
                                </div>
                                <div class="mt-2">
                                    <a href="" class="text-muted">View all applications</a>
                                </div>
                            </div><!-- end card body -->
                        </div><!-- end card -->
                    </div><!-- end col -->

                    <div class="col-xl-3 col-md-6">
                        <!-- card -->
                        <div class="card h-100">
                            <div class="card-body">
                                <div class="d-flex align-items-center">
                                    <div class="flex-grow-1 overflow-hidden">
                                        <h3 class="mb-1">Customers</h3>
                                    </div>
                                    <div class="avatar bg-yellow-lt">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-users" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                            <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                            <path d="M9 7m-4 0a4 4 0 1 0 8 0a4 4 0 1 0 -8 0"></path>
                                            <path d="M3 21v-2a4 4 0 0 1 4 -4h4a4 4 0 0 1 4 4v2"></path>
                                            <path d="M16 3.13a4 4 0 0 1 0 7.75"></path>
                                            <path d="M21 21v-2a4 4 0 0 0 -3 -3.85"></path>
                                        </svg>
                                    </div>
                                </div>
                                <div class="d-flex align-items-baseline mt-3">
                                    <div class="h1 mb-0 me-2">{{ $customersCount }}</div>
                                </div>
                                <div class="mt-2">
                                    <a href="" class="text-muted">Total customers</a>
                                </div>
                            </div><!-- end card body -->
                        </div><!-- end card -->
                    </div><!-- end col -->

                    <div class="col-xl-3 col-md-6">
                        <!-- card -->
                        <div class="card h-100">
                            <div class="card-body">
                                <div class="d-flex align-items-center">
                                    <div class="flex-grow-1 overflow-hidden">
                                        <h3 class="mb-1">New Applications</h3>
                                    </div>
                                    <div class="avatar bg-primary-lt">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-file-plus" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                            <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                            <path d="M14 3v4a1 1 0 0 0 1 1h4"></path>
                                            <path d="M17 21h-10a2 2 0 0 1 -2 -2v-14a2 2 0 0 1 2 -2h7l5 5v11a2 2 0 0 1 -2 2z"></path>
                                            <path d="M12 11l0 6"></path>
                                            <path d="M9 14l6 0"></path>
                                        </svg>
                                    </div>
                                </div>
                                <div class="d-flex align-items-baseline mt-3">
                                    <div class="h1 mb-0 me-2">{{ $newApplicationsCount }}</div>
                                </div>
                                <div class="mt-2">
                                    <a href="" class="text-muted">View new applications</a>
                                </div>
                            </div><!-- end card body -->
                        </div><!-- end card -->
                    </div><!-- end col -->
                </div> <!-- end row-->


                {{-- Additional Charts --}}
                <div class="row g-3 mb-4">
                    <div class="col-lg-6">
                        <div class="card h-100">
                            <div class="card-header">
                                <h3 class="card-title">Earnings per Embassy</h3>
                            </div>
                            <div class="card-body">
                                <div class="chart">
                                    <canvas id="earningsPerEmbassyChart" height="220"></canvas>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="card h-100">
                            <div class="card-header">
                                <h3 class="card-title">Monthly Requests</h3>
                            </div>
                            <div class="card-body">
                                <div class="chart">
                                    <canvas id="monthlyRequestsChart" height="220"></canvas>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row g-3 mb-4">
                    <div class="col-lg-6">
                        <div class="card h-100">
                            <div class="card-header">
                                <h3 class="card-title">Provider Earnings</h3>
                            </div>
                            <div class="card-body">
                                <div class="chart">
                                    <canvas id="providerEarningsChart" height="220"></canvas>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="card h-100">
                            <div class="card-header">
                                <h3 class="card-title">Earning by Currency</h3>
                            </div>
                            <div class="card-body d-flex flex-column justify-content-center">
                                <div class="chart">
                                    <canvas id="earningsByCurrencyChart" height="150"></canvas>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
                {{-- Dashboard Charts and Tables --}}
                <div class="row g-3 mb-4">
                    <div class="col-lg-6">
                        <!-- Requests by Status -->
                        <div class="card h-100">
                            <div class="card-header">
                                <h3 class="card-title">Requests by Status</h3>
                            </div>
                            <div class="card-body d-flex flex-column justify-content-center">
                                <div class="chart">
                                    <canvas id="requestsByStatusChart" height="150"></canvas>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <!-- Earnings by Currency (no label above) -->

                        <div class="card h-100">
                            <div class="card-header">
                                <h3 class="card-title">Top Services by Earnings</h3>
                            </div>
                            <div class="card-body">
                                <div class="chart">
                                    <canvas id="topServicesChart" height="220"></canvas>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row g-3 mb-4">
                    <div class="col-12">
                        <!-- Provider Earnings -->
                        <div class="card h-100">
                            <div class="card-header">
                                <h3 class="card-title">Embassy Earnings Over Time</h3>
                            </div>
                            <div class="card-body">
                                <div class="chart">
                                    <canvas id="embassyEarningsOverTimeChart" height="220"></canvas>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                {{-- Tables in one row --}}
                <div class="row g-3 mb-4">
                    <div class="col-12">
                        <div class="card h-100">
                            <div class="card-header">
                                <h3 class="card-title">Recent Applications</h3>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-vcenter card-table">
                                        <thead>
                                        <tr>
                                            <th>Applicant</th>
                                            <th>Service</th>
                                            <th>Date</th>
                                            <th>Status</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach ($recentApplications->where('status', 'Completed')->take(10) as $request)
                                            <tr>
                                                <td>{{ $request->member->name ?? 'N/A' }}</td>
                                                <td>{{ $request->requestItems->first()->service->name ?? 'N/A' }}</td>
                                                <td>{{ $request->created_at->format('Y-m-d') }}</td>
                                                <td>
                                                    <span class="badge bg-primary-subtle text-primary">{{ $request->status }}</span>
                                                </td>
                                            </tr>
                                        @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="card h-100">
                            <div class="card-header">
                                <h3 class="card-title">Top 5 Highest Earning Embassies</h3>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-vcenter card-table">
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
                                                <td>{{ $embassy['embassy_name'] ?? '-' }}</td>
                                                <td>{{ $embassy['countries_count'] ?? 0 }}</td>
                                                <td>{{ $embassy['service_name'] ?? '-' }}</td>
                                                <td>{{ number_format($embassy['total_earnings'] ?? 0, 2) }}</td>
                                            </tr>
                                        @endforeach
                                        </tbody>
                                    </table>
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
        <script>
            // Reusable function to generate random HSL colors
            function getRandomColors(count) {
                return Array.from({ length: count }, () =>
                    `hsl(${Math.floor(Math.random() * 360)}, 70%, 60%)`
                );
            }

            // Requests by Status (Pie Chart)
            const requestsByStatus = @json($requestsByStatus ?? []);
            const requestsByStatusEl = document.getElementById('requestsByStatusChart');
            if (requestsByStatusEl) {
                const colors = getRandomColors(Object.keys(requestsByStatus).length);
                new Chart(requestsByStatusEl, {
                    type: 'pie',
                    data: {
                        labels: Object.keys(requestsByStatus),
                        datasets: [{
                            data: Object.values(requestsByStatus),
                            backgroundColor: colors
                        }]
                    }
                });
            }

            // Earnings Per Embassy (Bar Chart)
            const earningsPerEmbassy = @json($requestsPerEmbassy ?? []);
            const earningsPerEmbassyEl = document.getElementById('earningsPerEmbassyChart');
            if (earningsPerEmbassyEl) {
                const colors = getRandomColors(earningsPerEmbassy.length);
                new Chart(earningsPerEmbassyEl, {
                    type: 'bar',
                    data: {
                        labels: earningsPerEmbassy.map(e => e.embassy_name ?? 'N/A'),
                        datasets: [{
                            data: earningsPerEmbassy.map(e => e.total_earnings),
                            backgroundColor: colors
                        }]
                    },
                    options: {
                        plugins: {
                            legend: { display: false },
                            tooltip: {
                                callbacks: {
                                    label: function(context) {
                                        return `Earnings: ${new Intl.NumberFormat('en-US', {
                                            style: 'currency',
                                            currency: 'USD'
                                        }).format(context.parsed.y)}`;
                                    }
                                }
                            }
                        },
                        scales: {
                            x: {
                                ticks: { display: false }
                            }
                        }
                    }
                });
            }

            // Monthly Requests (Line Chart)
            const monthlyRequests = @json($monthlyRequests ?? []);
            const monthlyRequestsEl = document.getElementById('monthlyRequestsChart');
            if (monthlyRequestsEl) {
                new Chart(monthlyRequestsEl, {
                    type: 'line',
                    data: {
                        labels: monthlyRequests.map(m => m.month),
                        datasets: [{
                            label: 'Requests',
                            data: monthlyRequests.map(m => m.request_count),
                            borderColor: getRandomColors(1)[0],
                            fill: false
                        }]
                    }
                });
            }

            // Top Services by Earnings (Bar Chart)
            const topServices = @json($topServices ?? []);
            const topServicesEl = document.getElementById('topServicesChart');
            if (topServicesEl) {
                const colors = getRandomColors(topServices.length);
                new Chart(topServicesEl, {
                    type: 'bar',
                    data: {
                        labels: topServices.map(s => s.service_name),
                        datasets: [{
                            label: 'Earnings',
                            data: topServices.map(s => s.total_earnings),
                            backgroundColor: colors
                        }]
                    },
                    options: {
                        plugins: {
                            legend: { display: false },
                            tooltip: {
                                callbacks: {
                                    title: context => context[0].label,
                                    label: context => `Earnings: ${new Intl.NumberFormat('en-US', {
                                        style: 'currency',
                                        currency: 'USD'
                                    }).format(context.parsed.y)}`
                                }
                            }
                        },
                        scales: {
                            x: { ticks: { display: false } }
                        }
                    }
                });
            }

            // Earnings by Currency (Doughnut Chart)
            const earningsByCurrency = @json($earningsByCurrency ?? []);
            const earningsByCurrencyEl = document.getElementById('earningsByCurrencyChart');
            if (earningsByCurrencyEl) {
                const colors = getRandomColors(Object.keys(earningsByCurrency).length);
                new Chart(earningsByCurrencyEl, {
                    type: 'doughnut',
                    data: {
                        labels: Object.keys(earningsByCurrency),
                        datasets: [{
                            data: Object.values(earningsByCurrency),
                            backgroundColor: colors
                        }]
                    },
                    options: {
                        plugins: {
                            legend: { display: false },
                            tooltip: {
                                callbacks: {
                                    label: function(context) {
                                        const label = context.label || '';
                                        const value = context.parsed;
                                        return `${label}: ${new Intl.NumberFormat('en-US', {
                                            style: 'currency',
                                            currency: label
                                        }).format(value)}`;
                                    }
                                }
                            }
                        }
                    }
                });
            }

            // Provider Earnings (Stacked Bar by Currency)
            const providerStats = @json($providerStats ?? []);
            const providerNames = providerStats.map(p => p.provider);
            const allCurrencies = Array.from(new Set(providerStats.flatMap(p => Object.keys(p.earnings))));
            const providerDatasets = allCurrencies.map((currency) => ({
                label: currency,
                data: providerStats.map(p => p.earnings[currency] || 0),
                backgroundColor: getRandomColors(1)[0],
                stack: 'Stack 0',
            }));
            const providerChartEl = document.getElementById('providerEarningsChart');
            if (providerChartEl) {
                if (window.Chart && Chart.getChart && Chart.getChart(providerChartEl)) Chart.getChart(providerChartEl).destroy();
                new Chart(providerChartEl, {
                    type: 'bar',
                    data: {
                        labels: providerNames,
                        datasets: providerDatasets
                    },
                    options: {
                        responsive: true,
                        interaction: {
                            mode: 'nearest',
                            intersect: false
                        },
                        plugins: {
                            tooltip: {
                                enabled: true,
                                callbacks: {
                                    label: function(context) {
                                        const currency = context.dataset.label;
                                        const value = context.parsed.y;
                                        return `${currency}: ${new Intl.NumberFormat('en-US', {
                                            style: 'currency',
                                            currency: currency
                                        }).format(value)}`;
                                    }
                                }
                            },
                            legend: { display: false },
                            title: { display: false }
                        },
                        scales: {
                            x: { stacked: true },
                            y: {
                                stacked: true,
                                beginAtZero: true,
                                title: { display: true, text: 'Earnings' }
                            }
                        }
                    }
                });
            }

            // Embassy Earnings Over Time (Line Chart)
            const embassyEarningsOverTime = @json($embassyEarningsOverTime ?? []);
            const embassyGroups = {};
            embassyEarningsOverTime.forEach(e => {
                if (!embassyGroups[e.embassy_name]) embassyGroups[e.embassy_name] = {};
                embassyGroups[e.embassy_name][e.month] = e.earnings;
            });
            const months = [...new Set(embassyEarningsOverTime.map(e => e.month))];
            const embassyDatasets = Object.keys(embassyGroups).map((embassy) => ({
                label: embassy,
                data: months.map(m => embassyGroups[embassy][m] || 0),
                borderColor: getRandomColors(1)[0],
                fill: false
            }));
            const embassyEarningsOverTimeEl = document.getElementById('embassyEarningsOverTimeChart');
            if (embassyEarningsOverTimeEl) {
                new Chart(embassyEarningsOverTimeEl, {
                    type: 'line',
                    data: {
                        labels: months,
                        datasets: embassyDatasets
                    },
                    options: {
                        plugins: {
                            legend: { display: false },
                            title: { display: false }
                        }
                    }
                });
            }
        </script>
@endsection

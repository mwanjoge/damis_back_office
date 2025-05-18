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

                {{-- Donut and Recent Applications --}}
                <div class="row g-3 mb-4">
                    <div class="col-lg-4 mb-3 mb-lg-0">
                        <div class="card h-100">
                            <div class="card-header">
                                <h3 class="card-title">Earnings by Currency</h3>
                            </div>
                            <div class="card-body d-flex flex-column justify-content-center">
                                <div class="chart-lg">
                                    <canvas id="earningsByCurrencyChart" height="260"></canvas>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-8">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Recent Applications</h3>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-vcenter card-table">
                                        <thead>
                                            <tr>
                                                <th>Member</th>
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
                                                    <td><span class="badge bg-primary">{{ $request->status }}</span></td>
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
                <div class="row g-3 mb-4">
                    <div class="col-lg-6">
                        <div class="card h-100">
                            <div class="card-header">
                                <h3 class="card-title">Requests per Embassy</h3>
                            </div>
                            <div class="card-body">
                                <div class="chart">
                                    <canvas id="requestsPerEmbassyChart" height="200"></canvas>
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
                                    <canvas id="monthlyRequestsChart" height="200"></canvas>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row g-3 mb-4">
                    <div class="col-lg-6">
                        <div class="card h-100">
                            <div class="card-header">
                                <h3 class="card-title">Top Services by Earnings</h3>
                            </div>
                            <div class="card-body">
                                <div class="chart">
                                    <canvas id="topServicesChart" height="200"></canvas>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="card h-100">
                            <div class="card-header">
                                <h3 class="card-title">Provider Activity</h3>
                            </div>
                            <div class="card-body">
                                <div class="chart">
                                    <canvas id="providerEarningsChart" height="200"></canvas>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Embassy Earnings Over Time --}}
                <div class="row g-3 mb-4">
                    <div class="col-md-12">
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

                {{-- Qualitative Embassy Data --}}
                <div class="row g-3 mb-4">
                    <div class="col-12">
                        <div class="card">
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
                </div>

                {{-- Qualitative Request Data --}}
                {{-- Removed Top 5 Highest Earning Requests table as requested --}}


            </div>
        </div>
    </div>

@endsection

@section('script')
<!-- Chart.js is already included in the main layout -->

<script>
    // Initialize charts for dashboard


    new Chart(document.getElementById('earningsByCurrencyChart'), {
        type: 'doughnut',
        data: {
            labels: {!! json_encode(array_keys($earningsByCurrency ?? [])) !!},
            datasets: [{
                data: {!! json_encode(array_values($earningsByCurrency ?? [])) !!},
                backgroundColor: ['#206bc4', '#4299e1', '#5eba00', '#fab005', '#ff922b', '#f66d9b'],
                borderWidth: 1
            }]
        },
        options: {
            maintainAspectRatio: false,
            cutout: '70%',
            plugins: {
                tooltip: {
                    enabled: true,
                    backgroundColor: 'rgba(0, 0, 0, 0.7)',
                    padding: 10,
                    cornerRadius: 3
                },
                legend: {
                    display: true,
                    position: 'bottom',
                    labels: {
                        usePointStyle: true,
                        padding: 15
                    }
                }
            }
        }
    });

    new Chart(document.getElementById('requestsPerEmbassyChart'), {
        type: 'bar',
        data: {
             datasets: [{
                data: {!! json_encode($requestsPerEmbassy->pluck('request_count')->toArray()) !!},
                backgroundColor: '#206bc4',
                borderRadius: 4,
                barPercentage: 0.5,
                categoryPercentage: 0.8
            }]
        },
        options: {
            maintainAspectRatio: false,
            plugins: {
                tooltip: {
                    enabled: true,
                    backgroundColor: 'rgba(0, 0, 0, 0.7)',
                    padding: 10,
                    cornerRadius: 3
                },
                legend: { display: false }
            },
            scales: {
                x: {
                    ticks: { display: true, color: '#9aa0ac', font: { size: 10 } },
                    grid: { display: false }
                },
                y: {
                    beginAtZero: true,
                    ticks: { display: true, color: '#9aa0ac', font: { size: 10 } },
                    grid: { color: 'rgba(154, 160, 172, 0.1)', drawBorder: false }
                }
            }
        }
    });


    new Chart(document.getElementById('monthlyRequestsChart'), {
        type: 'line',
        data: {
            labels: {!! json_encode(array_keys($monthlyRequests->toArray() ?? [])) !!},
            datasets: [{
                data: {!! json_encode(array_values($monthlyRequests->toArray() ?? [])) !!},
                borderColor: '#5eba00',
                backgroundColor: 'rgba(94, 186, 0, 0.1)',
                fill: true,
                tension: 0.4,
                borderWidth: 2,
                pointRadius: 3,
                pointBackgroundColor: '#5eba00',
                pointBorderColor: '#fff',
                pointBorderWidth: 2
            }]
        },
        options: {
            maintainAspectRatio: false,
            plugins: {
                tooltip: {
                    enabled: true,
                    backgroundColor: 'rgba(0, 0, 0, 0.7)',
                    padding: 10,
                    cornerRadius: 3
                },
                legend: { display: false }
            },
            scales: {
                x: {
                    ticks: { display: true, color: '#9aa0ac', font: { size: 10 } },
                    grid: { display: false }
                },
                y: {
                    beginAtZero: true,
                    ticks: { display: true, color: '#9aa0ac', font: { size: 10 } },
                    grid: { color: 'rgba(154, 160, 172, 0.1)', drawBorder: false }
                }
            }
        }
    });

    new Chart(document.getElementById('topServicesChart'), {
        type: 'bar',
        data: {
            labels: {!! json_encode(array_keys($topServices->toArray() ?? [])) !!},
            datasets: [{
                data: {!! json_encode(array_values($topServices->toArray() ?? [])) !!},
                backgroundColor: '#fab005',
                borderRadius: 4,
                barPercentage: 0.6,
                categoryPercentage: 0.8
            }]
        },
        options: {
            maintainAspectRatio: false,
            indexAxis: 'y',
            plugins: {
                tooltip: {
                    enabled: true,
                    backgroundColor: 'rgba(0, 0, 0, 0.7)',
                    padding: 10,
                    cornerRadius: 3
                },
                legend: { display: false }
            },
            scales: {
                x: {
                    beginAtZero: true,
                    ticks: { display: true, color: '#9aa0ac', font: { size: 10 } },
                    grid: { color: 'rgba(154, 160, 172, 0.1)', drawBorder: false }
                },
                y: {
                    ticks: { display: true, color: '#9aa0ac', font: { size: 10 } },
                    grid: { display: false }
                }
            }
        }
    });
    // Top Services by Request Count chart removed as requested

    // Provider Activity - Stacked Chart (see below)
    new Chart(document.getElementById('embassyEarningsOverTimeChart'), {
        type: 'line',
        data: {
            labels: {!! json_encode(array_keys($embassyEarningsOverTime->toArray() ?? [])) !!},
            datasets: [{
                data: {!! json_encode(array_values($embassyEarningsOverTime->toArray() ?? [])) !!},
                borderColor: '#4299e1',
                backgroundColor: 'rgba(66, 153, 225, 0.1)',
                fill: true,
                tension: 0.4,
                borderWidth: 2,
                pointRadius: 3,
                pointBackgroundColor: '#4299e1',
                pointBorderColor: '#fff',
                pointBorderWidth: 2
            }]
        },
        options: {
            maintainAspectRatio: false,
            plugins: {
                tooltip: {
                    enabled: true,
                    backgroundColor: 'rgba(0, 0, 0, 0.7)',
                    padding: 10,
                    cornerRadius: 3,
                    callbacks: {
                        label: function(context) {
                            let label = context.dataset.label || '';
                            if (label) {
                                label += ': ';
                            }
                            if (context.parsed.y !== null) {
                                label += new Intl.NumberFormat('en-US', {
                                    style: 'currency',
                                    currency: 'USD'
                                }).format(context.parsed.y);
                            }
                            return label;
                        }
                    }
                },
                legend: { display: false }
            },
            scales: {
                x: {
                    ticks: { display: true, color: '#9aa0ac', font: { size: 10 } },
                    grid: { display: false }
                },
                y: {
                    beginAtZero: true,
                    ticks: {
                        display: true,
                        color: '#9aa0ac',
                        font: { size: 10 },
                        callback: function(value) {
                            return new Intl.NumberFormat('en-US', {
                                style: 'currency',
                                currency: 'USD',
                                maximumSignificantDigits: 3
                            }).format(value);
                        }
                    },
                    grid: { color: 'rgba(154, 160, 172, 0.1)', drawBorder: false }
                }
            }
        }
    });
    new Chart(document.getElementById('providerEarningsChart'), {
        type: 'bar',
        data: {
            labels: {!! json_encode(collect($providerStats ?? [])->map(function($item) { return $item['provider'] ?? ''; })->toArray()) !!},
            datasets: [{
                data: {!! json_encode(collect($providerStats ?? [])->map(function($item) {
                    return array_sum($item['earnings'] ?? []);
                })->toArray()) !!},
                backgroundColor: '#f66d9b',
                borderRadius: 4,
                barPercentage: 0.5,
                categoryPercentage: 0.8
            }]
        },
        options: {
            maintainAspectRatio: false,
            plugins: {
                tooltip: {
                    enabled: true,
                    backgroundColor: 'rgba(0, 0, 0, 0.7)',
                    padding: 10,
                    cornerRadius: 3,
                    callbacks: {
                        label: function(context) {
                            let label = context.dataset.label || '';
                            if (label) {
                                label += ': ';
                            }
                            if (context.parsed.y !== null) {
                                label += new Intl.NumberFormat('en-US', {
                                    style: 'currency',
                                    currency: 'USD'
                                }).format(context.parsed.y);
                            }
                            return label;
                        }
                    }
                },
                legend: { display: false }
            },
            scales: {
                x: {
                    ticks: { display: true, color: '#9aa0ac', font: { size: 10 } },
                    grid: { display: false }
                },
                y: {
                    beginAtZero: true,
                    ticks: {
                        display: true,
                        color: '#9aa0ac',
                        font: { size: 10 },
                        callback: function(value) {
                            return new Intl.NumberFormat('en-US', {
                                style: 'currency',
                                currency: 'USD',
                                maximumSignificantDigits: 3
                            }).format(value);
                        }
                    },
                    grid: { color: 'rgba(154, 160, 172, 0.1)', drawBorder: false }
                }
            }
        }
    });

const ctx = document.getElementById('myChart');

  new Chart(ctx, {
    type: 'bar',
    data: {
      labels: {!! json_encode($topEmbassies->pluck('embassy_name')) !!},
      datasets: [{
        label: 'Total Earnings',
        data: {!! json_encode($topEmbassies->pluck('total_earnings')) !!},
        backgroundColor: '#206bc4',
        borderRadius: 4,
        barPercentage: 0.5,
        categoryPercentage: 0.8
      }]
    },
    options: {
      maintainAspectRatio: false,
      plugins: {
        tooltip: {
          enabled: true,
          backgroundColor: 'rgba(0, 0, 0, 0.7)',
          padding: 10,
          cornerRadius: 3,
          callbacks: {
            label: function(context) {
              let label = context.dataset.label || '';
              if (label) {
                label += ': ';
              }
              if (context.parsed.y !== null) {
                label += new Intl.NumberFormat('en-US', {
                  style: 'currency',
                  currency: 'USD'
                }).format(context.parsed.y);
              }
              return label;
            }
          }
        },
        legend: { display: false }
      },
      scales: {
        x: {
          ticks: { display: true, color: '#9aa0ac', font: { size: 10 } },
          grid: { display: false }
        },
        y: {
          beginAtZero: true,
          ticks: {
            display: true,
            color: '#9aa0ac',
            font: { size: 10 },
            callback: function(value) {
              return new Intl.NumberFormat('en-US', {
                style: 'currency',
                currency: 'USD',
                maximumSignificantDigits: 3
              }).format(value);
            }
          },
          grid: { color: 'rgba(154, 160, 172, 0.1)', drawBorder: false }
        }
      }
    }
  });

</script>

@endsection

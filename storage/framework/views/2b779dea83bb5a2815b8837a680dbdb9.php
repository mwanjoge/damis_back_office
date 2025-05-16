<?php $__env->startSection('title'); ?>
    <?php echo app('translator')->get('Dashboard'); ?>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('css'); ?>
     <link href="<?php echo e(URL::asset('build/libs/jsvectormap/jsvectormap.min.css')); ?>" rel="stylesheet" type="text/css" />
    <link href="<?php echo e(URL::asset('build/libs/swiper/swiper-bundle.min.css')); ?>" rel="stylesheet" type="text/css" />
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>

    <?php
        $months = collect(range(1, 12))->map(function ($m) {
            return DateTime::createFromFormat('!m', $m)->format('M'); });
        $embassyNames = $requestsPerEmbassy->pluck('embassy.name', 'embassy_id');
        $earningsData = [];
        $embassyCurrencies = [];
        foreach ($countryCoverage as $embassy) {
            $currency = optional($embassy->countries->first())->currency ?? 'USD';
            $embassyCurrencies[$embassy->id] = $currency;
        }
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
            $embassyName = $embassy->embassy->name ?? 'N/A';
            $currency = $embassy->embassy->countries->first()->currency ?? 'USD';
            $countryCoverage =
                $embassy->embassy->countries_count ??
                ($embassy->embassy->countries ? $embassy->embassy->countries->count() : 0);
            $data = array_fill(1, 12, 0);
            foreach ($embassyEarningsOverTime->where('embassy_id', $embassyId) as $row) {
                $data[(int) $row->month] = (float) $row->earnings;
            }
            $embassyEarningsDatasets[] = [
                'data' => array_values($data),
                'fill' => false,
                'currency' => $currency,
                'embassy_name' => $embassyName,
                'country_coverage' => $countryCoverage,
            ];
        }
    ?>
    <div class="row">
        <div class="col">
            <div class="h-100">
                <div class="row mb-3 pb-1">
                    <div class="col-12">
                        <div class="d-flex align-items-lg-center flex-lg-row flex-column">
                            <div class="flex-grow-1">
                                <h4 class="fs-16 mb-1">Hello <?php echo e(Auth::user()->name); ?></h4>
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
                                            <?php echo e(number_format($totalEarnings ?? 0)); ?>

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
                                            <?php echo e($applicationsCount); ?>

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
                                            <?php echo e($customersCount); ?>

                                        </h4>
                                        <a href="" class="text-decoration-underline text-muted small"
                                            style="font-style: none;">Total customers</a>
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
                                            <?php echo e($newApplicationsCount); ?>

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
                                        <?php $__currentLoopData = $recentApplications->where('status', 'Completed')->take(10); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $request): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <tr>
                                                <td><?php echo e($request->member->name ?? 'N/A'); ?></td>
                                                <td><?php echo e($request->requestItems->first()->service->name ?? 'N/A'); ?></td>
                                                <td><?php echo e($request->created_at->format('Y-m-d')); ?></td>
                                                <td><span class="badge bg-primary"><?php echo e($request->status); ?></span></td>
                                            </tr>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>

                
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
                                <canvas id="providerEarningsChart" height="200"></canvas>
                            </div>
                        </div>
                    </div>
                </div>

                
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
                                            <th>Top Service</th>
                                            <th>Requests</th>
                                            <th>Earnings</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $__currentLoopData = $topEmbassies; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $embassy): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <tr>
                                                <td><?php echo e($embassy->name); ?></td>
                                                <td><?php echo e($embassy->top_service ?? '-'); ?></td>
                                                <td><?php echo e($embassy->total_requests ?? 0); ?></td>
                                                <td><?php echo e(number_format($embassy->total_earnings ?? 0, 2)); ?></td>
                                            </tr>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>

                    </div>
                </div>

                
                


            </div>
        </div>
    </div>
   
<?php $__env->stopSection(); ?>

<?php $__env->startSection('script'); ?>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
document.addEventListener('DOMContentLoaded', function () {

    // Earnings by Currency - Donut
    const earningsByCurrency = <?php echo json_encode($earningsByCurrency, 15, 512) ?>;
    const donutLabels = Object.keys(earningsByCurrency);
    const donutData = Object.values(earningsByCurrency);
    const donutColors = donutLabels.map(() => {
        const h = Math.floor(Math.random() * 360);
        return `hsl(${h}, 70%, 60%)`;
    });

    new Chart(document.getElementById('earningsByCurrencyChart').getContext('2d'), {
        type: 'doughnut',
        data: {
            labels: donutLabels,
            datasets: [{
                label: 'Earnings by Currency',
                data: donutData,
                backgroundColor: donutColors
            }]
        },
        options: {
            responsive: true,
            plugins: {
                title: {
                    display: true,
                    text: 'Earnings by Currency'
                }
            }
        }
    });

    // Requests per Embassy - Bar
    const embassyLabels = <?php echo json_encode($requestsPerEmbassy->pluck('embassy.name'), 15, 512) ?>;
    const embassyData = <?php echo json_encode($requestsPerEmbassy->pluck('count'), 15, 512) ?>;
    const embassyEarnings = <?php echo json_encode($requestsPerEmbassy->map(function($item) use ($embassyEarningsOverTime) {
        $earn = $embassyEarningsOverTime->where('embassy_id', $item->embassy_id)->sum('earnings');
        return $earn ? number_format($earn, 2) : '0.00';
    })) ?>;
    const embassyCurrencies = <?php echo json_encode($requestsPerEmbassy->map(function($item) {
        return $item->embassy->currency ?? 'USD';
    }), 15, 512) ?>;

    new Chart(document.getElementById('requestsPerEmbassyChart'), {
        type: 'bar',
        data: {
            labels: embassyLabels.map(() => ''),
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
                        title: context => embassyLabels[context[0].dataIndex] || '',
                        afterBody: context => {
                            const idx = context[0].dataIndex;
                            return [
                                `Requests: ${embassyData[idx] ?? 0}`,
                                `Earnings: ${embassyEarnings[idx] ?? '0.00'} ${embassyCurrencies[idx] ?? 'USD'}`
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

    // Monthly Requests - Line
    new Chart(document.getElementById('monthlyRequestsChart'), {
        type: 'line',
        data: {
            labels: [<?php for($i=1;$i<=12;$i++): ?> '<?php echo e(DateTime::createFromFormat("!m", $i)->format("M")); ?>', <?php endfor; ?>],
            datasets: [{
                label: 'Requests',
                data: <?php echo json_encode(array_values($monthlyRequests->toArray()), 15, 512) ?>,
                borderColor: '#1cc88a',
                fill: false,
            }]
        }
    });

    // Top Services - Pie
    const topServiceLabels = <?php echo json_encode($topServices->map(fn($item) => $item->service->name ?? 'N/A'), 15, 512) ?>;
    const topServiceData = <?php echo json_encode($topServices->map(fn($item) => $item->count), 15, 512) ?>;
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

    // Provider Activity - Bar with Tooltip
    const providerLabels = <?php echo json_encode($providerStats->pluck('name'), 15, 512) ?>;
    const providerData = <?php echo json_encode($providerStats->pluck('services_count'), 15, 512) ?>;
    const providerEarnings = <?php echo json_encode($providerStats->pluck('earnings'), 15, 512) ?>;
    new Chart(document.getElementById('providerStatsChart'), {
        type: 'bar',
        data: {
            labels: providerLabels,
            datasets: [{
                label: 'Services Provided',
                data: providerData,
                backgroundColor: '#f6c23e',
            }]
        },
        options: {
            plugins: {
                tooltip: {
                    callbacks: {
                        title: ctx => providerLabels[ctx[0].dataIndex],
                        afterBody: ctx => {
                            const earnings = providerEarnings[ctx[0].dataIndex] ?? 0;
                            return [`Earnings: $${Number(earnings).toLocaleString(undefined, {minimumFractionDigits: 2, maximumFractionDigits: 2})}`];
                        }
                    }
                },
                legend: { display: false }
            }
        }
    });

    // Embassy Earnings Over Time - Line
    const embassyEarningsLabels = <?php echo json_encode($months, 15, 512) ?>;
    const embassyEarningsDatasets = <?php echo json_encode($embassyEarningsDatasets, 15, 512) ?>;
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
                        title: ctx => `${ctx[0].dataset.label} - ${ctx[0].label}`,
                        label: ctx => `Earnings: ${ctx.parsed.y} ${ctx.dataset.currency || 'USD'}`,
                        afterLabel: ctx => {
                            const total = ctx.dataset.data.reduce((a,b)=>a+b,0);
                            const currency = ctx.dataset.currency || 'USD';
                            const coverage = ctx.dataset.country_coverage || 0;
                            return [`Total: ${total} ${currency}`, `Country Coverage: ${coverage}`];
                        }
                    }
                }
            }
        }
    });

    // Provider Earnings - Stacked Chart
    const rawProviderStats = <?php echo json_encode($providerStats, 15, 512) ?>;
    const sortedStats = rawProviderStats.slice().sort((a, b) => {
        const sum = obj => Object.values(obj.earnings).reduce((a, b) => a + b, 0);
        return sum(b) - sum(a);
    });

    const providerNames = sortedStats.map(p => p.provider);
    const allCurrencies = Array.from(new Set(sortedStats.flatMap(p => Object.keys(p.earnings))));

    const colorMap = {};
    allCurrencies.forEach(currency => {
        colorMap[currency] = getRandomColor();
    });

    function buildDatasets(filterCurrency = 'all') {
        const currencies = filterCurrency === 'all' ? allCurrencies : [filterCurrency];
        return currencies.map(currency => ({
            label: currency,
            data: sortedStats.map(p => p.earnings[currency] ?? 0),
            stack: 'earnings',
            backgroundColor: colorMap[currency],
        }));
    }

    function getRandomColor() {
        const h = Math.floor(Math.random() * 360);
        return `hsl(${h}, 70%, 60%)`;
    }

    const ctx = document.getElementById('providerEarningsChart').getContext('2d');
    let chart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: providerNames,
            datasets: buildDatasets()
        },
        options: {
            responsive: true,
            plugins: {
                title: {
                    display: true,
                    text: 'Earnings per Provider by Currency'
                },
                tooltip: {
                    mode: 'index',
                    intersect: false,
                    callbacks: {
                        label: ctx => `${ctx.dataset.label}: ${ctx.raw.toLocaleString()}`
                    }
                }
            },
            scales: {
                x: { stacked: true },
                y: {
                    stacked: true,
                    beginAtZero: true,
                    title: {
                        display: true,
                        text: 'Earnings'
                    }
                }
            }
        }
    });

    // Currency Filter Dropdown
    const currencyFilter = document.getElementById('currencyFilter');
    if (currencyFilter) {
        allCurrencies.forEach(currency => {
            const opt = document.createElement('option');
            opt.value = currency;
            opt.textContent = currency;
            currencyFilter.appendChild(opt);
        });

        currencyFilter.addEventListener('change', function () {
            const selected = this.value;
            chart.data.datasets = buildDatasets(selected);
            chart.update();
        });
    }

});
</script>

<!-- apexcharts -->
    <script src="<?php echo e(URL::asset('build/libs/apexcharts/apexcharts.min.js')); ?>"></script>
    <script src="<?php echo e(URL::asset('build/libs/jsvectormap/jsvectormap.min.js')); ?>"></script>
    <script src="<?php echo e(URL::asset('build/libs/jsvectormap/maps/world-merc.js')); ?>"></script>
    <script src="<?php echo e(URL::asset('build/libs/swiper/swiper-bundle.min.js')); ?>"></script>
    <!-- dashboard init -->
    <script src="<?php echo e(URL::asset('build/js/pages/dashboard-ecommerce.init.js')); ?>"></script>
    <script src="<?php echo e(URL::asset('build/js/app.js')); ?>"></script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.tabler.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /Users/administrator/Herd/damis_back_office/resources/views/index.blade.php ENDPATH**/ ?>
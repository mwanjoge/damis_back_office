<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Cache;
use App\Models\Request;
use App\Models\Member;
use App\Models\ServiceProvider;
use App\Models\Service;
use App\Models\Embassy;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class CacheDashboardStatistics extends Command
{
    protected $signature = 'app:cache-dashboard-statistics';
    protected $description = 'Cache dashboard data for statistics display';


    /**
     * Create a new command instance.
     *
     * @return void
     */


    public function handle()
    {
        $totalEarnings = Request::where('status', 'Completed')
            ->where('type', 'Domestic')
            ->sum('total_cost');

        $applicationsCount = Request::count();
        $customersCount = Member::count();
        $newApplicationsCount = Request::whereDate('created_at', '>=', Carbon::now()->subDay())->count();



        $requestsPerEmbassy = Request::select('embassy_id')
            ->selectRaw('COUNT(*) as count')
            ->groupBy('embassy_id')
            ->with(['embassy.countries'])
            ->get();



// Get monthly request count and total earnings for all months
$monthlyRequests = collect();
for ($month = 1; $month <= 12; $month++) {
    $monthlyRequests[$month] = [
        'month' => $month,
        'request_count' => 0,
        'total_earnings' => 0
    ];
}

// Get actual data for months with requests
$monthlyData = Request::selectRaw('
        MONTH(created_at) as month,
        COUNT(*) as request_count,
        SUM(total_cost) as total_earnings
    ')
    ->whereYear('created_at', Carbon::now()->year)
    ->where('status', 'Completed') // Only completed requests
    ->groupBy(DB::raw('MONTH(created_at)'))
    ->orderBy('month')
    ->get();

// Merge actual data into the collection
foreach ($monthlyData as $data) {
    $monthlyRequests[$data->month] = [
        'month' => $data->month,
        'request_count' => $data->request_count,
        'total_earnings' => $data->total_earnings
    ];
}

            \Log::info('Top monthly: ', $monthlyRequests->toArray());


        $topEmbassies = Request::select(
            'embassy_id',
            DB::raw('COUNT(*) as total_requests'),
            DB::raw('SUM(total_cost) as earnings')
        )
            ->with(['embassy'])
            ->groupBy('embassy_id')
            ->having('earnings', '>', 0)
            ->orderByDesc('earnings')
            ->take(5)
            ->get()
            ->map(function ($row) {
                $embassy = $row->embassy;
                if ($embassy) {
                    $embassy->total_requests = $row->total_requests ?? 0;
                    $embassy->total_earnings = $row->earnings ?? 0;
                    $topService = \App\Models\RequestItem::whereHas('request', function ($q) use ($row) {
                        $q->where('embassy_id', $row->embassy_id);
                    })
                        ->select('service_id', DB::raw('COUNT(*) as count'))
                        ->groupBy('service_id')
                        ->orderByDesc('count')
                        ->first();

                    $embassy->top_service = $topService && $topService->service ? $topService->service->name : '-';
                    return $embassy;
                }
                return null;
            })->filter();

        $recentApplications = Request::with(['member', 'requestItems.service', 'embassy'])
            ->where('status', 'Completed')
            ->latest()
            ->take(10)
            ->get();

        $embassyEarningsOverTime = Request::selectRaw('embassy_id, MONTH(created_at) as month, SUM(total_cost) as earnings')
            ->where('status', 'Completed')
            ->groupBy('embassy_id', 'month')
            ->orderBy('embassy_id')
            ->orderBy('month')
            ->get()
            ->map(function ($row) {
                $embassy = Embassy::withCount('countries')->find($row->embassy_id);
                $row->country_coverage = $embassy ? $embassy->countries_count : 0;
                $row->embassy_name = $embassy ? $embassy->name : 'N/A';
                return $row;
            });

        $activeServiceProvidersData = [ServiceProvider::count()];
        $activeRequestsData = [Request::where('status', 'Completed')->count()];
        $activeServicesData = [Service::count()];

        // Compute provider stats
        $providers = ServiceProvider::with(['services.requestItems.request.country'])->get();

        $providerEarningsMatrix = [];
        $earningsByCurrency = [];

        foreach ($providers as $provider) {
            $earningsPerCurrency = [];

            foreach ($provider->services as $service) {
                foreach ($service->requestItems as $requestItem) {
                    $request = $requestItem->request;

                    if (!$request)
                        continue;

                    $currency = optional($request->country)->currency ?? 'USD';
                    $earningsPerCurrency[$currency] = ($earningsPerCurrency[$currency] ?? 0) + $request->total_cost;
                }
            }

            // Add to global currency totals
            foreach ($earningsPerCurrency as $currency => $amount) {
                $earningsByCurrency[$currency] = ($earningsByCurrency[$currency] ?? 0) + $amount;
            }

            $providerEarningsMatrix[] = [
                'provider' => $provider->name,
                'earnings' => $earningsPerCurrency
            ];
        }

        $countryCoverage = Embassy::withCount('countries')->with('countries')->get();

        // Calculate top services by earnings
        $topServices = \App\Models\Service::select(
            'services.id',
            'services.name',
            DB::raw('SUM(requests.total_cost) as total_earnings')
        )
        ->join('request_items', 'services.id', '=', 'request_items.service_id')
        ->join('requests', 'request_items.request_id', '=', 'requests.id')
        ->where('requests.status', 'Completed')
        ->groupBy('services.id', 'services.name')
        ->orderByDesc('total_earnings')
        ->take(5)
        ->get();
        \Log::info($topServices);
        Cache::put('dashboard_data', [
            'totalEarnings' => $totalEarnings,
            'applicationsCount' => $applicationsCount,
            'customersCount' => $customersCount,
            'newApplicationsCount' => $newApplicationsCount,
            'recentApplications' => $recentApplications,
            'activeServiceProvidersData' => $activeServiceProvidersData,
            'activeRequestsData' => $activeRequestsData,
            'activeServicesData' => $activeServicesData,
            'requestsPerEmbassy' => $requestsPerEmbassy,
            'monthlyRequests' => $monthlyRequests,
            'topServices' => $topServices,
            'topEmbassies' => $topEmbassies,
            'embassyEarningsOverTime' => $embassyEarningsOverTime,
            'providerStats' => $providerEarningsMatrix,
            'earningsByCurrency' => $earningsByCurrency,
            'countryCoverage' => $countryCoverage,
        ], now()->addMinutes(720));

        \Log::info('CacheDashboardStatistics ran and cached data.');
    }
}

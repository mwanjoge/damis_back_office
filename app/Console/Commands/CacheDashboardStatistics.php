<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Cache;
use App\Models\Request;
use App\Models\Member;
use App\Models\ServiceProvider;
use App\Models\Service;
use App\Models\Embassy;
use App\Models\GeneralLineItem;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class CacheDashboardStatistics extends Command
{
    protected $signature = 'app:cache-dashboard-statistics';
    protected $description = 'Cache dashboard data for statistics display';


    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $totalEarnings = Request::where('status', 'Completed')
            ->where('type', 'Domestic')
            ->sum('total_cost');

        $applicationsCount = Request::count();
        $customersCount = Member::count();
        $newApplicationsCount = Request::whereDate('created_at', '>=', Carbon::now()->subDay())->count();

        // 1. Top Services by Earnings
        $topServices = GeneralLineItem::selectRaw('services.name AS service_name, SUM(general_line_items.price) AS total_earnings, COUNT(request_items.id) AS request_count')
            ->join('services', 'general_line_items.service_id', '=', 'services.id')
            ->join('request_items', 'general_line_items.request_item_id', '=', 'request_items.id')
            ->groupBy('services.name')
            ->orderByDesc('total_earnings')
            ->limit(10)
            ->get();

        // 2. Monthly Requests (last 12 months)
        $monthlyRequests = Request::selectRaw("DATE_FORMAT(created_at, '%Y-%m') AS month, COUNT(id) AS request_count, SUM(total_cost) AS total_earnings")
            ->where('created_at', '>=', now()->subMonths(12))
            ->groupBy(DB::raw("DATE_FORMAT(created_at, '%Y-%m')"))
            ->orderBy('month')
            ->get();

        // 3. Requests per Embassy (fixed grouping)
        $requestsPerEmbassy = Request::selectRaw('embassies.id AS embassy_id, embassies.name AS embassy_name, COUNT(requests.id) AS request_count, SUM(requests.total_cost) AS total_earnings')
            ->join('embassies', 'requests.embassy_id', '=', 'embassies.id')
            ->groupBy('embassies.id', 'embassies.name')
            ->orderByDesc('total_earnings')
            ->get();

        // 4. Provider Activity
        $providerActivity = GeneralLineItem::selectRaw('service_providers.name AS provider_name, COUNT(general_line_items.id) AS service_count, SUM(general_line_items.price) AS total_earnings')
            ->join('services', 'general_line_items.service_id', '=', 'services.id')
            ->join('service_providers', 'services.service_provider_id', '=', 'service_providers.id')
            ->groupBy('service_providers.name')
            ->orderByDesc('service_count')
            ->get();

        // 5. Embassy Earnings Over Time (Last 6 Months)
        $embassyEarningsOverTime = Request::selectRaw("embassies.name AS embassy_name, DATE_FORMAT(requests.created_at, '%Y-%m') AS month, SUM(requests.total_cost) AS earnings")
            ->join('embassies', 'requests.embassy_id', '=', 'embassies.id')
            ->where('requests.created_at', '>=', now()->subMonths(6))
            ->groupBy('embassies.name', DB::raw("DATE_FORMAT(requests.created_at, '%Y-%m')"))
            ->orderBy('embassies.name')
            ->orderBy('month')
            ->get();

        // 6. Top 5 Highest Earning Embassies
        $topEmbassies = Request::selectRaw("
                embassies.name AS embassy_name,
                SUM(requests.total_cost) AS total_earnings,
                COUNT(requests.id) AS request_count,
                (SELECT COUNT(DISTINCT countries.id)
                 FROM countries
                 WHERE countries.embassy_id = embassies.id) AS countries_count,
                (SELECT services.name
                 FROM request_items
                 JOIN services ON request_items.service_id = services.id
                 WHERE request_items.request_id = requests.id
                 GROUP BY services.name
                 ORDER BY COUNT(*) DESC
                 LIMIT 1) AS service_name
            ")
            ->join('embassies', 'requests.embassy_id', '=', 'embassies.id')
                ->groupBy('embassies.id', 'embassies.name', 'requests.id')
                ->orderByDesc('total_earnings')
                ->limit(5)
                ->get();
        // 7. Recent Completed Applications
        $recentApplications = Request::with(['member', 'requestItems.service', 'embassy'])
            ->where('status', 'Completed')
            ->latest()
            ->take(10)
            ->get();

        // 8. Misc counts
        $activeServiceProvidersData = [ServiceProvider::count()];
        $activeRequestsData = [Request::where('status', 'Completed')->count()];
        $activeServicesData = [Service::count()];
// 9. Requests by Status
        $requestsByStatus = Request::select('status', DB::raw('COUNT(*) as count'))
            ->groupBy('status')
            ->pluck('count', 'status')
            ->toArray();

        // 10. Earnings by Currency (still valuable)
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

            foreach ($earningsPerCurrency as $currency => $amount) {
                $earningsByCurrency[$currency] = ($earningsByCurrency[$currency] ?? 0) + $amount;
            }

            $providerEarningsMatrix[] = [
                'provider' => $provider->name,
                'earnings' => $earningsPerCurrency
            ];
        }

        // Finally, cache everything into one key
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
            'requestsByStatus' => $requestsByStatus,
            'embassyEarningsOverTime' => $embassyEarningsOverTime,
            'providerStats' => $providerEarningsMatrix,
            'earningsByCurrency' => $earningsByCurrency,
            'providerActivity' => $providerActivity,
        ], now()->addMinutes(12720));

        Log::info('CacheDashboardStatistics ran and cached data.');
    }
}

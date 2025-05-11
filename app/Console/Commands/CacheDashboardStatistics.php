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
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:cache-dashboard-statistics';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        // Total Earnings: Only sum completed requests of domestic type
        $totalEarnings = Request::where('status', 'Completed')
            ->where('type', 'Domestic')
            ->sum('total_cost');
        $applicationsCount = Request::count();
        $customersCount = Member::count();
        $newApplicationsCount = Request::whereDate('created_at', '>=', Carbon::now()->subDay())->count();

        // Top Services (by number of requests)
        $topServices = \App\Models\RequestItem::select('service_id')
            ->selectRaw('COUNT(*) as count')
            ->groupBy('service_id')
            ->orderByDesc('count')
            ->with('service')
            ->take(5)
            ->get();
        \Log::info('Top Services:', $topServices->toArray());

        // Requests per Embassy
        $requestsPerEmbassy = Request::select('embassy_id')
            ->selectRaw('COUNT(*) as count')
            ->groupBy('embassy_id')
            ->with(['embassy.countries'])
            ->get();
        \Log::info('Requests per Embassy:', $requestsPerEmbassy->toArray());

        // Monthly Requests
        $monthlyRequests = Request::selectRaw('MONTH(created_at) as month, COUNT(*) as count')
            ->whereYear('created_at', Carbon::now()->year)
            ->groupBy('month')
            ->orderBy('month')
            ->pluck('count', 'month');
        \Log::info('Monthly Requests:', $monthlyRequests->toArray());

   
        // Top 5 Embassies with earnings, requests, and top service
        $topEmbassies = Request::select('embassy_id',
                DB::raw('COUNT(*) as total_requests'),
                DB::raw('SUM(total_cost) as earnings')
            )
            ->with(['embassy'])
            ->groupBy('embassy_id')
            ->having('earnings', '>', 0)
            ->orderByDesc('earnings')
            ->take(5)
            ->get()
            ->map(function($row) {
                $embassy = $row->embassy;
                if ($embassy) {
                    $embassy->total_requests = $row->total_requests ?? 0;
                    $embassy->total_earnings = $row->earnings ?? 0;
                    // Find top service for this embassy (by count in requests)
                    $topService = \App\Models\RequestItem::whereHas('request', function($q) use ($row) {
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
        \Log::info('Top 5 Embassies:', $topEmbassies->toArray());
        
      
        // Recent Applications (10 most recent)
        $recentApplications = Request::with(['member', 'requestItems.service', 'embassy'])
            ->where('status', 'Completed')
            ->latest()
            ->take(10)
            ->get();
        \Log::info('Recent Applications:', $recentApplications->toArray());

        // Embassy Earnings Over Time (sum of total_cost per embassy per month, with country coverage)
        $embassyEarningsOverTime = Request::selectRaw('embassy_id, MONTH(created_at) as month, SUM(total_cost) as earnings')
            ->where('status', 'Completed')
            ->groupBy('embassy_id', 'month')
            ->orderBy('embassy_id')
            ->orderBy('month')
            ->get()
            ->map(function($row) {
                $embassy = Embassy::withCount('countries')->find($row->embassy_id);
                $row->country_coverage = $embassy ? $embassy->countries_count : 0;
                $row->embassy_name = $embassy ? $embassy->name : 'N/A';
                return $row;
            });
        \Log::info('Embassy Earnings Over Time:', $embassyEarningsOverTime->toArray());

        // Active Service Providers
        $activeServiceProvidersData = [ServiceProvider::count()];
        // Active Requests (Completed)
        $activeRequestsData = [Request::where('status', 'Completed')->count()];
        // Active Services
        $activeServicesData = [Service::count()];
        // Provider Stats with earnings and currency for stacked bar chart
        $providerStats = ServiceProvider::withCount('services')
            ->get()
            ->map(function($provider) {
                // Calculate earnings for this provider
                $earnings = Request::whereHas('requestItems.service', function($q) use ($provider) {
                    $q->where('service_provider_id', $provider->id);
                })->sum('total_cost');
                $provider->earnings = $earnings;
                // Get provider's currency (assume from first service or default to USD)
                $provider->currency = $provider->services->first()->currency ?? 'USD';
                return $provider;
            });
        // Country Coverage: always a collection of Embassy models with countries_count and countries relation
        $countryCoverage = Embassy::withCount('countries')->with('countries')->get();

        // Store in cache for 5 minutes
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
            'providerStats' => $providerStats,
            'countryCoverage' => $countryCoverage,
        ], now()->addMinutes(720));
        \Log::info('CacheDashboardStatistics ran and cached data.');
         }
}

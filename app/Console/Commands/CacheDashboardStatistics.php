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
         // Aggregate dashboard data
         $totalEarnings = Request::where('status', 'Completed')->sum('total_cost');
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
             ->with('embassy')
             ->get();
         \Log::info('Requests per Embassy:', $requestsPerEmbassy->toArray());

         // Monthly Requests
         $monthlyRequests = Request::selectRaw('MONTH(created_at) as month, COUNT(*) as count')
             ->whereYear('created_at', Carbon::now()->year)
             ->groupBy('month')
             ->orderBy('month')
             ->pluck('count', 'month');
         \Log::info('Monthly Requests:', $monthlyRequests->toArray());

         // Top 5 Embassies (by number of requests)
         $topEmbassies = Request::select('embassy_id')
             ->selectRaw('COUNT(*) as count')
             ->groupBy('embassy_id')
             ->orderByDesc('count')
             ->with('embassy')
             ->take(5)
             ->get();
         \Log::info('Top Embassies:', $topEmbassies->toArray());

         // Recent Applications
         $recentApplications = Request::with(['member', 'items.service', 'embassy'])
             ->latest()
             ->take(5)
             ->get();
         \Log::info('Recent Applications:', $recentApplications->toArray());

         // Embassy Earnings Over Time (sum of total_cost per embassy per month)
         $embassyEarningsOverTime = Request::selectRaw('embassy_id, MONTH(created_at) as month, SUM(total_cost) as earnings')
             ->where('status', 'Completed')
             ->groupBy('embassy_id', 'month')
             ->orderBy('embassy_id')
             ->orderBy('month')
             ->get();
         \Log::info('Embassy Earnings Over Time:', $embassyEarningsOverTime->toArray());

         // Active Service Providers
         $activeServiceProvidersData = [ServiceProvider::count()];
         // Active Requests (Completed)
         $activeRequestsData = [Request::where('status', 'Completed')->count()];
         // Active Services
         $activeServicesData = [Service::count()];
         // Provider Stats
         $providerStats = ServiceProvider::withCount('services')->get();
         // Country Coverage
         $countryCoverage = Embassy::withCount('countries')->get();

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
         ], now()->addMinutes(5));
         \Log::info('CacheDashboardStatistics ran and cached data.');
    }
}

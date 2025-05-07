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
         $totalEarnings = \App\Models\Invoice::where('status', 'paid')->sum('amount');
         $applicationsCount = Request::count();
         $customersCount = Member::count();
         $newApplicationsCount = Request::whereDate('created_at', '>=', Carbon::now()->subDay())->count();
         $recentApplications = Request::with(['member', 'items.service'])->latest()->take(5)->get();
         $activeServiceProvidersData = [ServiceProvider::where('active', 1)->count()];
         $activeRequestsData = [Request::where('status', 'active')->count()];
         $activeServicesData = [Service::where('active', 1)->count()];
         $requestsPerEmbassy = Embassy::withCount('requests')->get();
         $monthlyRequests = Request::selectRaw('MONTH(created_at) as month, COUNT(*) as count')
             ->whereYear('created_at', Carbon::now()->year)
             ->groupBy('month')
             ->pluck('count', 'month');
         $topServices = Service::withCount('requests')->orderByDesc('requests_count')->take(5)->get();
         $providerStats = ServiceProvider::withCount('services')->get();
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
             'providerStats' => $providerStats,
             'countryCoverage' => $countryCoverage,
         ], now()->addMinutes(5));
    }
}

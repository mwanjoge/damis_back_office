<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Cache;
use App\Models\Request;
use App\Models\Member;
use App\Models\ServiceProvider;
use App\Models\Service;
use App\Models\Embassy;
use Carbon\Carbon;

class CacheDashboardData implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public function handle()
    {
        // Aggregate dashboard data
        $totalEarnings = Request::sum('total_amount');
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

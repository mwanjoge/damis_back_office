<?php

namespace App\Http\Controllers;

use App\Models\Embassy;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Session;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */


    protected $roles;
    protected $permissions;


    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    // public function index(Request $request)
    // {
    //     $data = \Cache::get('dashboard_data', [
    //         'totalEarnings' => 0,
    //         'applicationsCount' => 0,
    //         'customersCount' => 0,
    //         'newApplicationsCount' => 0,
    //         'recentApplications' => collect(),
    //         'activeServiceProvidersData' => [],
    //         'activeRequestsData' => [],
    //         'activeServicesData' => [],
    //         'requestsPerEmbassy' => collect(),
    //         'monthlyRequests' => collect(),
    //         'topServices' => collect(),
    //         'providerStats' => collect(),
    //         'countryCoverage' => collect(),
    //     ]);
    //     return view('index', $data);
    // }

    public function index()
    {
        $data = \Cache::get('dashboard_data', [
            'totalEarnings' => 0,
            'applicationsCount' => 0,
            'customersCount' => 0,
            'newApplicationsCount' => 0,
            'recentApplications' => collect(),
            'activeServiceProvidersData' => [],
            'activeRequestsData' => [],
            'activeServicesData' => [],
            'requestsPerEmbassy' => collect(),
            'monthlyRequests' => collect(),
            'topServices' => collect(),
            'topServicesByCount' => collect(),
            'servicesPercentage' => collect(),
            'topEmbassies' => collect(),
            'embassyEarningsOverTime' => collect(),
            'providerStats' => collect(),
            'countryCoverage' => collect(),
            'earningsByCurrency' => [],
        ]);

        // If topEmbassies is empty, fetch it directly
        if ($data['topEmbassies']->isEmpty()) {
            $data['topEmbassies'] = \App\Models\Request::selectRaw("
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
                ->groupBy('embassies.name')
                ->orderByDesc('total_earnings')
                ->limit(5)
                ->get();
        }

        $topEmbassies=$data['topEmbassies'];

        // Ensure the data is in the expected format
        $topEmbassies = $topEmbassies->map(function($embassy) {
            return [
                'embassy_name' => $embassy->embassy_name ?? '-',
                'countries_count' => $embassy->countries_count ?? 0,
                'service_name' => $embassy->service_name ?? '-',
                'total_earnings' => $embassy->total_earnings ?? 0
            ];
        });

        // Debug the structure of $topEmbassies
        // dd($topEmbassies);

        $totalEarnings=$data['totalEarnings'];
        $customersCount=$data['customersCount'];
        $applicationsCount=$data['applicationsCount'];
        $newApplicationsCount=$data['newApplicationsCount'];
        $recentApplications=$data['recentApplications'];
        $activeServiceProvidersData=$data['activeServiceProvidersData'];
        $activeRequestsData=$data['activeRequestsData'];
        $activeServicesData=$data['activeServicesData'];
        $requestsPerEmbassy=$data['requestsPerEmbassy'];
        $monthlyRequests=$data['monthlyRequests'];
        $topServices=$data['topServices'];
        $embassyEarningsOverTime=$data['embassyEarningsOverTime'];
        $providerStats = $data['providerStats'];
        $earningsByCurrency=$data['earningsByCurrency'];
        return view('index', compact('topEmbassies','totalEarnings','earningsByCurrency','customersCount','applicationsCount','newApplicationsCount','recentApplications','activeServiceProvidersData','activeRequestsData','requestsPerEmbassy','monthlyRequests','topServices','embassyEarningsOverTime','providerStats','activeServicesData'));
    }

    public function settings()
    {
        return view('settings');
    }

    /*Language Translation*/
    public function lang($locale)
    {
        if ($locale) {
            App::setLocale($locale);
            Session::put('lang', $locale);
            Session::save();
            return redirect()->back()->with('locale', $locale);
        } else {
            return redirect()->back();
        }
    }


    // public function rolesIndex()
    // {
    //     $roles = $this->roles;
    //     return view('authentication.roles.index', compact('roles'));
    // }

    // public function show($id)
    // {
    //     $role = collect($this->roles)->firstWhere('id', $id);
    //     $groupedPermissions = collect($this->permissions)->groupBy('group');

    //     return view('authentication.roles.show', compact('role', 'groupedPermissions'));
    // }

    // public function authenticationIndex()
    // {
    //     $permissions = $this->permissions;
    //     $roles = $this->roles;
    //     return view('authentication.authentication_home', compact('permissions', 'roles'));
    // }

    public function showEmbassy($id)
    {
        $embassy = Embassy::query()->with('billableItems','countries')->findOrFail($id);
        return view('embassy_profile', compact('embassy'));
    }
}

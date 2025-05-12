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
            'topEmbassies' => collect(),
            'embassyEarningsOverTime' => collect(),
            'providerStats' => collect(),
            'countryCoverage' => collect(),
            'earningsByCurrency' => [], // ✅ Add this
        ]);
        $topEmbassies=$data['topEmbassies'];
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
        $providerStats = collect($data['providerStats']); // <--- Add collect()
        $countryCoverage=$data['countryCoverage'];
        $earningsByCurrency=collect($data['earningsByCurrency']);
        return view('index', compact('countryCoverage','topEmbassies','totalEarnings','earningsByCurrency','customersCount','applicationsCount','newApplicationsCount','recentApplications','activeServiceProvidersData','activeRequestsData','requestsPerEmbassy','monthlyRequests','topServices','embassyEarningsOverTime','providerStats','activeServicesData'));
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

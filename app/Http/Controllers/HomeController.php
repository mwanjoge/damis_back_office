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
        $this->roles = [
            (object)[
                'id' => 1,
                'name' => 'admin',
                'permission_ids' => [1, 2, 3, 6, 7, 8],
            ],
            (object)[
                'id' => 2,
                'name' => 'editor',
                'permission_ids' => [1, 3, 7],
            ]
        ];

        $this->permissions = [
            (object)['id' => 1, 'name' => 'view_users', 'group' => 'Users'],
            (object)['id' => 2, 'name' => 'edit_users', 'group' => 'Users'],
            (object)['id' => 3, 'name' => 'delete_users', 'group' => 'Users'],
            (object)['id' => 4, 'name' => 'view_missions', 'group' => 'Mission'],
            (object)['id' => 5, 'name' => 'edit_missions', 'group' => 'Mission'],
            (object)['id' => 6, 'name' => 'delete_missions', 'group' => 'Mission'],
            (object)['id' => 7, 'name' => 'view_countries', 'group' => 'Country'],
            (object)['id' => 8, 'name' => 'edit_countries', 'group' => 'Country'],
        ];

        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(Request $request)
    {
        $totalEarnings = \App\Models\Invoice::where('status', 'paid')->sum('price');
        $applicationsCount = \App\Models\Request::count();
        $customersCount = \App\Models\Member::count();
        $newApplicationsCount = \App\Models\Request::where('created_at', '>=', now()->subMonth())->count();

        $recentApplications = \App\Models\Request::with(['member', 'items.service'])
            ->latest()
            ->take(5)
            ->get();

        return view('index', compact(
            'totalEarnings',
            'applicationsCount',
            'customersCount',
            'newApplicationsCount',
            'recentApplications'
        ));
    }

    public function root()
    {
        $applicationsCount = \App\Models\Request::count();
        $customersCount = \App\Models\Member::count();
        $newApplicationsCount = \App\Models\Request::where('created_at', '>=', now()->subMonth())->count();

        $recentApplications = \App\Models\Request::with(['member', 'items.service'])
            ->latest()
            ->take(5)
            ->get();

        // Monthly Service Providers
        $activeServiceProvidersData = \App\Models\ServiceProvider::selectRaw('MONTH(created_at) as month, COUNT(*) as count')
            ->groupBy('month')
            ->orderBy('month')
            ->pluck('count', 'month')
            ->toArray();

        // Monthly Requests
        $activeRequestsData = \App\Models\Request::selectRaw('MONTH(created_at) as month, COUNT(*) as count')
            ->whereNull('deleted_at') // if using soft deletes
            ->groupBy('month')
            ->orderBy('month')
            ->pluck('count', 'month')
            ->toArray();

        // Monthly Services
        $activeServicesData = \App\Models\Service::selectRaw('MONTH(created_at) as month, COUNT(*) as count')
            ->groupBy('month')
            ->orderBy('month')
            ->pluck('count', 'month')
            ->toArray();

        $requestsPerEmbassy = \App\Models\Request::selectRaw('embassy_id, COUNT(*) as total')
            ->groupBy('embassy_id')
            ->with('embassy')
            ->get();

        $monthlyRequests = \App\Models\Request::selectRaw('MONTH(created_at) as month, COUNT(*) as count')
            ->groupBy('month')
            ->orderBy('month')
            ->pluck('count', 'month');

        $topServices = \App\Models\RequestItem::with('service')
            ->selectRaw('service_id, COUNT(*) as count')
            ->groupBy('service_id')
            ->orderByDesc('count')
            ->take(5)
            ->get();

        $providerStats = \App\Models\ServiceProvider::withCount('services')->get();

        $countryCoverage = \App\Models\Embassy::withCount('countries')->get();

        return view('index', [
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
        ]);
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


    public function rolesIndex()
    {
        $roles = $this->roles;
        return view('authentication.roles.index', compact('roles'));
    }

    public function show($id)
    {
        $role = collect($this->roles)->firstWhere('id', $id);
        $groupedPermissions = collect($this->permissions)->groupBy('group');

        return view('authentication.roles.show', compact('role', 'groupedPermissions'));
    }

    public function authenticationIndex()
    {
        $permissions = $this->permissions;
        $roles = $this->roles;
        return view('authentication.authentication_home', compact('permissions', 'roles'));
    }

    public function showEmbassy($id)
    {
        $embassy = Embassy::query()->with('billableItems','countries')->findOrFail($id);
        return view('embassy_profile', compact('embassy'));
    }
}

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
        if (view()->exists($request->path())) {
            return view($request->path());
        }
        return abort(404);
    }

    public function root()
    {
        return view('index');
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
        $embassy = Embassy::with('countries')->findOrFail($id);
        return view('embassy_profile', compact('embassy'));
    }
}

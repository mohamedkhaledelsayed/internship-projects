<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use App\Models\Award;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Region;
use App\Models\Role;
use App\Models\Service;
use App\Models\User;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $users = User::count();
        $roles = Role::count();

        $admins = Admin::count();

        return view('dashboard.index')->with([
            'users' => $users,
            'roles' => $roles,
            'admins' => $admins,


        ]);
    }

    public function dashboard()
    {
        return view('dashboard.dashboard');
    }
}

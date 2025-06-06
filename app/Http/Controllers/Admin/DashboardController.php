<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Property;
use App\Models\User;
use Illuminate\View\View;

class DashboardController extends Controller
{
    /**
     * Muestra el panel de control del administrador.
     */
    public function index(): View
    {
        $totalUsers = User::count();
        $totalProperties = Property::count();
        $recentProperties = Property::latest()->take(5)->get();
        $recentUsers = User::latest()->take(5)->get();

        return view('admin.dashboard', compact(
            'totalUsers',
            'totalProperties',
            'recentProperties',
            'recentUsers'
        ));
    }
}

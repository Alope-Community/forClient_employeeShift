<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        return view('pages.dashboard', compact('user'));
    }

    public function employeeDashboard()
    {
        $user = Auth::guard('employee')->user();

        return view('pages.dashboard', compact('user'));
    }
    public function shiftLeaderDashboard()
    {
        $user = Auth::guard('shift_leader')->user();

        return view('pages.dashboard', compact('user'));
    }
    public function adminDashboard()
    {
        $user = Auth::guard('admin')->user();

        return view('pages.dashboard', compact('user'));
    }
}

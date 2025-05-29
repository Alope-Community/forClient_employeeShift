<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Models\Schedule;
use App\Models\Shift;
use App\Models\ShiftLeader;
use App\Models\ShiftReport;
use App\Models\User;
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
        $id = Auth::guard('employee')->user()->id;

        $user = Auth::guard('employee')->user();

        $schedule = Schedule::where('employee_id', $id)
            ->whereDate('date', now())
            ->first();

        return view('pages.dashboard', compact('user', 'schedule'));
    }

    public function shiftLeaderDashboard()
    {
        $user = Auth::guard('shift_leader')->user();

        return view('pages.dashboard', compact('user'));
    }

    public function adminDashboard()
    {
        $user = Auth::guard('admin')->user();

        $countAdmins = User::count();

        $countEmployees =  Employee::count();

        $countLeaders = ShiftLeader::count();

        $countShifts = Shift::count();

        $countReports = ShiftReport::count();

        return view('pages.dashboard', compact('user', 'countAdmins', 'countEmployees', 'countLeaders', 'countShifts', 'countReports'));
    }
}

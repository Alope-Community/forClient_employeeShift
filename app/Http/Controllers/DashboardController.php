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
use Illuminate\Support\Facades\DB;

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

        $countPerDivision = Employee::select('division', DB::raw('count(*) as total'))
            ->groupBy('division')
            ->pluck('total', 'division');

        $schedule = Schedule::where('employee_id', $id)
            ->whereDate('date', now())
            ->orderBy('created_at', 'desc') // memastikan yang terbaru dari hari ini
            ->first();

        return view('pages.dashboard', compact('user', 'schedule', 'countPerDivision'));
    }

    public function shiftLeaderDashboard()
    {
        $user = Auth::guard('shift_leader')->user();

        $unitPersonnel = Employee::where('division', 'Unit Personnel')->get();
        $ashFgdPersonnel = Employee::where('division', 'Ash FGD Personnel')->get();
        $wtpPersonnel = Employee::where('division', 'WTP Personnel')->get();

        return view('pages.dashboard', compact('user', 'unitPersonnel', 'ashFgdPersonnel', 'wtpPersonnel'));
    }

    public function adminDashboard()
    {
        $user = Auth::guard('admin')->user();

        $countAdmins = User::count();

        $countEmployees =  Employee::count();

        $countLeaders = ShiftLeader::count();

        $countShifts = Shift::count();

        $countReports = ShiftReport::count();

        $unitPersonnel = Employee::where('division', 'Unit Personnel')->get();
        $ashFgdPersonnel = Employee::where('division', 'Ash FGD Personnel')->get();
        $wtpPersonnel = Employee::where('division', 'WTP Personnel')->get();

        return view('pages.dashboard', compact('user', 'countAdmins', 'countEmployees', 'countLeaders', 'countShifts', 'countReports', 'unitPersonnel', 'ashFgdPersonnel', 'wtpPersonnel'));
    }
}

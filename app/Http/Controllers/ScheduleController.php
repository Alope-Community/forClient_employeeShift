<?php

namespace App\Http\Controllers;

use App\Models\Schedule;
use App\Models\Shift;
use App\Models\Employee;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ScheduleController extends Controller
{
    protected $prefix;

    public function __construct()
    {
        // Tentukan prefix guard saat controller diinisialisasi
        if (Auth::guard('admin')->check()) {
            $this->prefix = 'admin';
        } elseif (Auth::guard('shift_leader')->check()) {
            $this->prefix = 'shift-leader';
        } else {
            abort(403, 'Unauthorized');
        }
    }

    public function index()
    {
        $shifts = Shift::all();

        return view("pages.data-jadwal-shift.index", compact('shifts'));
    }

    public function show(string $id)
    {
        $shift = Shift::findOrFail($id);

        // Ambil semua jadwal dengan shift_id tertentu, dan ikutkan data employee-nya
        $schedules = Schedule::with('employee')
            ->where('shift_id', $id)
            ->orderBy('date', 'desc')
            ->get();

        return view("pages.data-jadwal-shift.show", compact('shift', 'schedules'));
    }

    public function create()
    {
        $shifts = Shift::all();
        $employees = Employee::all();

        return view("pages.data-jadwal-shift.create", compact('shifts', 'employees'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'employee_id' => 'required|exists:employees,id',
            'shift_id' => 'required|exists:shifts,id',
            'date' => 'required|date',
        ]);

        try {
            Schedule::create($request->only('employee_id', 'shift_id', 'date'));

            return redirect()->route("{$this->prefix}.schedule.index")->with('success', 'Schedule created successfully.');
        } catch (\Throwable $th) {
            return redirect()->back()->withErrors(['error' => 'An error occurred while creating the schedule: ' . $th->getMessage()]);
        }
    }

    public function edit(string $id)
    {
        $schedule = Schedule::with(['employee', 'shift'])->findOrFail($id);
        $shifts = Shift::all();
        $employees = Employee::all();

        return view("pages.data-jadwal-shift.edit", compact('schedule', 'shifts', 'employees'));
    }

    public function update(Request $request, string $id)
    {
        $request->validate([
            'employee_id' => 'required|exists:employees,id',
            'shift_id' => 'required|exists:shifts,id',
            'date' => 'required|date',
        ]);

        $schedule = Schedule::findOrFail($id);

        try {
            $schedule->update($request->only('employee_id', 'shift_id', 'date'));

            return redirect()->route("{$this->prefix}.schedule.index")->with('success', 'Schedule updated successfully.');
        } catch (\Throwable $th) {
            return redirect()->back()->withErrors(['error' => 'An error occurred while updating the schedule: ' . $th->getMessage()]);
        }
    }

    public function destroy(string $id)
    {
        $schedule = Schedule::findOrFail($id);

        try {
            $schedule->delete();
            return redirect()->route("{$this->prefix}.schedule.index")->with('success', 'Schedule deleted successfully.');
        } catch (\Throwable $th) {
            return redirect()->back()->withErrors(['error' => 'An error occurred while deleting the schedule: ' . $th->getMessage()]);
        }
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Models\Schedule;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReplacementController extends Controller
{
    public function create()
    {
        $id = Auth::guard('employee')->user()->id;

        $employees = Employee::where('id', '!=', $id)
            ->whereHas('schedules', function ($query) {
                $query->whereDate('date', now());
            })
            ->with(['schedules' => function ($query) {
                $query->whereDate('date', now())->with('shift');
            }])
            ->get();

        $schedule = Schedule::where('employee_id', $id)
            ->whereDate('date', now())
            ->orderBy('created_at', 'desc') // memastikan yang terbaru dari hari ini
            ->first();

        $warningRequest = null;

        if ($schedule) {
            $scheduleTime = Carbon::parse($schedule->date);
            $cutoffTime = $scheduleTime->copy()->subHours(3);

            if (Carbon::now()->gte($cutoffTime)) {
                $warningRequest = 'Mohon maaf, pengajuan shift hanya dapat dilakukan paling lambat 3 jam sebelum waktu mulai.';
            }
        }

        session()->flash('warningRequest', $warningRequest);

        return view('pages.backup-shift.create', compact('employees', 'schedule'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'end_date' => 'required|date',
            'replaced_with' => 'required|exists:employees,id',
        ]);

        $employeeId = Auth::guard('employee')->id();

        $schedule = Schedule::where('employee_id', $employeeId)
            ->whereDate('date', now())
            ->orderBy('created_at', 'desc')
            ->first();

        if (!$schedule) {
            return back()->withErrors(['schedule' => 'Jadwal Anda tidak ditemukan.']);
        }

        $schedule->update([
            'end_date' => $request->end_date,
            'is_replaced' => 1,
            'replaced_with' => $request->replaced_with,
        ]);

        return redirect()->route('employee.shift-replacement.create')
            ->with('success', 'Pengajuan shift berhasil dikirim.');
    }
}

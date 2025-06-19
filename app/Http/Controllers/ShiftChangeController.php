<?php

namespace App\Http\Controllers;

use App\Models\Schedule;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ShiftChangeController extends Controller
{
    protected function detectPrefix()
    {
        foreach (['admin', 'shift_leader', 'employee'] as $guard) {
            if (Auth::guard($guard)->check()) {
                return $guard === 'shift_leader' ? 'shift-leader' : $guard;
            }
        }

        abort(403, 'Unauthorized');
    }

    protected function detectGuard()
    {
        foreach (['admin', 'shift_leader', 'employee'] as $guard) {
            if (Auth::guard($guard)->check()) {
                return $guard;
            }
        }

        abort(403, 'Unauthorized');
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $shiftChanges = \App\Models\ShiftChange::with(['shiftReport', 'approver'])
            ->whereHas('shiftReport', function ($query) {
                $query->where('type', 'change');
            })
            ->orderBy('created_at', 'desc')
            ->get();

        return view("pages.shift-change.index", compact('shiftChanges'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $shiftChange = \App\Models\ShiftChange::with([
            'shiftReport.employee',
            'shiftReport.fromShift',
            'shiftReport.toShift',
            'approver'
        ])->findOrFail($id);

        return view('pages.shift-change.show', compact('shiftChange'));
    }


    public function edit($id)
    {
        $shiftChange = \App\Models\ShiftChange::with(['shiftReport.employee', 'shiftReport.fromShift', 'shiftReport.toShift'])->findOrFail($id);


        if ($shiftChange->status === 'approved') return abort(403, 'Anda tidak ada akses ke halaman ini.');

        if ($shiftChange->shiftReport->type === 'change') {
            return view('pages.shift-change.edit', compact('shiftChange'));
        } else {
            return view('pages.verification-problem.edit', compact('shiftChange'));
        }
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        try {

            $request->validate([
                'status' => 'required|in:approved,rejected',
            ]);

            $shiftChange = \App\Models\ShiftChange::findOrFail($id);
            $shiftChange->status = $request->input('status');
            $shiftChange->approved_by = Auth::id();
            $shiftChange->approved_at = now();
            $shiftChange->save();

            // TODO: create schedule if approved
            if ($shiftChange->status == 'approved') {
                $report = $shiftChange->shiftReport;

                // Tambahkan jadwal untuk pengaju
                Schedule::create([
                    'employee_id' => $report->employee_id,
                    // 'shift_id' => $report->toShift->id,
                    'shift_id' => $report->fromShift->id,
                    'date' => $report->time,
                ]);

                // Ubah jadwal karyawan asal di tanggal itu menjadi shift asal pengaju
                $existingSchedule = Schedule::where('employee_id', $report->from_employee_id)
                    ->whereDate('date', $report->time)
                    ->first();

                if ($existingSchedule) {
                    $existingSchedule->update([
                        'shift_id' => $report->toShift->id,
                    ]);
                } else {
                    // Jika tidak ada, buat baru
                    Schedule::create([
                        'employee_id' => $report->from_employee_id,
                        'shift_id' => $report->toShift->id,
                        'date' => $report->time,
                    ]);
                }
            }

            $notification = auth($this->detectGuard())->user()
                ->unreadNotifications
                ->where('data.report_id', $shiftChange->shift_report_id)
                ->first();

            if ($notification) {
                $notification->markAsRead();
            }

            return redirect()->route("{$this->detectPrefix()}.shift-change.index")->with('success', 'Shift change updated successfully.');
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => 'Failed to update shift change: ' . $e->getMessage()]);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}

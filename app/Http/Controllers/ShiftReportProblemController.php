<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Employee;
use App\Models\Shift;
use App\Models\ShiftChange;
use App\Models\ShiftLeader;
use App\Models\ShiftReport;
use App\Notifications\ShiftReportProblemNotification;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Notifications\DatabaseNotification;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ShiftReportProblemController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $user = $request->user();
        $isAdmin = auth()->guard('admin')->check();

        $reportsQuery = ShiftReport::query()
            ->with(['shiftChange' => function ($query) {
                $query->where('status', 'pending');
            }])
            ->where('type', 'problem')
            ->whereHas('shiftChange', function ($query) {
                $query->where('status', 'pending');
            });

        if (!$isAdmin) {
            $reportsQuery->where('from_employee_id', $user->id);
        }

        $reports = $reportsQuery->latest()->get();

        return view('pages.report-problem.index', compact('reports'));
    }

    public function create()
    {
        // $employees = Employee::with(['schedules' => function ($query) {
        //     $query->orderBy('date', 'desc')->with('shift');
        // }])->where('id', '!=', auth()->user()->id)->get();

        // ambil hanya karyawan dengan jadwal aktif sekarang
        $employees = Employee::where('id', '!=', auth()->user()->id)
            ->whereHas('schedules', function ($query) {
                $query->whereDate('date', now());
            })
            ->with(['schedules' => function ($query) {
                $query->whereDate('date', now())->with('shift');
            }])
            ->get();

        $shifts = Shift::all();

        return view('pages.report-problem.create', compact('employees', 'shifts'));
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'address' => 'required|string',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $shiftReport = ShiftReport::create([
            'from_employee_id' => auth()->user()->id,
            'title' => $request->title,
            'description' => $request->description,
            'time' => now(),
            'type' => 'problem',
            'address' => $request->address,
            'image' => $request->image
        ]);

        $shiftReport->shiftChange()->updateOrCreate(
            [], // Karena hasOne, tidak perlu kondisi spesifik
            [
                'status' => 'pending',
                'approved_by' => null,
                'approved_at' => null,
            ]
        );

        if (!$shiftReport) {
            return back()->withErrors(['error' => 'Gagal mengajukan laporan shift.']);
        }

        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('images/shift_reports', 'public');
            $shiftReport->image = $imagePath;
            $shiftReport->save();
        }

        $shiftLeaders = ShiftLeader::all();

        foreach ($shiftLeaders as $shiftLeader) {
            $shiftLeader->notify(new ShiftReportProblemNotification($shiftReport->id, auth()->user()->name, $shiftReport->time, $shiftReport->description));
        }

        return redirect()->route('employee.report-problem.index')->with('success', 'Pengajuan perubahan shift berhasil diajukan. Mohon tunggu konfirmasi dari atasan.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $shiftReport = ShiftReport::findOrFail($id);
        return view('pages.report-problem.show', compact('shiftReport'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'address' => 'required|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $shiftReport = ShiftReport::findOrFail($id);
        $shiftReport->title = $request->title;
        $shiftReport->description = $request->description;
        $shiftReport->address = $request->address;

        if ($request->hasFile('image')) {
            if ($shiftReport->image) {
                Storage::disk('public')->delete($shiftReport->image);
            }
            $imagePath = $request->file('image')->store('images/shift_reports', 'public');
            $shiftReport->image = $imagePath;
        }

        if (!$shiftReport->save()) {
            return back()->withErrors(['error' => 'Gagal memperbarui laporan permasalahan shift.']);
        }

        return back()->with('success', 'Laporan permasalahan shift berhasil diperbarui.');
    }

    public function updateOnLeader(Request $request, string $id)
    {
        $request->validate([
            'status' => 'required',
        ]);

        $shiftChange = ShiftChange::findOrFail($id);
        $shiftChange->status = $request->status;
        $shiftChange->approved_by = auth()->user()->id;
        $shiftChange->approved_at = now();

        $notification = auth()->user()
            ->unreadNotifications
            ->where('data.report_id', $shiftChange->shift_report_id)
            ->first();

        if (!$shiftChange->save()) {
            return back()->withErrors(['error' => 'Gagal memperbarui laporan permasalahan shift.']);
        }

        if ($notification) {
            $notification->markAsRead();
        }

        return redirect()->route('shift-leader.shift-change.index')->with('success', 'Laporan permasalahan shift berhasil diperbarui.');
    }

    public function edit($id)
    {
        $report = ShiftReport::findOrFail($id);
        $shifts = Shift::all();

        return view('pages.report-problem.edit', compact('report', 'shifts'));
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $shiftReport = ShiftReport::findOrFail($id);

        DatabaseNotification::where('type', ShiftReportProblemNotification::class)
            ->where('data->report_id', $shiftReport->id)
            ->delete();

        if ($shiftReport->image) {
            Storage::disk('public')->delete($shiftReport->image);
        }

        if (!$shiftReport->delete()) {
            return back()->withErrors(['error' => 'Gagal menghapus laporan permasalahan shift.']);
        }

        return redirect()->route('employee.report-problem.index')->with('success', 'Laporan permasalahan shift berhasil dihapus.');
    }

    // public function download($id)
    // {
    //     $report = ShiftReport::with(['employee', 'fromEmployee', 'fromShift', 'toShift', 'shiftChange'])->findOrFail($id);

    //     $pdf = Pdf::loadView('pdf.shift-report', compact('report'))
    //         ->setOption([
    //             'fontDir' => storage_path('/fonts'),
    //             'fontCache' => storage_path('/fonts'),
    //             'defaultFont' => 'Noto Sans SC'
    //         ]);;

    //     return $pdf->download('riwayat-pergantian-shift-' . $report->employee->name . '.pdf');
    // }
}
